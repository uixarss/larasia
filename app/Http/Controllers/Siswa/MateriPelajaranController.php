<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\MateriPelajaran;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\KelasMahasiswa;
use App\Models\KrsMahasiswaEkstensi;
use App\Models\Mahasiswa;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\DB;

class MateriPelajaranController extends Controller
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
        $siswa = Mahasiswa::where('user_id', Auth::id())->first();
        $data_materi_pelajaran = MateriPelajaran::orderBy('id', 'DESC')->get();

        // $data_materi_pelajaran_kelas = DB::table('materi_kelas')->get();
        $tahun = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        if ($tahun == null || $semester == null) {
            abort(403, 'Tahun Ajaran tidak ada yang aktif!');
        }

        $data_ekstensi = KrsMahasiswaEkstensi::where('tahun_ajaran_id', $tahun->id)
            ->where('semester_id', $semester->id)
            ->where('mahasiswa_id', $siswa->id)->get();


        return view('siswa.materipelajaran.index', [
            'data_materi_pelajaran' => $data_materi_pelajaran,
            'siswa' => $siswa,
            'data_ekstensi' => $data_ekstensi
            // 'data_materi_pelajaran_kelas' => $data_materi_pelajaran_kelas
        ]);
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
