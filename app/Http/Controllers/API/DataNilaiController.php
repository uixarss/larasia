<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Mahasiswa;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Models\Jadwal;
use App\Models\Quiz;
use App\Models\Tugas;
use App\Models\NilaiTugas;
use App\Models\ResultQuiz;

class DataNilaiController extends Controller
{
    public function getMatkul(){
        
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();

        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        $matakuliah  = Jadwal::where('kelas_id', $mahasiswa->kelas_id)
                        ->where('tahun_ajaran_id',$tahun_ajaran->id)
                        ->where('semester_id',$semester->id)
                        ->groupBy('mapel_id')
                        ->with('mapel','dosen', 'tahunajaran', 'semester')
                        ->get();

        return response()->json($matakuliah);

    }

    public function getNilaiTugas(Request $request)
    {
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();

        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        $data_tugas = Tugas::where('mapel_id', $request->mapel_id)
                            ->with('kelas', 'mapel')
                            ->where('id_tahun_ajaran', $tahun_ajaran->id)
                            ->where('id_semester', $semester->id)->get();

        $arr=[];
        foreach ($data_tugas as $key => $tugas) {
            foreach ($tugas->kelas as $kelas) {
            if ($mahasiswa->kelas_id == $kelas->id) {

                $nilai = "0";

                if(NilaiTugas::where('tugas_id', $tugas->id)->where('mahasiswa_id', $mahasiswa->id)->count() > 0){
                    $result = NilaiTugas::where('tugas_id', $tugas->id)->where('mahasiswa_id', $mahasiswa->id)->first();
                    $nilai = $result->nilai_tugas;
                }

                $arr2 = [
                    'tugas_id'=> $tugas->id,
                    'nama_matkul' => $tugas->mapel->nama_mapel,
                    'kode_tugas'=> $tugas->kode_tugas,
                    'judul_tugas'=> $tugas->judul_tugas,
                    'tanggal_mulai' => $tugas->tanggal_mulai,
                    'tanggal_akhir' => $tugas->tanggal_akhir,
                    'mahasiswa_id'=> $mahasiswa->id,
                    'nilai' => $nilai
                ];
                array_push($arr, $arr2);
            }
            // dd($arr2);
            }
        }
        
        return response()->json($arr);
        
    }
    
    public function getNilaiKuis(Request $request)
    {
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        
        $data_kuis = Quiz::where('jenisujian_id','1')
                        ->where('mapel_id', $request->mapel_id)
                        ->with('kelas', 'mapel')
                        ->where('id_tahun_ajaran', $tahun_ajaran->id)
                        ->where('id_semester', $semester->id)->get();

        $arr=[];
        foreach ($data_kuis as $key => $kuis) {
            foreach ($kuis->kelas as $kelas) {
            if ($mahasiswa->kelas_id == $kelas->id) {

                $nilai = "0";

                if(ResultQuiz::where('quiz_id', $kuis->id)->where('siswa_id', $mahasiswa->id)->count() > 0){
                    $result = ResultQuiz::where('quiz_id', $kuis->id)->where('siswa_id', $mahasiswa->id)->first();
                    $nilai = $result->nilai_akhir;
                }

                $arr2 = [
                    'kuis_id'=> $kuis->id,
                    'nama_matkul' => $kuis->mapel->nama_mapel,
                    'kode_soal'=> $kuis->kode_soal,
                    'judul_kuis'=> $kuis->judul_kuis,
                    'tanggal_mulai' => $kuis->tanggal_mulai,
                    'tanggal_akhir' => $kuis->tanggal_akhir,
                    'mahasiswa_id'=> $mahasiswa->id,
                    'nilai' => $nilai
                ];
                array_push($arr, $arr2);
            }
            // dd($arr2);
            }
        }
        
        return response()->json($arr);
    }

    public function getNilaiUTS(Request $request)
    {
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        
        $data_kuis = Quiz::where('jenisujian_id','2')
                        ->where('mapel_id', $request->mapel_id)
                        ->with('kelas', 'mapel')
                        ->where('id_tahun_ajaran', $tahun_ajaran->id)
                        ->where('id_semester', $semester->id)->get();

        $arr=[];
        foreach ($data_kuis as $key => $kuis) {
            foreach ($kuis->kelas as $kelas) {
            if ($mahasiswa->kelas_id == $kelas->id) {

                $nilai = "0";

                if(ResultQuiz::where('quiz_id', $kuis->id)->where('siswa_id', $mahasiswa->id)->count() > 0){
                    $result = ResultQuiz::where('quiz_id', $kuis->id)->where('siswa_id', $mahasiswa->id)->first();
                    $nilai = $result->nilai_akhir;
                }

                $arr2 = [
                    'kuis_id'=> $kuis->id,
                    'nama_matkul' => $kuis->mapel->nama_mapel,
                    'kode_soal'=> $kuis->kode_soal,
                    'judul_kuis'=> $kuis->judul_kuis,
                    'tanggal_mulai' => $kuis->tanggal_mulai,
                    'tanggal_akhir' => $kuis->tanggal_akhir,
                    'mahasiswa_id'=> $mahasiswa->id,
                    'nilai' => $nilai
                ];
                array_push($arr, $arr2);
            }
            // dd($arr2);
            }
        }
        
        return response()->json($arr);
        
    }

    public function getNilaiUAS(Request $request)
    {
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        
        $data_kuis = Quiz::where('jenisujian_id','3')
                        ->where('mapel_id', $request->mapel_id)
                        ->with('kelas', 'mapel')
                        ->where('id_tahun_ajaran', $tahun_ajaran->id)
                        ->where('id_semester', $semester->id)->get();

        $arr=[];
        foreach ($data_kuis as $key => $kuis) {
            foreach ($kuis->kelas as $kelas) {
            if ($mahasiswa->kelas_id == $kelas->id) {

                $nilai = "0";

                if(ResultQuiz::where('quiz_id', $kuis->id)->where('siswa_id', $mahasiswa->id)->count() > 0){
                    $result = ResultQuiz::where('quiz_id', $kuis->id)->where('siswa_id', $mahasiswa->id)->first();
                    $nilai = $result->nilai_akhir;
                }

                $arr2 = [
                    'kuis_id'=> $kuis->id,
                    'nama_matkul' => $kuis->mapel->nama_mapel,
                    'kode_soal'=> $kuis->kode_soal,
                    'judul_kuis'=> $kuis->judul_kuis,
                    'tanggal_mulai' => $kuis->tanggal_mulai,
                    'tanggal_akhir' => $kuis->tanggal_akhir,
                    'mahasiswa_id'=> $mahasiswa->id,
                    'nilai' => $nilai
                ];
                array_push($arr, $arr2);
            }
            // dd($arr2);
            }
        }
        
        return response()->json($arr);

    }
}
