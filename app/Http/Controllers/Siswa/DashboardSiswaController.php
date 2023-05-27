<?php

namespace App\Http\Controllers\Siswa;

use App\DashboardSiswa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Event;
use App\Models\AbsensiMahasiswa;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\JadwalSP;
use App\Models\DataSP;
use App\Models\JadwalPengganti;
use App\Models\KelasMahasiswa;
use App\Models\Mahasiswa;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Siswa;
use App\Models\PengumumanDosen;
use App\Helpers\GlobalFunction;

class DashboardSiswaController extends Controller
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
        $reminder = DB::table('reminders')->orderBy('tanggal_reminder', 'ASC')
            ->where('tanggal_reminder', '>', date('Y-m-d'))
            ->paginate(3);
        $events = Event::
        where('end', '>', date('Y-m-d'))
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

        $hari_id = Hari::where('hari', $hari)->first();

        if ($hari_id == null) {
            $tahun_ajaran = TahunAjaran::where('status', '1')->first();
            $semester = Semester::where('status', '1')->first();
            $siswa = Mahasiswa::where('user_id', '=', Auth::id())->first();
            $data_jadwal = Jadwal::where('kelas_id', $siswa->kelas_id)
                ->where('tahun_ajaran_id', $tahun_ajaran->id)
                ->where('semester_id', $semester->id)
                // ->where('hari_id', $hari_id->id+1)
                // ->groupBy('hari_id')
                // ->with('hari', 'waktu', 'kelas', 'semester', 'tahunajaran', 'mapel')
                ->get();
                
        }
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        $siswa = Mahasiswa::where('user_id', '=', Auth::id())->first();
        // $data_jadwal = Jadwal::where('kelas_id', $siswa->kelas_id ?? '')
        //     ->where('tahun_ajaran_id', $tahun_ajaran->id)
        //     ->where('semester_id', $semester->id)
        //     ->where('hari_id', $hari_id->id)
            // ->groupBy('hari_id')
            // ->with('hari', 'waktu', 'kelas', 'semester', 'tahunajaran', 'mapel')
            // ->get();
            $data_jadwal = AbsensiMahasiswa::where('id_mahasiswa', $siswa->id)
                ->where('tanggal_masuk', date('Y-m-d'))
                ->get();

        $data_jadwal_pengganti_hari_ini = JadwalPengganti::where('kelas_id', $siswa->kelas_id)
        ->where('tahun_ajaran_id', $tahun_ajaran->id)
        ->where('semester_id', $semester->id)
        ->where('hari_id', $hari_id->id)
        ->where('status', 'diterima')
        ->get();

       // $data = AbsensiMahasiswa::leftjoin('absensi_mahasiswas','mahasiswa.id','absensi_mahasiswas.id_mahasiswa');
        $data_sp = DataSP::where('id_mahasiswa', '=', $siswa->id)->first();
        //dd($data_sp->mapel_id);
        $data_sp = JadwalSP::where('mapel_id', $data_sp->mapel_id ?? '')
            ->where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->where('hari_id', $hari_id->id)
            // ->groupBy('hari_id')
            // ->with('hari', 'waktu', 'kelas', 'semester', 'tahunajaran', 'mapel')
            ->get();

        $data = PengumumanDosen::leftjoin('pengumuman_dosen','absensi_mahasiswas.id_jadwal', 'pengumuman_dosen.id_jadwal')->groupby('pengumuman_dosen.id_jadwal')->where('absensi_mahasiswas.id_mahasiswa', '=', $siswa->id);
       // dd($siswa->id);


        return view('siswa.halamanutama.index', [
            'data_reminder' => $reminder,
            'events' => $events,
            'data_jadwal' => $data_jadwal,
            'data_jadwal_pengganti_hari_ini' => $data_jadwal_pengganti_hari_ini,
            'data' => $data,
            'data_sp' => $data_sp
        ]);
    }


     public function pesan()
    {
       // $data = AbsensiMahasiswa::leftjoin('absensi_mahasiswas','mahasiswa.id','absensi_mahasiswas.id_mahasiswa');
        $data = PengumumanDosen::leftjoin('pengumuman_dosen','absensi_mahasiswas.id_jadwal', 'pengumuman_dosen.id_jadwal');
        $data = $data->select('pengumuman_dosen.*')->get();

        return redirect()->back()->with([
                'warning' => $data->isi
            ]);
    }


    public function get_data_pengumuman(Request $request)
    {
        $search_filter = strtoupper($request->input('search_filter'));

        $lm =  GlobalFunction::instance()->defaultlimitpage;
        $limit = ($request->input('limit') == null ? $lm : $request->input('limit'));
        $order = ($request->input('order') == null ? 'judul desc' : $request->input('order'));

        $siswa = Mahasiswa::where('user_id', '=', Auth::id())->first();
        $data = PengumumanDosen::leftjoin('jadwals','jadwals.id', 'pengumuman_dosen.id_jadwal')->where('jadwals.kelas_id', '=', $siswa->kelas_id);
        $data = $data->leftjoin('kelas', 'jadwals.kelas_id', 'kelas.id');
        $data = $data->leftjoin('mapel', 'jadwals.mapel_id', 'mapel.id');
        $data = $data->select('pengumuman_dosen.*', 'jadwals.*', 'kelas.nama_kelas as kelas', 'mapel.nama_mapel as mapel');

        if ($search_filter != null) {
            $data = $data->where(function ($where) use ($search_filter) {
                $where = $where->orWhere(DB::Raw('judul'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('isi'), 'like', '%' . $search_filter . '%');
                
            });
        }
        $data = $data->orderByRaw($order)->paginate($limit);

        if ($data) {
            $response = [
                'message'        => 'List E-Book',
                'data'         => $data
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                'message'        => 'Not Found'
            ];

            return response()->json($response, 404);
        }

        $response = [
            'message'        => 'An Error Occured'
        ];

        return response()->json($response, 500);
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
     * @param  \App\DashboardSiswa  $dashboardSiswa
     * @return \Illuminate\Http\Response
     */
    public function show(DashboardSiswa $dashboardSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DashboardSiswa  $dashboardSiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(DashboardSiswa $dashboardSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DashboardSiswa  $dashboardSiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DashboardSiswa $dashboardSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DashboardSiswa  $dashboardSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(DashboardSiswa $dashboardSiswa)
    {
        //
    }
}