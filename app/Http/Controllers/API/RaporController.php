<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DataOrangTua;
use App\Models\Guru;
use App\Models\Kkm;
use App\Models\NilaiRapor;
use App\Models\NilaiRaporSiswa;
use App\Models\NilaiHarian;
use App\Models\Quiz;
use App\Models\Semester;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RaporController extends Controller
{

    /**
     * 
     * Rapor Siswa 
     * 
     */
    public function listTahunAjaran()
    {
        $tahun_ajaran = TahunAjaran::all();

        return response()->json($tahun_ajaran);
    }
    public function listSemester()
    {
        $semester = Semester::all();

        return response()->json($semester);
    }

    public function listRapor()
    {
        $siswa = Siswa::where('user_id', Auth::id())->first();
        $rapor = NilaiRapor::where('nis', $siswa->NIS)->get();


        return response()->json($rapor);
    }
    public function listRaporSiswa(Request $request)
    {
        $siswa = Siswa::where('user_id', Auth::id())->first();
        $rapor = NilaiRapor::where('tahun_ajaran', $request->tahun_ajaran)
            ->where('semester', $request->semester)
            ->where('nis', $siswa->NIS)->first();

        $detail_rapor = $rapor->raporSiswa;

        $data['rapor'] = $rapor;


        return response()->json($rapor);
    }




    /**
     * List Guru
     * 
     */
    public function listGuru()
    {
        $data_guru = Guru::with('mapel')->get();

        return response()->json($data_guru);
    }

    /**
     * Data Nilai Siswa
     * 
     * 
     */
    public function listNilai($guru_id)
    {
        $guru = Guru::find($guru_id);
        $siswa = Siswa::where('user_id', Auth::id())->first();

        ////////////////////////////////////////////////////////////////////////////////////////
        // Nilai Harian (NILAI TUGAS)
        $data_nilai_harian = NilaiHarian::where('siswa_id', $siswa->id)
            ->where('guru_id', $guru->id)
            ->where('mapel_id', $guru->mapel_id)
            // ->whereMonth('created_at' ,$month)
            ->get();

        $avg_harian_rata_rata = NilaiHarian::where('siswa_id', $siswa->id)
            ->where('guru_id', $guru->id)
            ->where('mapel_id', $guru->mapel_id)
            ->avg('nilai_harian');

        if ($avg_harian_rata_rata == 100) {
            $nilai_harian_rata_rata = substr($avg_harian_rata_rata, 0, 6);
        } else {
            $nilai_harian_rata_rata = substr($avg_harian_rata_rata, 0, 5);
        }

        $data['data_nilai_harian'] = $data_nilai_harian;
        $data['nilai_harian_rata_rata'] = $nilai_harian_rata_rata;

        // dd($nilai_harian_rata_rata);

        /////////////////////////////////////////////////////////////////////////////////

        // Nilai QUIZ
        $data_quiz = Quiz::where('jenisujian_id', '1')
            ->where('dibuat_oleh', $guru->user_id)
            ->where('mapel_id', $guru->mapel_id)
            ->with('kelas')->get();

        $arr_quiz = [];
        foreach ($data_quiz as  $quiz) {
            $nilai_quiz = $quiz->result_quizzes->whereIn('quiz_id', $quiz)
                ->where('siswa_id', $siswa->id)
                ->max('nilai_akhir');
            array_push($arr_quiz, $nilai_quiz);
        }
        $arr_quiz = array_filter($arr_quiz);
        $avg_arr_quiz = 0;
        if (count($arr_quiz) > 0) {
            $avg_arr_quiz = array_sum($arr_quiz) / count($arr_quiz);
        }

        if ($avg_arr_quiz == 100) {
            $avg_quiz = substr($avg_arr_quiz, 0, 6);
        } else {
            $avg_quiz = substr($avg_arr_quiz, 0, 5);
        }

        $data['data_quiz'] = $data_quiz;
        $data['avg_quiz'] = $avg_quiz;

        // dd($avg_quiz);

        /////////////////////////////////////////////////////////////////////////////////

        // Nilai UTS
        $data_uts = Quiz::where('jenisujian_id', '2')
            ->where('dibuat_oleh', $guru->user_id)
            ->where('mapel_id', $guru->mapel_id)
            ->with('kelas')->get();

        $arr_uts = [];
        foreach ($data_uts as  $uts) {
            $nilai_uts = $uts->result_quizzes->whereIn('quiz_id', $uts)
                ->where('siswa_id', $siswa->id)
                ->max('nilai_akhir');
            array_push($arr_uts, $nilai_uts);
        }
        $arr_uts = array_filter($arr_uts);
        $avg_arr_uts = 0;
        if (count($arr_uts)) {
            $avg_arr_uts = array_sum($arr_uts) / count($arr_uts);
        }

        if ($avg_arr_uts == 100) {
            $avg_uts = substr($avg_arr_uts, 0, 6);
        } else {
            $avg_uts = substr($avg_arr_uts, 0, 5);
        }
        // dd($arr_uts);
        $data['data_uts'] = $data_uts;
        $data['avg_uts'] = $avg_uts;

        /////////////////////////////////////////////////////////////////////////////////

        // Nilai UAS
        $data_uas = Quiz::where('jenisujian_id', '3')
            ->where('dibuat_oleh', $guru->user_id)
            ->where('mapel_id', $guru->mapel_id)
            ->with('kelas')->get();

        $arr_uas = [];
        foreach ($data_uas as  $uas) {
            $nilai_uas = $uas->result_quizzes->whereIn('quiz_id', $uas)
                ->where('siswa_id', $siswa->id)
                ->max('nilai_akhir');
            array_push($arr_uas, $nilai_uas);
        }
        $arr_uas = array_filter($arr_uas);
        $avg_arr_uas = 0;
        if (count($arr_uas) > 0) {
            $avg_arr_uas = array_sum($arr_uas) / count($arr_uas);
        }

        if ($avg_arr_uas == 100) {
            $avg_uas = substr($avg_arr_uas, 0, 6);
        } else {
            $avg_uas = substr($avg_arr_uas, 0, 5);
        }
        $data['data_uas'] = $data_uas;
        $data['avg_uas'] = $avg_uas;
        
        $kkm = Kkm::where('mapel_id', $guru->mapel_id)->first();
        $data['kkm'] = $kkm;

        return response()->json($data);
    }

    /**
     * 
     * Data nilai siswa untuk ortu
     * 
     */
    public function ortulistNilai($guru_id)
    {
        $guru = Guru::find($guru_id);
        $ortu = DataOrangTua::where('user_id', Auth::id())->first();
        $siswa = Siswa::where('id', $ortu->siswa_id)->first();
        ////////////////////////////////////////////////////////////////////////////////////////
        // Nilai Harian (NILAI TUGAS)
        $data_nilai_harian = NilaiHarian::where('siswa_id', $siswa->id)
            ->where('guru_id', $guru->id)
            ->where('mapel_id', $guru->mapel_id)
            // ->whereMonth('created_at' ,$month)
            ->get();

        $avg_harian_rata_rata = NilaiHarian::where('siswa_id', $siswa->id)
            ->where('guru_id', $guru->id)
            ->where('mapel_id', $guru->mapel_id)
            ->avg('nilai_harian');

        if ($avg_harian_rata_rata == 100) {
            $nilai_harian_rata_rata = substr($avg_harian_rata_rata, 0, 6);
        } else {
            $nilai_harian_rata_rata = substr($avg_harian_rata_rata, 0, 5);
        }

        $data['data_nilai_harian'] = $data_nilai_harian;
        $data['nilai_harian_rata_rata'] = $nilai_harian_rata_rata;

        // dd($nilai_harian_rata_rata);

        /////////////////////////////////////////////////////////////////////////////////

        // Nilai QUIZ
        $data_quiz = Quiz::where('jenisujian_id', '1')
            ->where('dibuat_oleh', $guru->user_id)
            ->where('mapel_id', $guru->mapel_id)
            ->with('kelas')->get();

        $arr_quiz = [];
        foreach ($data_quiz as  $quiz) {
            $nilai_quiz = $quiz->result_quizzes->whereIn('quiz_id', $quiz)
                ->where('siswa_id', $siswa->id)
                ->max('nilai_akhir');
            array_push($arr_quiz, $nilai_quiz);
        }
        $arr_quiz = array_filter($arr_quiz);
        $avg_arr_quiz = 0;
        if (count($arr_quiz) > 0) {
            $avg_arr_quiz = array_sum($arr_quiz) / count($arr_quiz);
        }

        if ($avg_arr_quiz == 100) {
            $avg_quiz = substr($avg_arr_quiz, 0, 6);
        } else {
            $avg_quiz = substr($avg_arr_quiz, 0, 5);
        }

        $data['data_quiz'] = $data_quiz;
        $data['avg_quiz'] = $avg_quiz;

        // dd($avg_quiz);

        /////////////////////////////////////////////////////////////////////////////////

        // Nilai UTS
        $data_uts = Quiz::where('jenisujian_id', '2')
            ->where('dibuat_oleh', $guru->user_id)
            ->where('mapel_id', $guru->mapel_id)
            ->with('kelas')->get();

        $arr_uts = [];
        foreach ($data_uts as  $uts) {
            $nilai_uts = $uts->result_quizzes->whereIn('quiz_id', $uts)
                ->where('siswa_id', $siswa->id)
                ->max('nilai_akhir');
            array_push($arr_uts, $nilai_uts);
        }
        $arr_uts = array_filter($arr_uts);
        $avg_arr_uts = 0;
        if (count($arr_uts)) {
            $avg_arr_uts = array_sum($arr_uts) / count($arr_uts);
        }

        if ($avg_arr_uts == 100) {
            $avg_uts = substr($avg_arr_uts, 0, 6);
        } else {
            $avg_uts = substr($avg_arr_uts, 0, 5);
        }
        // dd($arr_uts);
        $data['data_uts'] = $data_uts;
        $data['avg_uts'] = $avg_uts;

        /////////////////////////////////////////////////////////////////////////////////

        // Nilai UAS
        $data_uas = Quiz::where('jenisujian_id', '3')
            ->where('dibuat_oleh', $guru->user_id)
            ->where('mapel_id', $guru->mapel_id)
            ->with('kelas')->get();

        $arr_uas = [];
        foreach ($data_uas as  $uas) {
            $nilai_uas = $uas->result_quizzes->whereIn('quiz_id', $uas)
                ->where('siswa_id', $siswa->id)
                ->max('nilai_akhir');
            array_push($arr_uas, $nilai_uas);
        }
        $arr_uas = array_filter($arr_uas);
        $avg_arr_uas = 0;
        if (count($arr_uas) > 0) {
            $avg_arr_uas = array_sum($arr_uas) / count($arr_uas);
        }

        if ($avg_arr_uas == 100) {
            $avg_uas = substr($avg_arr_uas, 0, 6);
        } else {
            $avg_uas = substr($avg_arr_uas, 0, 5);
        }
        $data['data_uas'] = $data_uas;
        $data['avg_uas'] = $avg_uas;

        return response()->json($data);
    }
    /**
     * 
     * Rapor Siswa 
     * untuk Ortu
     * 
     */
    public function ortulistRapor()
    {
        $ortu = DataOrangTua::where('user_id', Auth::id())->first();
        $siswa = Siswa::where('id', $ortu->siswa_id)->first();
        $rapor = NilaiRapor::where('nis', $siswa->NIS)->get();


        return response()->json($rapor);
    }
    public function ortulistRaporSiswa(Request $request)
    {
        $ortu = DataOrangTua::where('user_id', Auth::id())->first();
        $siswa = Siswa::where('id', $ortu->siswa_id)->first();
        $rapor = NilaiRapor::where('tahun_ajaran', $request->tahun_ajaran)
            ->where('semester', $request->semester)
            ->where('nis', $siswa->NIS)->first();

        $detail_rapor = $rapor->raporSiswa;

        $data['rapor'] = $rapor;


        return response()->json($rapor);
    }


    /**
     * Data nilai siswa dari sisi guru
     * 
     */
    public function listNilaiKelas()
    {

       $tahun_ajaran = TahunAjaran::where('status', '1')->first();
       $semester = Semester::where('status', '1')->first();
       $guru = Guru::where('user_id', '=', Auth::id())->first();
       $data_jadwal = Jadwal::where('guru_id', $guru->id)
           ->where('tahun_ajaran_id', $tahun_ajaran->id)
           ->where('semester_id', $semester->id)
           ->select('kelas_id')
           ->with('kelas')
           ->distinct()
           ->get();
       return response()->json($data_jadwal);
    }

    public function listSiswaKelas($kelas_id)
    {
        $data_siswa = Siswa::where('kelas_id', $kelas_id)
        ->select('id','nama_depan', 'nama_belakang')
        ->get();

        return response()->json($data_siswa);
    }

    public function listNilaiSiswa($siswa_id)
    {
        $guru = Guru::where('user_id', Auth::id())->first();
        $siswa = Siswa::find($siswa_id);

        ////////////////////////////////////////////////////////////////////////////////////////
        // Nilai Harian (NILAI TUGAS)
        $data_nilai_harian = NilaiHarian::where('siswa_id', $siswa->id)
            ->where('guru_id', $guru->id)
            ->where('mapel_id', $guru->mapel_id)
            ->with('mapel','guru')
            // ->whereMonth('created_at' ,$month)
            ->get();

        $avg_harian_rata_rata = NilaiHarian::where('siswa_id', $siswa->id)
            ->where('guru_id', $guru->id)
            ->where('mapel_id', $guru->mapel_id)
            ->avg('nilai_harian');

        if ($avg_harian_rata_rata == 100) {
            $nilai_harian_rata_rata = substr($avg_harian_rata_rata, 0, 6);
        } else {
            $nilai_harian_rata_rata = substr($avg_harian_rata_rata, 0, 5);
        }

        $data['data_nilai_harian'] = $data_nilai_harian;
        $data['nilai_harian_rata_rata'] = $nilai_harian_rata_rata;

        // dd($nilai_harian_rata_rata);

        /////////////////////////////////////////////////////////////////////////////////

        // Nilai QUIZ
        $data_quiz = Quiz::where('jenisujian_id', '1')
            ->where('dibuat_oleh', $guru->user_id)
            ->where('mapel_id', $guru->mapel_id)

            ->with('kelas')->get();

        $arr_quiz = [];
        foreach ($data_quiz as  $quiz) {
            $nilai_quiz = $quiz->result_quizzes->whereIn('quiz_id', $quiz)
                ->where('siswa_id', $siswa->id)
                ->max('nilai_akhir');
            array_push($arr_quiz, $nilai_quiz);
        }
        $arr_quiz = array_filter($arr_quiz);
        $avg_arr_quiz = 0;
        if (count($arr_quiz) > 0) {
            $avg_arr_quiz = array_sum($arr_quiz) / count($arr_quiz);
        }

        if ($avg_arr_quiz == 100) {
            $avg_quiz = substr($avg_arr_quiz, 0, 6);
        } else {
            $avg_quiz = substr($avg_arr_quiz, 0, 5);
        }

        $data['data_quiz'] = $data_quiz;
        $data['avg_quiz'] = $avg_quiz;

        // dd($avg_quiz);

        /////////////////////////////////////////////////////////////////////////////////

        // Nilai UTS
        $data_uts = Quiz::where('jenisujian_id', '2')
            ->where('dibuat_oleh', $guru->user_id)
            ->where('mapel_id', $guru->mapel_id)
            ->with('kelas')->get();

        $arr_uts = [];
        foreach ($data_uts as  $uts) {
            $nilai_uts = $uts->result_quizzes->whereIn('quiz_id', $uts)
                ->where('siswa_id', $siswa->id)
                ->max('nilai_akhir');
            array_push($arr_uts, $nilai_uts);
        }
        $arr_uts = array_filter($arr_uts);
        $avg_arr_uts = 0;
        if (count($arr_uts)) {
            $avg_arr_uts = array_sum($arr_uts) / count($arr_uts);
        }

        if ($avg_arr_uts == 100) {
            $avg_uts = substr($avg_arr_uts, 0, 6);
        } else {
            $avg_uts = substr($avg_arr_uts, 0, 5);
        }
        // dd($arr_uts);
        $data['data_uts'] = $data_uts;
        $data['avg_uts'] = $avg_uts;

        /////////////////////////////////////////////////////////////////////////////////

        // Nilai UAS
        $data_uas = Quiz::where('jenisujian_id', '3')
            ->where('dibuat_oleh', $guru->user_id)
            ->where('mapel_id', $guru->mapel_id)
            ->with('kelas')->get();

        $arr_uas = [];
        foreach ($data_uas as  $uas) {
            $nilai_uas = $uas->result_quizzes->whereIn('quiz_id', $uas)
                ->where('siswa_id', $siswa->id)
                ->max('nilai_akhir');
            array_push($arr_uas, $nilai_uas);
        }
        $arr_uas = array_filter($arr_uas);
        $avg_arr_uas = 0;
        if (count($arr_uas) > 0) {
            $avg_arr_uas = array_sum($arr_uas) / count($arr_uas);
        }

        if ($avg_arr_uas == 100) {
            $avg_uas = substr($avg_arr_uas, 0, 6);
        } else {
            $avg_uas = substr($avg_arr_uas, 0, 5);
        }
        $data['data_uas'] = $data_uas;
        $data['avg_uas'] = $avg_uas;
        
        $kkm = Kkm::where('mapel_id', $guru->mapel_id)->first();
        $data['kkm'] = $kkm;

        return response()->json($data);
    }
}
