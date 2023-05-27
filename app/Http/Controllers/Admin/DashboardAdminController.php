<?php

namespace App\Http\Controllers\Admin;

use App\DashboardAdmin;
use App\Models\DataOrangTua;
use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\KalenderAkademik;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Event;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\MataPelajaran;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Pengumuman;
use App\Models\Prodi;
use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;

class DashboardAdminController extends Controller
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
        // $events = Event::orderBy('created_at', 'DESC')->get();
        $kelas = Kelas::all();
        $siswa = Mahasiswa::all();
        $dosen = Dosen::all();
        $ruangan = Ruangan::all();
        $pegawai = Pegawai::all();
        $fakultas = Fakultas::all();
        $jurusan = Jurusan::all();
        $prodi = Prodi::all();
        $matkul = MataPelajaran::all();
        $pengeluaran = Pengeluaran::all();
        $pemasukan = Pemasukan::all();

        return view('admin.halamanutama.index', [
            'siswa' => $siswa,
            'dosen' => $dosen,
            'ruangan' => $ruangan,
            'pegawai' => $pegawai,
            'kelas' => $kelas,
            'jurusan' => $jurusan,
            'prodi' => $prodi,
            'fakultas' => $fakultas,
            'matkul' => $matkul,
            'pengeluaran' => $pengeluaran,
            'pemasukan' => $pemasukan
        ]);
    }

    public function indexPengumuman()
    {
        $data_pengumuman = Pengumuman::orderBy('tanggal_pengumuman', 'desc')->get();
        return view('admin.pengumuman.index', [
            'data_pengumuman' => $data_pengumuman
        ]);
    }


    public function storePengumuman(Request $request)
    {
        $this->validate($request, [
            'judul_pengumuman' => 'required',
            'isi_pengumuman' => 'required',
            'tanggal_pengumuman' => 'required'
        ]);

        Pengumuman::create([
            'judul_pengumuman' => $request->judul_pengumuman,
            'isi_pengumuman' => $request->isi_pengumuman,
            'tanggal_pengumuman' => $request->tanggal_pengumuman
        ]);

        return redirect()->back();
    }

    public function deletePengumuman($id)
    {
        try {
            $pengumuman = Pengumuman::find($id);
            $pengumuman->delete();
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'error' => $th->getMessage(),
            ]);
        }
    }

    public function updatePengumuman(Request $request, $id)
    {
        try {
            $pengumuman = Pengumuman::find($id);
            $pengumuman->update([
                'judul_pengumuman' => $request->judul_pengumuman,
                'isi_pengumuman' => $request->isi_pengumuman,
                'tanggal_pengumuman' => $request->tanggal_pengumuman
            ]);
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'error' => $th->getMessage(),
            ]);
        }
    }
    public function reminder()
    {
        // $reminders= KalenderAkademik::all();
        // $reminder=[];
        // foreach ($reminder as $row) {
        //   $tanggal_akhir = $row->tanggal_akhir."24:00:00";
        //   $reminder[]=\Calender::event(
        //     $row->title,
        //     true,
        //     new \DateTime($row->tanggal_mulai),
        //     new \DateTime($row->$tanggal_akhir),
        //     $row->id,[
        //       'color' => $row->color,
        //     ]
        //   );
        // }
        //
        // $calender = \Calender::addEvents($reminder);
        // return view('admin.halamanutama.reminder', compact('reminders','calender');
        return view('admin.halamanutama.reminder');
    }

    /**
     * Ambil data jumlah tiap kelas
     *
     */

    public function dataJumlahKelas($tingkat)
    {
        $kelas = Kelas::join('siswa', 'kelas.id', '=', 'siswa.kelas_id')
            ->select('kelas.nama_kelas', DB::raw('count("siswa.kelas_id") as jumlah'))
            ->where('kelas.tingkat', '=', $tingkat)
            ->groupBy('kelas.nama_kelas')
            ->get();
        // dd($kelas);
        return response()->json($kelas);
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
     * @param  \App\DashboardAdmin  $dashboardAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(DashboardAdmin $dashboardAdmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DashboardAdmin  $dashboardAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit(DashboardAdmin $dashboardAdmin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DashboardAdmin  $dashboardAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DashboardAdmin $dashboardAdmin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DashboardAdmin  $dashboardAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(DashboardAdmin $dashboardAdmin)
    {
        //
    }
}
