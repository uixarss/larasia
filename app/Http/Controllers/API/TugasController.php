<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\DataOrangTua;
use App\Models\HasilTugas;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\Quiz;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Guru;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Jadwal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;

class TugasController extends BaseController
{
    //

    /**
     * List Tugas dan Kuis untuk Siswa
     */
    public function list()
    {

        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first(); 
        
        $siswa = Mahasiswa::where('user_id', Auth::id())->first();
        $data_tugas = Tugas::join('tugas_kelas', 'tugas_kelas.tugas_id', '=', 'tugas.id')
            ->where('tugas_kelas.kelas_id', '=', $siswa->kelas_id)
            ->where('id_tahun_ajaran', $tahun_ajaran->id)
            ->where('id_semester', $semester->id)
            ->with(['mapel','user', 'dosen'])
            ->get();

        $data_quiz = Quiz::join('quiz_kelas', 'quiz_kelas.quiz_id', '=', 'quizzes.id')
            ->where('quiz_kelas.kelas_id', '=', $siswa->kelas_id)
            ->where('id_tahun_ajaran', $tahun_ajaran->id)
            ->where('id_semester', $semester->id)
            ->with(['mapel','user', 'dosen'])
            ->get();

        $data['tugas'] = $data_tugas;
        $data['kuis'] = $data_quiz;

        return response()->json($data);

    }

    public function download(Request $request, $tugas_id)
    {
        $file = Tugas::find($tugas_id);

        return response()->download(storage_path("app/".$file->lokasi_file_tugas));
    }

    /**
     * Upload tugas
     */
    public function upload($id, Request $request)
    {
        $siswa = Mahasiswa::where('user_id', Auth::id())->first();
        
        $this->validate($request,[
            'file_tugas' => 'required|max:2000|mimes:doc,pdf,docx'
        ]);

        if($request->hasFile('file_tugas')){
            $filenameWithExt = $request->file('file_tugas')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = str_replace(' ', '_', $filename);
            $extension = $request->file('file_tugas')->getClientOriginalExtension();
            $filenameSimpan = $siswa->NIS . '_' . $filename . '.' . $extension;
            $file_simpan = Storage::putFileAs('public/upload/tugas', $request->file('file_tugas'), $filenameSimpan);

            $data_upload = DB::table('tugas_upload_siswa')->insert([
                'tugas_id' => $id,
                'siswa_id' => $siswa->id,
                'nama_file_tugas' => $filenameSimpan,
                'lokasi_file_tugas' => $file_simpan,
                'created_at' => now(),
                'updated_at' => now()
            ]);
    
        } else {
            $data_upload = DB::table('tugas_upload_siswa')->insert([
                'tugas_id' => $id,
                'siswa_id' => $siswa->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return response()->json($data_upload);

    }

    /**
     * List File yang sudah di upload oleh siswa
     * 
     * 
     */
    public function listUpload()
    {
        $siswa = Mahasiswa::where('user_id', Auth::id())->first();
        $data_tugas = Tugas::join('tugas_upload_siswa','tugas.id','=','tugas_upload_siswa.tugas_id')
            ->where('tugas_upload_siswa.siswa_id', $siswa->id)
            ->select('tugas.mapel_id','tugas.kode_tugas','tugas.judul_tugas','tugas.deskripsi_tugas','tugas.nama_file_tugas','tugas_upload_siswa.nama_file_tugas','tugas_upload_siswa.created_at')
            ->with('mapel')
            ->get();

        return response()->json($data_tugas);
    }

    /**
     * List Tugas dan Kuis untuk Ortu
     */
    public function listByOrtu()
    {
        $ortu = DataOrangTua::where('user_id', Auth::id())->first();
        $siswa = Siswa::find($ortu->siswa_id);
        $data_tugas = Tugas::join('tugas_kelas', 'tugas_kelas.tugas_id', '=', 'tugas.id')
            ->where('tugas_kelas.kelas_id', '=', $siswa->kelas_id)
            ->with(['mapel','user'])
            ->get();

        $data_quiz = Quiz::join('quiz_kelas', 'quiz_kelas.quiz_id', '=', 'quizzes.id')
            ->where('quiz_kelas.kelas_id', '=', $siswa->kelas_id)
            ->with(['mapel','user','result_quizzes'])
            ->withCount('answer')
            ->get();

        $data['tugas'] = $data_tugas;
        $data['kuis'] = $data_quiz;

        return response()->json($data);

    }


    /**
     * List kelas dan siswa
     * untuk guru
     */
    public function listKelasGuru()
    {
        $kelas = Kelas::with('siswa')->get();

        return response()->json($kelas);
    }

    /**
     * List Tugas yang diupload oleh siswa
     * untuk guru
     */

     public function uploadBySiswa($siswa_id)
     {
         $data_upload = Tugas::join('tugas_upload_siswa','tugas_upload_siswa.tugas_id','=','tugas.id')
                            ->select('tugas_upload_siswa.nama_file_tugas','tugas_upload_siswa.created_at','tugas_upload_siswa.siswa_id','tugas.mapel_id','tugas.created_by')
                            ->with('siswa')
                            ->where('tugas_upload_siswa.siswa_id', $siswa_id)
                            ->with('mapel','user')
                            ->get();

        return response()->json($data_upload);
     }

     public function listTugas()
     {
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first(); 
        if($tahun_ajaran == null || $semester == null){
        abort(404);
        }
         $dosen = Dosen::where('user_id', Auth::id())->first();
         $data_tugas = Tugas::where('created_by', $dosen->id)
         ->where('id_tahun_ajaran', $tahun_ajaran->id)
         ->where('id_semester', $semester->id)->get();

         return response()->json($data_tugas);
     }

     public function listTugasKelas(Request $request)
     {
        $tugas = Tugas::where('id', $request->id_tugas)->first();

        $kelas = $tugas->kelas;

        return response()->json($kelas);
     }

     public function detailTugasKelas(Request $request)
     {
        $data = [];
        $tugas = Tugas::where('id', $request->id_tugas)->first();
        $kelas = Kelas::where('kode_kelas', $request->kode_kelas)->first();
        
        $data_siswa = Mahasiswa::where('kelas_id', $kelas->id)->get('id');

        $result = HasilTugas::where('tugas_id', $tugas->id)->whereIn('siswa_id', $data_siswa)->get();
        foreach ($data_siswa as $siswa ) {
            $mahasiswa = Mahasiswa::find($siswa->id);
            if ($result->where('siswa_id', $siswa->id)->count() > 0) {
                $data2 = [
                    'id' => $siswa->id,
                    'nama_siswa' => $mahasiswa->nama_mahasiswa,
                    'status' => 'sudah'
                ];
                array_push($data, $data2);
            } else {
                $data2 = [
                    'id' => $siswa->id,
                    'nama_siswa' => $mahasiswa->nama_mahasiswa,
                    'status' => 'belum'
                ];
                array_push($data, $data2);
            }
        }

        return response()->json($data);
     }






}
