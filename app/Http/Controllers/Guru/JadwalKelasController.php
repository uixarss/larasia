<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Dosen;
use App\Models\Pengampu;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\JadwalSP;
use App\Models\JadwalPengganti;
use App\Models\Waktu;
use App\Models\TahunAjaran;
use App\Models\Semester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Gate;

class JadwalKelasController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:dosen']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (Gate::denies('view-jadwal-kelas')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $data_guru = Dosen::where('user_id', Auth::id())->first();

        $data_waktu = Waktu::all();
        $data_hari = Hari::all();
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        $data_jadwal = Jadwal::where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->where('id_dosen', $data_guru->id)
            ->orderBy('hari_id', 'ASC')
            ->get();
        $data_jadwal_sp = JadwalSP::where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->where('id_dosen', $data_guru->id)
            ->orderBy('hari_id', 'ASC')
            ->get();
        $data_jadwal_pengganti = JadwalPengganti::where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->where('id_dosen', $data_guru->id)
            ->orderBy('hari_id', 'ASC')
            ->get();


        $pengampu = Pengampu::join(
            'mapel', 'pengampu.mapel_id', '=', 'mapel.id'
        )->where('id_dosen', $data_guru->id)->first();
        return view('guru.jadwalkelas.index', [
            'guru' => $data_guru,
            'data_hari' => $data_hari,
            'data_waktu' => $data_waktu,
            'data_jadwal' => $data_jadwal,
            'pengampu' => $pengampu,
            'data_jadwal_sp' => $data_jadwal_sp,
            'data_jadwal_pengganti' => $data_jadwal_pengganti
        ]);
    }
}