<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use App\NilaiSiswa;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Guru;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Siswa;
use App\Models\TahunAjaranGuruKelas;
use App\Models\NilaiHarian;
use App\Models\NilaiAkhir;
use App\Models\GradeNilai;
use App\Models\Quiz;
use App\Models\ResultQuiz;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class NilaiSiswaController extends Controller
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
        $data_guru = Guru::all();

        $kelas_id = Kelas::where('id', 1)->first(); //kelas 10 MIA 1
        $guru_id = Guru::where('user_id', 878)->first(); //guru user
        $mapel_id = MataPelajaran::where('id', 1)->first(); //mapel matematik

        // $data_kelas_mapel = TahunAjaranGuruKelas::all();

        $tahun_ajaran = TahunAjaran::where('status', '1')
            //   where('start_date', '>', now())
            //   ->orWhere('end_date', '<', now())
            ->first();

        $semester = Semester::where('status', 1)->first();

        $data_kelas_mapel = TahunAjaranGuruKelas::where('tahun_ajaran_id', $tahun_ajaran->id)
            ->get();

        $data_siswa = Siswa::where('kelas_id', $kelas_id->id)->get();

        $data_quiz = Quiz::where('jenisujian_id', '1')
            ->where('dibuat_oleh', $guru_id->user_id)
            ->where('mapel_id', $guru_id->mapel_id)
            ->with('kelas')->get();

        $data_uts = Quiz::where('jenisujian_id', '2')
            ->where('dibuat_oleh', $guru_id->user_id)
            ->where('mapel_id', $guru_id->mapel_id)
            ->with('kelas')->get();

        $data_uas = Quiz::where('jenisujian_id', '3')
            ->where('dibuat_oleh', $guru_id->user_id)
            ->where('mapel_id', $guru_id->mapel_id)
            ->with('kelas')->get();

        //   dd($data_quiz);

        return view('admin.nilaisiswa.index', compact(
            'data_kelas',
            'data_mapel',
            'data_kelas_mapel',
            'data_quiz',
            'data_siswa',
            'data_uts',
            'data_uas'
        ));
    }
    
    public function pilihMapel(Request $request, $id)
    {

        $data_kelas = Kelas::find($id);

        // $data_siswa = Siswa::where('kelas_id', $data_kelas->id)->get();
        //
        // $data_mapel = MataPelajaran::all();
        //
        //
        $mapel = MataPelajaran::where('id', $request->id)->first();

        return response()->json($mapel);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\NilaiSiswa  $nilaiSiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data_kelas = Kelas::find($id);

        $tahun_ajaran = TahunAjaran::
            // where('status', true)
            where('start_date', '>', now())
            ->orWhere('end_date', '<', now())
            ->first();

        $semester = Semester::where('id', $tahun_ajaran->id)->first();

        $grade_nilai = GradeNilai::all();

        $data_guru = Guru::all();

        $data_siswa = Siswa::where('kelas_id', $data_kelas->id)
            ->with('nilai_akhir.mapel')
            ->with('nilai_harian.mapel')
            ->get();

        $guru_id = Guru::where('id', $request->guru_id)->first();

        /////////////////////////////////////////////////////////////////////////////////////////////////

        $arr = [];
        foreach ($data_siswa as $key => $siswa) {
            $sum_nilai_harian1 = DB::table('nilai_harian')
                ->where('siswa_id', $siswa->id)
                ->where('mapel_id', $guru_id->mapel_id)
                ->where('tahun_ajaran_id', $tahun_ajaran->id)
                ->where('semester_id', $semester->id)
                ->avg('nilai_harian');

            if ($sum_nilai_harian1 == 100) {
                $sum_nilai_harian = substr($sum_nilai_harian1, 0, 6);
            } else {
                $sum_nilai_harian = substr($sum_nilai_harian1, 0, 5);
            }

            $tahun_ajaran = TahunAjaran::
                // where('status', true)
                where('start_date', '>', now())
                ->orWhere('end_date', '<', now())
                ->first();

            $semester = Semester::where('id', $tahun_ajaran->id)->first();

            $arr2 = [
                'id' => $siswa->id,
                'nilai_rata2' => $sum_nilai_harian,
                'guru_id' => $guru_id->id,
                'mapel_id' => $guru_id->mapel_id,
                'tahun_ajaran_id' => $tahun_ajaran->id,
                'semester_id' => $semester->id,
            ];
            array_push($arr, $arr2);
        }

        // dd($arr);

        ////////////////////////////////////////////////////////////////////////////////////////////////


        return view('admin.nilaisiswa.show', compact(
            'data_kelas',
            'tahun_ajaran',
            'semester',
            'data_siswa',
            'grade_nilai',
            'data_guru',
            'guru_id',
            'arr'

        ));
    }



}
