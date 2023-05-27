<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\AbsensiMahasiswa;
use App\Models\AbsensiMahasiswaSP;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiMahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function absenMasuk(Request $request)
    {
        $this->validate($request, [
            'id_tahun_ajaran' => 'required',
            'id_semester' => 'required',
            'id_prodi' => 'required',
            'mapel_id' => 'required',
            'kelas_id' => 'required',
            'hari_id' => 'required',
            'pertemuan_ke' => 'required',
        ]);
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        AbsensiMahasiswa::create([
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_semester' => $request->id_semester,
            'id_prodi' => $request->id_prodi,
            'id_mahasiswa' => $mahasiswa->id,
            'id_dosen' => '',
            'mapel_id' => $request->mapel_id,
            'hari_id' => $request->hari_id,
            'kelas_id' => $request->kelas_id,
            'pertemuan_ke' => $request->pertemuan_ke,
            'tanggal_masuk' => $date,
            'jam_masuk' => $time,
            'status' => 'Hadir',
            'long' => '',
            'lat' => '',
            'ip_address' => $this->getIp(),
            'user_agent' => $request->server('HTTP_USER_AGENT'),
        ]);

        return redirect()->back();
    }

        public function absenSPMasuk(Request $request)
    {
        $this->validate($request, [
            'id_tahun_ajaran' => 'required',
            'id_semester' => 'required',
            'id_prodi' => 'required',
            'mapel_id' => 'required',
           // 'kelas_id' => 'required',
            'hari_id' => 'required',
            'pertemuan_ke' => 'required',
        ]);
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        AbsensiMahasiswaSP::create([
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_semester' => $request->id_semester,
            'id_prodi' => $request->id_prodi,
            'id_mahasiswa' => $mahasiswa->id,
            'id_dosen' => '',
            'mapel_id' => $request->mapel_id,
            'hari_id' => $request->hari_id,
           // 'kelas_id' => $request->kelas_id,
            'pertemuan_ke' => $request->pertemuan_ke,
            'tanggal_masuk' => $date,
            'jam_masuk' => $time,
            'status' => 'Hadir',
            'long' => '',
            'lat' => '',
            'ip_address' => $this->getIp(),
            'user_agent' => $request->server('HTTP_USER_AGENT'),
        ]);

        return redirect()->back();
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