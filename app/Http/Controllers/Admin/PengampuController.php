<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Dosen;
use App\Models\MataPelajaran;
use App\Models\Pengampu;

class PengampuController extends Controller
{
    public function __construct()
    {
      $this ->middleware(['auth','role:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_tahun_ajaran = TahunAjaran::all();
        $data_semester = Semester::all();

        return view('admin.pengampu.index', [
            'data_tahun_ajaran' => $data_tahun_ajaran,
            'data_semester' => $data_semester
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $pengampu = Pengampu::find($id);
        $pengampu->update([
            'id_dosen' => $request->id_dosen,
            'mapel_id' => $request->mapel_id
        ]);

        return redirect()->back()->with([
            'success' => 'Berhasil update pengampu'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $pengampu = Pengampu::find($id);

        $pengampu->delete();

        return redirect()->back()->with([
            'success' => 'Berhasil hapus pengampu'
        ]); 
    }

    public function getProdi($id_tahun_ajaran, $id_semester)
    {
        $tahun_ajaran = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);

        $data_prodi = Prodi::with('jurusan.fakultas')->get();

        return view('admin.pengampu.prodi',[
            'tahun_ajaran' => $tahun_ajaran,
            'semester' => $semester,
            'data_prodi' => $data_prodi
        ]);
    }

    public function getDetailDosen($id_tahun_ajaran, $id_semester, $id_prodi)
    {
        $tahun_ajaran = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);
        $prodi = Prodi::where('id_prodi', $id_prodi)->first();

        $data_dosen = Dosen::all();
        $data_mapel = MataPelajaran::all();
        $data_pengampu = Pengampu::where('id_tahun_ajaran', $id_tahun_ajaran)->where('id_semester',$id_semester)->where('id_prodi', $id_prodi)->get();

        return view('admin.pengampu.detail',[
            'tahun_ajaran' => $tahun_ajaran,
            'semester' => $semester,
            'prodi' => $prodi,
            'data_dosen' => $data_dosen,
            'data_pengampu' => $data_pengampu,
            'data_mapel' => $data_mapel
        ]);
    }

    public function addDosen(Request $request, $id_tahun_ajaran, $id_semester, $id_prodi)
    {
        $this->validate($request,[
            'id_dosen' => 'required',
            'mapel_id' => 'required'
        ]);
        $prodi = Prodi::where('id_prodi', $id_prodi)->first();
        Pengampu::create([
            'id_tahun_ajaran' => $id_tahun_ajaran,
            'id_semester' => $id_semester,
            'id_fakultas' => $prodi->jurusan->fakultas->id,
            'id_jurusan' => $prodi->jurusan->id,
            'id_prodi' => $id_prodi,
            'id_dosen' => $request->id_dosen,
            'mapel_id' => $request->mapel_id
        ]);

        return redirect()->back()->with(['success' => 'Berhasil menambah pengampu']);
    }
}
