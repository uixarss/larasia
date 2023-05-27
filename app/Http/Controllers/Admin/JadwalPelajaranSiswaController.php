<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Waktu;
use App\JadwalPelajaranSiswa;
use App\Models\Guru;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class JadwalPelajaranSiswaController extends Controller
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
        $data_kelas = Kelas::all();
        $data_mapel = MataPelajaran::all();
        $tahun_ajaran = TahunAjaran::all();
        $data_semester = Semester::all();
        $data_hari = Hari::all();
        $data_waktu = Waktu::all();
        $data_guru = Guru::all();

        $data_jadwal = Jadwal::all();

        return view('admin.jadwalpelajaransiswa.index', [
            'data_kelas' => $data_kelas,
            'data_mapel'    => $data_mapel,
            'tahun_ajaran'  => $tahun_ajaran,
            'data_semester' => $data_semester,
            'data_hari' => $data_hari,
            'data_waktu'    => $data_waktu,
            'data_jadwal' => $data_jadwal,
            'data_guru' => $data_guru
        ]);
    }

    /**
     * Tambah Jadwal Pelajaran
     * 
     */
    public function tambahpelajaran(Request $request)
    {
        $valid = $this->validate($request, [
            'tahunajaran_id' => 'required',
            'semester_id' => 'required',
            'mapel_id' => 'required',
            'kelas_id' => 'required',
            'hari_id' => 'required',
            'waktu_id' => 'required',
            'keterangan' => 'required'
        ]);

        if (!$valid) {
            return back()->with('error', 'Data tidak lengkap');
        }


        $schedules = Jadwal::select(DB::raw('hari_id, waktu_id, kelas_id, tahun_ajaran_id, semester_id, count(*) as `jumlah`'))
            ->where('tahun_ajaran_id', $request->tahunajaran_id)
            ->where('semester_id', $request->semester_id)
            ->where('hari_id', $request->hari_id)
            ->where('waktu_id', $request->waktu_id)
            ->where('kelas_id', $request->kelas_id)
            ->where('keterangan', $request->keterangan)
            ->where('mapel_id', $request->mapel_id)
            ->groupBy('hari_id')
            ->groupBy('waktu_id')
            ->groupBy('kelas_id')
            ->groupBy('tahun_ajaran_id')
            ->groupBy('semester_id')
            ->having('jumlah', '>', 1)
            ->get();



        if (!$schedules) {
            return back()->with('error', 'Data sudah ada sebelumnya');

        } else {
            $jadwal = new Jadwal();
            $jadwal->tahun_ajaran_id = $request->tahunajaran_id;
            $jadwal->semester_id = $request->semester_id;
            $jadwal->mapel_id = $request->mapel_id;
            $jadwal->kelas_id = $request->kelas_id;
            $jadwal->hari_id = $request->hari_id;
            $jadwal->waktu_id = $request->waktu_id;
            $jadwal->keterangan = $request->keterangan;
            $jadwal->save();
        }


        return redirect()->back();
    }

    public function updateJadwal(Request $request, $tahun_ajaran_id, $semester_id, $kelas_id, $hari_id)
    {
        $jadwal = Jadwal::where('tahun_ajaran_id', $tahun_ajaran_id)
        ->where('semester_id', $semester_id)
        ->where('kelas_id', $kelas_id)
        ->where('hari_id', $hari_id)
        ->where('waktu_id', $request->waktu_id)->first();

        if(!$jadwal){
            return back();
        }

        $jadwal->guru_id = $request->guru_id;
        $jadwal->mapel_id = $request->mapel_id;
        $jadwal->save();

        return redirect()->back();

    }
    /**
     * Ambil Data Jadwal
     * 
     */
    public function ambilJadwal(Request $request)
    {
        $data_jadwal = Jadwal::where('kelas_id', $request->kelas_id)
            ->where('tahun_ajaran_id', $request->tahunajaran_id)
            ->where('semester_id', $request->semester_id)
            ->where('hari_id', $request->hari_id)
            ->with('mapel', 'kelas', 'guru', 'waktu', 'hari', 'waktu')
            ->get();

        return DataTables::of($data_jadwal)

            ->addColumn('waktu', function ($data_jadwal) {
                if ($data_jadwal->waktu) {
                    return $data_jadwal->waktu->jam_masuk . ' - ' . $data_jadwal->waktu->jam_keluar;
                } else {
                    return 'No data';
                }
            })
            ->addColumn('mapel', function ($data_jadwal) {
                if ($data_jadwal->mapel) {
                    return $data_jadwal->mapel->nama_mapel;
                } else {
                    return 'No data';
                }
            })
            ->addColumn('guru', function ($data_jadwal) {
                if ($data_jadwal->guru) {
                    return $data_jadwal->guru->nama_lengkap;
                } else {
                    return 'No data';
                }
            })
            ->addColumn('type', function($data_jadwal) {
                return 'tipe '.$data_jadwal->type;
            })

            ->rawColumns(['Jam Pelajaran', 'Mata Pelajaran', 'Guru','Action'])

            ->make(true);
        // return redirect()->route('admin.jadwalpelajaransiswa')->with('data_jadwal', $data_jadwal);
        // return response()->json($data_jadwal);
    }


    public function checkPenalty(Request $request)
    {
        $schedules = Jadwal::select(DB::raw('hari_id, waktu_id, kelas_id, tahun_ajaran_id, semester_id, count(*) as `jumlah`'))
            ->where('tahun_ajaran_id', $request->tahunajaran_id)
            ->where('semester_id', $request->semester_id)
            ->where('hari_id', $request->hari_id)
            ->where('waktu_id', $request->waktu_id)
            ->where('kelas_id', $request->kelas_id)
            ->groupBy('hari_id')
            ->groupBy('waktu_id')
            ->groupBy('kelas_id')
            ->groupBy('tahun_ajaran_id')
            ->groupBy('semester_id')
            ->having('jumlah', '>', 1)
            ->get();
        // dd($schedules);

        return $schedules;
    }

}
