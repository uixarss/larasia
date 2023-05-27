<?php

namespace App\Http\Controllers\Guru;

use App\DashboardGuru;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use App\Models\AbsensiDosen;
use App\Models\AbsensiDosenSP;
use App\Models\AbsensiMahasiswaSP;
use App\Models\HasilTugas;
use App\Models\KalenderAkademik;
use App\Models\Tugas;
use App\Models\Pengumuman;
use Gate;
use Illuminate\Support\Facades\Date;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Guru;
use App\Models\Dosen;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\JadwalSP;
use App\Models\JadwalPengganti;
use App\Models\Kelas;
use App\Models\Pengampu;
use App\Models\Ruangan;
use App\Models\Waktu;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardGuruController extends Controller
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
        // if (Gate::denies('view-dosen')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $data_pengumuman = Pengumuman::where('tanggal_pengumuman', '>=', Date::today())
            ->orderBy('tanggal_pengumuman', 'ASC')
            ->paginate(5);
        $data_tugas = Tugas::where('created_by', Auth::id())
            ->select('id')->get();
        $data_hasil_tugas = HasilTugas::whereIn('tugas_id', $data_tugas)
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        $events = Event::where('start', '>=', Date::today())
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

        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        if ($tahun_ajaran == null || $semester == null) {
            $tahun_ajaran = '';
            $semester = '';
        }
        $guru = Dosen::where('user_id', Auth::id())->first();
        $data_jadwal = Jadwal::where('id_dosen', $guru->id)
            ->where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->where('hari_id', $hari_id->id)
            // ->groupBy('hari_id')
            ->with('hari', 'waktu', 'kelas', 'semester', 'tahunajaran', 'mapel')
            ->get();

        $pertemuan = AbsensiDosen::where('id_tahun_ajaran', $tahun_ajaran->id)
            ->where('id_semester', $semester->id)->where('id_dosen', $guru->id)
            ->where('hari_id', $hari_id->id)->orderBy('pertemuan_ke', 'desc')->value('pertemuan_ke');
        // dd($pertemuan);

        $data_jadwal_pengganti_hari_ini = JadwalPengganti::where('id_dosen', $guru->id)
            ->where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->where('hari_id', $hari_id->id)
            ->where('tanggal_pengganti', date("Y-m-d"))
            ->where('status', 'diterima')
            ->get();
        $data_jadwal_pengganti = JadwalPengganti::where('id_dosen', $guru->id)
            ->where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->get();

        $data_pengampu = Pengampu::where('id_dosen', $guru->id)
            ->where('id_tahun_ajaran', $tahun_ajaran->id)->where('id_semester', $semester->id)
            ->get();

        $data_kelas = Kelas::all();
        $data_ruangan = Ruangan::all();
        $data_hari = Hari::all();
        $data_waktu = Waktu::all();

        $data_sp = JadwalSP::where('id_dosen', $guru->id)
            ->where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->where('hari_id', $hari_id->id)
            // ->groupBy('hari_id')
            ->with('hari', 'waktu', 'semester', 'tahunajaran', 'mapel')
            ->get();

        return view('guru.halamanutama.index', [
            'events' => $events,
            'data_pengumuman' => $data_pengumuman,
            'data_hasil_tugas' => $data_hasil_tugas,
            'data_jadwal' => $data_jadwal,
            'pertemuan_ke' => $pertemuan,
            'data_jadwal_pengganti' => $data_jadwal_pengganti,
            'data_jadwal_pengganti_hari_ini' => $data_jadwal_pengganti_hari_ini,
            'data_pengampu' => $data_pengampu,
            'data_kelas' => $data_kelas,
            'data_ruangan' => $data_ruangan,
            'data_hari' => $data_hari,
            'data_waktu' => $data_waktu,
            'data_sp' => $data_sp
        ]);
    }
}
