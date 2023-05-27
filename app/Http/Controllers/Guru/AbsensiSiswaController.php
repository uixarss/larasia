<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Support\Carbon;
use App\Models\AbsensiSiswa;
use Illuminate\Http\Request;

class AbsensiSiswaController extends Controller
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
    public function index(Request $request)
    {
        $data_kelas = Kelas::all();
        $absensi_siswa = AbsensiSiswa::where('tanggal_absen', Carbon::today()->toDateString())->get();
        $absensi_siswa_tanggal = AbsensiSiswa::orderBy('tanggal_absen', 'desc');
        $tanggal_absens = '';

        $id_jadwal = $request->id_jadwal;

        if (!empty($request->tanggal_absen) || !empty($request->id_jadwal)) {
            $absensi_siswa_tanggal = $absensi_siswa_tanggal->where('tanggal_absen', Carbon::parse($request->tanggal_absen)->toDateString())->get();
            $tanggal_absens = $request->tanggal_absen;
            $id_jadwal = $request->id_jadwal;
        }  



        return view('guru.absensisiswa.index', [
            'data_kelas' => $data_kelas,
            'absensi_siswas' => $absensi_siswa,
            'absensi_siswa_t' => $absensi_siswa_tanggal,
            'tanggal_absen' => $tanggal_absens,
            'id_jadwal' => $id_jadwal
        ])->with('absensi');

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
    }
}
