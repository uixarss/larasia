<?php

namespace App\Http\Controllers;

use App\DataSiswa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Event;
use App\Models\AbsensiMahasiswa;
use App\Models\Hari;
use App\Models\Waktu;
use App\Models\Ruangan;
use App\Models\Jadwal;
use App\Models\JadwalSP;
use App\Models\DataSP;
use App\Models\JadwalPengganti;
use App\Models\KelasMahasiswa;
use App\Models\Mahasiswa;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\PengumumanDosen;
use App\Models\Pengumuman;
use App\Models\KalenderAkademik;
use App\Helpers\GlobalFunction;
use Calendar;

class DataSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data_pengumuman = Pengumuman::orderBy('tanggal_pengumuman', 'desc')->get();
        $jadwal = Jadwal::orderBy('hari_id', 'asc')->get();
        $reminder = DB::table('reminders')->orderBy('tanggal_reminder', 'ASC')
            ->where('tanggal_reminder', '>', date('Y-m-d'))
            ->paginate(3);
        $events = Event::where('end', '>', date('Y-m-d'))
            ->orderBy('start', 'ASC')
            ->paginate(5);

        $date = date("Y-m-d");
        $hari = "";
        switch (date('w', strtotime($date))) {

            case 1:
                $hari = "Senin";
                break;
            case 2:
                $hari = "Selasa";
                break;
            case 3:
                $hari = "Rabu";
                break;
            case 4:
                $hari = "Kamis";
                break;
            case 5:
                $hari = "Jumat";
                break;
            case 6:
                $hari = "Sabtu";
                break;
            default:
                $hari = "Senin";
        }
        // dd($hari);
        $hari_id = Hari::where('hari', $hari)->first();

        if ($hari_id == null) {
            $tahun_ajaran = TahunAjaran::where('status', '1')->first();
            $semester = Semester::where('status', '1')->first();
            //$siswa = Mahasiswa::where('user_id', '=', Auth::id())->first();
            $data_jadwal = Jadwal::where('tahun_ajaran_id', $tahun_ajaran->id)
                ->where('semester_id', $semester->id)
                ->where('hari_id', $hari_id->id)
                ->orderBy('ruangan_id', 'ASC')
                // ->with('hari', 'waktu', 'kelas', 'semester', 'tahunajaran', 'mapel')
                ->get();
        }
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();

        $data_jadwal = Jadwal::where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->where('hari_id', $hari_id->id)
            ->groupBy('ruangan_id')->orderBy('waktu_id', 'ASC')
            // ->with('hari', 'waktu', 'kelas', 'semester', 'tahunajaran', 'mapel')
            ->get();

        $jadwals = DB::table('jadwals')->join('mapel', 'mapel.id','=', 'jadwals.mapel_id')->join('ruangans', 'ruangans.id', '=', 'jadwals.ruangan_id')->join('dosen', 'dosen.id', '=', 'jadwals.id_dosen')->join('waktus', 'waktus.id', '=', 'jadwals.waktu_id')->join('kelas', 'kelas.id', '=','jadwals.kelas_id')->orderBy('jadwals.kelas_id', 'ASC')->where('tahun_ajaran_id', $tahun_ajaran->id)->where('semester_id', $semester->id)->where('ruangans.id', '<=', '5')->where('hari_id', $hari_id->id)->orderBy('ruangan_id', 'ASC')->select('ruangans.nama_ruangan as Ruang', 'kelas.nama_kelas as Kelas', DB::raw("CONCAT(dosen.nama_dosen,'\n', mapel.nama_mapel, '\n', DATE_FORMAT(waktus.jam_masuk, '%H:%i'),' - ', DATE_FORMAT(waktus.jam_keluar, '%H:%i')) as jadwal"))->get();
        $jadwals2 = DB::table('jadwals')->join('mapel', 'mapel.id','=', 'jadwals.mapel_id')->join('ruangans', 'ruangans.id', '=', 'jadwals.ruangan_id')->join('dosen', 'dosen.id', '=', 'jadwals.id_dosen')->join('waktus', 'waktus.id', '=', 'jadwals.waktu_id')->join('kelas', 'kelas.id', '=','jadwals.kelas_id')->orderBy('jadwals.kelas_id', 'ASC')->where('tahun_ajaran_id', $tahun_ajaran->id)->where('semester_id', $semester->id)->where('ruangans.id', '<=', '10')->where('hari_id', $hari_id->id)->orderBy('ruangan_id', 'ASC')->select('ruangans.nama_ruangan as Ruang', 'kelas.nama_kelas as Kelas', DB::raw("CONCAT(dosen.nama_dosen,'\n', mapel.nama_mapel, '\n', DATE_FORMAT(waktus.jam_masuk, '%H:%i'),' - ', DATE_FORMAT(waktus.jam_keluar, '%H:%i')) as jadwal"))->get();
        $jadwals3 = DB::table('jadwals')->join('mapel', 'mapel.id','=', 'jadwals.mapel_id')->join('ruangans', 'ruangans.id', '=', 'jadwals.ruangan_id')->join('dosen', 'dosen.id', '=', 'jadwals.id_dosen')->join('waktus', 'waktus.id', '=', 'jadwals.waktu_id')->join('kelas', 'kelas.id', '=','jadwals.kelas_id')->orderBy('jadwals.kelas_id', 'ASC')->where('tahun_ajaran_id', $tahun_ajaran->id)->where('semester_id', $semester->id)->where('ruangans.id', '<=', '15')->where('hari_id', $hari_id->id)->orderBy('ruangan_id', 'ASC')->select('ruangans.nama_ruangan as Ruang', 'kelas.nama_kelas as Kelas', DB::raw("CONCAT(dosen.nama_dosen,'\n', mapel.nama_mapel, '\n', DATE_FORMAT(waktus.jam_masuk, '%H:%i'),' - ', DATE_FORMAT(waktus.jam_keluar, '%H:%i')) as jadwal"))->get();

        $waktu = Waktu::all();
        $ruangan = Ruangan::all();
        $ruangan1 = Ruangan::where('id','<=', '5')->get();
        $calendar = Kalenderakademik::all();
        $kelas = Kelas::all();

        if ($request->ajax()) {

            $data = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->get(['id', 'title', 'start', 'end', 'color']);

            return response()->json($data);
        }

        return view('guest',  [
            'data_reminder' => $reminder,
            'events' => $events,
            'data_jadwal' => $data_jadwal,
            'data_pengumuman' => $data_pengumuman,
            'waktu' => $waktu,
            'ruangan' => $ruangan,
            'calendar' => $calendar,
            'kelas' => $kelas,
            'jadwals' => $jadwals,
            'jadwals2' => $jadwals2,
            'jadwals3' => $jadwals3,
            'ruangan1' => $ruangan1
        ]);
    }

    public function get_jadwal()
    {

        $date = date("Y-m-d");
        $hari = "";
        switch (date('w', strtotime($date))) {

            case 1:
                $hari = "Senin";
                break;
            case 2:
                $hari = "Selasa";
                break;
            case 3:
                $hari = "Rabu";
                break;
            case 4:
                $hari = "Kamis";
                break;
            case 5:
                $hari = "Jumat";
                break;
            case 6:
                $hari = "Sabtu";
                break;
            default:
                $hari = "Senin";
        }
        // dd($hari);
        $hari_id = Hari::where('hari', $hari)->first();

        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();

        $data = DB::table('jadwals')->join('mapel', 'mapel.id', '=', 'jadwals.mapel_id')->join('ruangans', 'ruangans.id', '=', 'jadwals.ruangan_id')->join('dosen', 'dosen.id', '=', 'jadwals.id_dosen')->join('waktus', 'waktus.id', '=', 'jadwals.waktu_id')->join('kelas', 'kelas.id', '=', 'jadwals.kelas_id')->orderBy('jadwals.kelas_id', 'ASC')->where('tahun_ajaran_id', $tahun_ajaran->id)->where('semester_id', $semester->id)->where('hari_id', $hari_id->id)->select('ruangans.nama_ruangan as Ruang', 'kelas.nama_kelas as Kelas', DB::raw("CONCAT('\n',dosen.nama_dosen,'\n', mapel.nama_mapel, '\n', DATE_FORMAT(waktus.jam_masuk, '%H:%i'),' - ', DATE_FORMAT(waktus.jam_keluar, '%H:%i'),'\n','---------------') as jadwal"))->get();


        if ($data) {
            return response()->json($data, 200);
        } else {
            $response = [
                'message'       => 'Not Found'
            ];

            return response()->json($response, 404);
        }
        $response = [
            'message'       => 'An Error Occured'
        ];

        return response()->json($response, 500);
    }

    public function ajax(Request $request)
    {

        switch ($request->type) {
            case 'add':
                $event = KalenderAkademik::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            case 'update':
                $event = KalenderAkademik::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            case 'delete':
                $event = KalenderAkademik::find($request->id)->delete();

                return response()->json($event);
                break;

            default:
                # code...
                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
     * @param  \App\DataSiswa  $dataSiswa
     * @return \Illuminate\Http\Response
     */
    public function show(DataSiswa $dataSiswa)
    {


        return view('guest', compact('calendar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataSiswa  $dataSiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(DataSiswa $dataSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataSiswa  $dataSiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataSiswa $dataSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataSiswa  $dataSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataSiswa $dataSiswa)
    {
        //
    }
}
