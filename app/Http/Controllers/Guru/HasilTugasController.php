<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Tugas;
use App\Models\Siswa;
use App\Models\HasilTugas;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\KrsMahasiswaEkstensi;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Gate;

class HasilTugasController extends Controller
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
        // if (Gate::denies('view-tugas')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $jenis_mapel = MataPelajaran::all();
        $tahun = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $jadwal = Jadwal::where('tahun_ajaran_id', $tahun->id)
        ->where('semester_id', $semester->id)
        ->where('id_dosen', $dosen->id)
        ->select('kelas_id');

        $data_kelas = Kelas::
        whereIn('id', $jadwal)
        ->orderBy('id', 'ASC')->get();
        

        $data_tugas = Tugas::where('created_by', $dosen->id)
            ->with('mapel', 'siswa')
            ->get();

        return view('guru.hasiltugas.index', [
            'data_kelas' => $data_kelas,
            'data_tugas' => $data_tugas
        ]);
    }

    /**
     * Ambil tugas dari ajax
     * 
     */

    public function ambil(Request $request)
    {

        // if (Gate::denies('manage-tugas')) {
        //     abort(403, 'User does not have the right permissions.');
        // }

        $tahun = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();

        $siswa = Mahasiswa::leftJoin('krs_mahasiswa_ekstensis', 'krs_mahasiswa_ekstensis.mahasiswa_id', '=', 'mahasiswa.id')

            ->where(function ($query) use ($request, $tahun, $semester) {
                $query->where('krs_mahasiswa_ekstensis.kelas_id', '=', $request->kelas_id)
                    ->orWhere('mahasiswa.kelas_id', '=', $request->kelas_id)
                    ->orWhere('krs_mahasiswa_ekstensis.tahun_ajaran_id', $tahun->id)
                    ->orWhere('krs_mahasiswa_ekstensis.semester_id', $semester->id);
            })
            ->get('mahasiswa.id');
        // $siswa = Mahasiswa::
        // where('kelas_id', '=' ,$request->kelas_id)->select('id');



        $hasil_tugas = HasilTugas::where('tugas_id', '=', $request->tugas_id)
            ->whereIn('siswa_id', $siswa)
            ->orderBy('created_at', 'DESC')
            ->get();

        return DataTables::of($hasil_tugas)
            ->addColumn('siswa', function ($hasil_tugas) {
                if ($hasil_tugas->mahasiswa) {
                    return $hasil_tugas->mahasiswa->nama_mahasiswa;
                } else {
                    return 'No data';
                }
            })
            // ->addColumn('kelas', function($hasil_tugas) {
            //     if ($hasil_tugas->mahasiswa) {
            //         return $hasil_tugas->mahasiswa->kelas->nama_kelas;
            //     } else {
            //         return 'No data';
            //     }
            // })
            ->addColumn('nama', function ($hasil_tugas) {
                if ($hasil_tugas->nama_file_tugas) {
                    return $hasil_tugas->nama_file_tugas;
                } else {
                    return 'No data';
                }
            })
            ->addColumn('tanggal', function ($hasil_tugas) {
                if ($hasil_tugas->created_at) {
                    return Carbon::parse($hasil_tugas->created_at)->format('d M Y H:i:s') . ' WIB';
                } else {
                    return 'No data';
                }
            })
            ->addColumn('action', function ($hasil_tugas) {
                if ($hasil_tugas->lokasi_file_tugas != null) {
                    $file = ($hasil_tugas->id);
                    return $file;
                } else {
                    return 'No data';
                }
            })

            ->make(true);
    }

    public function download($id)
    {
        $file = HasilTugas::find($id);

        return response()->download(storage_path("app/" . $file->lokasi_file_tugas));
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
