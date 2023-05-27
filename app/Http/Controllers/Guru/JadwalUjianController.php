<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\JadwalUjian;
use App\Models\JadwalUjianDetail;
use App\Models\TahunAjaran;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\MataPelajaran;
use App\Models\Waktu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gate;

class JadwalUjianController extends Controller
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
        // if (Gate::denies('view-jadwal-ujian')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $data_jadwal_ujian = JadwalUjian::all();

        return view('guru.jadwalujian.index', 
        [
            'data_jadwal_ujian' => $data_jadwal_ujian
        ]
        );
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
        // if (Gate::denies('creaete-jadwal-ujian')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $this->validate($request,[
            'title' => 'required',
            'year' => 'required'
        ]);

        JadwalUjian::create([
            'title' => $request->title,
            'year' => $request->year,
            'created_by' => Auth::id()
        ]);

        return redirect()->back();
    }

    public function add(Request $request, $id)
    {
        // if (Gate::denies('create-jadwal-ujian')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $this->validate($request,[
            'nama_ruangan' => 'required',
            'mapel_id' => 'required',
            'kelas_id' => 'required',
            'tanggal_ujian' => 'required'
        ]);

        JadwalUjianDetail::create([
           'nama_ruangan'  => $request->nama_ruangan,
           'mapel_id' => $request->mapel_id,
           'kelas_id' => $request->kelas_id,
           'tanggal_ujian' => $request->tanggal_ujian,
           'jadwal_ujians_id' => $id
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JadwalUjian  $jadwalUjian
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if (Gate::denies('edit-jadwal-ujian')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $jadwalUjian = JadwalUjian::find($id);
        $data_jadwal_ujian_detail = JadwalUjianDetail::where('jadwal_ujians_id', $id)->orderBy('tanggal_ujian','ASC')->get();
        $data_kelas = Kelas::all();
        $data_mapel = MataPelajaran::all();


        return view('guru.jadwalujian.show',[
            'data_kelas' => $data_kelas,
            'data_mapel' => $data_mapel,
            'data_jadwal_ujian_detail' => $data_jadwal_ujian_detail,
            'jadwal_ujian' => $jadwalUjian
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JadwalUjian  $jadwalUjian
     * @return \Illuminate\Http\Response
     */
    public function edit(JadwalUjian $jadwalUjian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JadwalUjian  $jadwalUjian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // if (Gate::denies('update-jadwal-ujian')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $jadwalUjian = JadwalUjian::find($id);

        $jadwalUjian->update([
            'title' => $request->title,
            'year' => $request->year,
            'created_by' => Auth::id()

        ]);
        return redirect()->back();

    }
    public function updateDetail(Request $request,$id)
    {
        // if (Gate::denies('update-jadwal-ujian')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $jadwalUjian = JadwalUjianDetail::find($id);

        $jadwalUjian->update([
            'nama_ruangan'  => $request->nama_ruangan,
            'mapel_id' => $request->mapel_id,
            'kelas_id' => $request->kelas_id,
            'tanggal_ujian' => $request->tanggal_ujian,
        ]);
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JadwalUjian  $jadwalUjian
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (Gate::denies('delete-jadwal-ujian')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $jadwalUjian = JadwalUjian::find($id);
        $jadwalUjian->delete($jadwalUjian);

        return redirect()->back();

    }

    public function destroyDetail($id)
    {
        // if (Gate::denies('delete-jadwal-ujian')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $jadwalUjian = JadwalUjianDetail::find($id);
        $jadwalUjian->delete($jadwalUjian);

        return redirect()->back();

    }

}
