<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\TahunAjaranGuruKelas;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use TahunAjaranWaliKelas;

class KelasController extends Controller
{
    public function __construct()
    {
      $this ->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tahun_ajaran = TahunAjaran::
            where('status', '1')
            // where('start_date', '>', now())
            // ->orWhere('end_date', '<', now())
            ->first();
        $kelas = Kelas::orderBy('created_at', 'ASC')->get();;
        return view('admin.kelas.index', [
            'kelas' => $kelas,
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
        $this->validate($request, [
            'kode_kelas' => 'required|unique:kelas',
            'nama_kelas' => 'required',
            'kapasitas' => 'required',
            'jurusan' => 'required',
            'tingkat' => 'required',
        ]);

        $kelas = Kelas::create([
            'kode_kelas' => $request->kode_kelas,
            'nama_kelas' => $request->nama_kelas,
            'kapasitas' => $request->kapasitas,
            'jurusan' => $request->jurusan,
            'tingkat' => $request->tingkat
        ]);

        return redirect()->route('admin.kelas.index')->with('sukses', 'Data Berhasil Ditambahkan');
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

        // dd($request->all());
        // Kelas::update($request->all());

        $kelas = Kelas::find($id);

        $kelas->update([
            'kode_kelas' => $request->kode_kelas,
            'nama_kelas' => $request->nama_kelas,
            'kapasitas' => $request->kapasitas,
            'jurusan' => $request->jurusan,
            'tingkat' => $request->tingkat
        ]);
        // $tahun_ajaran = TahunAjaran::where('status', '1')->first();

        // $wali_kelas = TahunAjaranGuruKelas::where('tahun_ajaran_id', $tahun_ajaran->id)
        //     ->where('kelas_id', $id)->first();

        // if ($wali_kelas != null) {
        //     $wali_kelas->update(['guru_id' => $request->guru_id]);
        // } else {
        //     TahunAjaranGuruKelas::create([
        //         'tahun_ajaran_id' => $tahun_ajaran->id,
        //         'kelas_id' => $id,
        //         'guru_id' => $request->guru_id
        //     ]);
        // }




        return redirect()->route('admin.kelas.index')->with('sukses', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::find($id);

        // $tahun_ajaran = TahunAjaran::where('status', '1')->first();

        // $wali_kelas = TahunAjaranGuruKelas::where('tahun_ajaran_id', $tahun_ajaran->id)
        //     ->where('kelas_id', $id)->first();

        // $wali_kelas->delete($wali_kelas);
        $kelas->delete($kelas);





        return redirect()->route('admin.kelas.index')->with('sukses', 'Data Berhasil Dihapus');
    }
}
