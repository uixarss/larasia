<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use App\KumpulanSoal;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Option;
use App\Models\Dosen;
use App\Models\Pengampu;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\JenisUjian;
use App\Models\MataPelajaran;
use App\Models\Kelas;

class KumpulanSoalController extends Controller
{

    public function __construct()
    {
      $this ->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data_dosen = Pengampu::all();
     
        return view('admin.kumpulansoal.index', compact(
          'data_dosen',
        ));
    }

    public function list($id)
    {

      $pengampu = Pengampu::where('id', $id)->first();
      
      $tahun_ajaran = TahunAjaran::where('status', '1')->first();
      $semester = Semester::where('status', '1')->first(); 
      
      if($tahun_ajaran == null || $semester == null){
        abort(404);
      }

      $data_kelas = Kelas::join('jadwals', 'kelas.id', '=', 'jadwals.kelas_id')
      ->where('id_dosen', $pengampu->id_dosen)
      ->where('tahun_ajaran_id', $tahun_ajaran->id)
      ->where('semester_id', $semester->id)
      ->where('mapel_id', $pengampu->mapel_id)
      ->groupBy('kelas.id')
      // ->select('kelas_id')
      // ->with('kelas')
      // ->distinct()
      ->get();

      // dd($data_kelas);

      $dosen = Dosen::where('id',$pengampu->id_dosen)->first();

      $data_tugas = Quiz::where('jenisujian_id','0')->where('id_dosen', $dosen->id)
      ->where('mapel_id', $pengampu->mapel_id)
      ->where('id_prodi', $pengampu->id_prodi)
      ->where('id_semester', $pengampu->id_semester)
      ->where('id_tahun_ajaran', $pengampu->id_tahun_ajaran)->with('quiz')->cursor();

      $data_quiz = Quiz::where('jenisujian_id','1')->where('id_dosen', $dosen->id)
      ->where('mapel_id', $pengampu->mapel_id)
      ->where('id_prodi', $pengampu->id_prodi)
      ->where('id_semester', $pengampu->id_semester)
      ->where('id_tahun_ajaran', $pengampu->id_tahun_ajaran)->with('quiz')->cursor();

      $data_uts = Quiz::where('jenisujian_id','2')->where('id_dosen', $dosen->id)
      ->where('mapel_id', $pengampu->mapel_id)
      ->where('id_prodi', $pengampu->id_prodi)
      ->where('id_semester', $pengampu->id_semester)
      ->where('id_tahun_ajaran', $pengampu->id_tahun_ajaran)->with('quiz')->cursor();

      $data_uas = Quiz::where('jenisujian_id','3')->where('id_dosen', $dosen->id)
      ->where('mapel_id', $pengampu->mapel_id)
      ->where('id_prodi', $pengampu->id_prodi)
      ->where('id_semester', $pengampu->id_semester)
      ->where('id_tahun_ajaran', $pengampu->id_tahun_ajaran)->with('quiz')->cursor();


      $data_dosen = Dosen::all();
      $jenis_soal = JenisUjian::all();
      $mapel = MataPelajaran::where('id', $pengampu->mapel_id)->first();


      return view('admin.kumpulansoal.list', [
        'id_dosen' => $dosen->id,
        'mapel_id' => $pengampu->mapel_id,
        'id_prodi' => $pengampu->id_prodi,
        'semester' => $pengampu->id_semester,
        'tahun_ajaran' => $pengampu->id_tahun_ajaran,
        'data_tugas' => $data_tugas,
        'data_quiz' => $data_quiz,
        'data_uts' => $data_uts,
        'data_uas' => $data_uas,
        'jenis_soal' => $jenis_soal,
        'data_kelas' => $data_kelas,
        'data_dosen' => $data_dosen,
        'dosen' => $dosen,
        'mapel' => $mapel,
        'pengampu' => $pengampu
      ]);
    }


    ///////////////////////////////////////////////////////////

        public function viewQuestion(Request $request)
        {
            $data_question =  Question::where([
                'id' => $request->id,
                'quiz_id' => $request->quiz_id,
                'pertanyaan' => $request->pertanyaan
            ]);

            return redirect()->back();
        }



        public function createQuestions(Request $request, $id)
        {
            $data_question =  Question::create([
                'quiz_id' => $request->quiz_id,
                'pertanyaan' => $request->pertanyaan
            ]);

            $data_quiz = Quiz::find($request->quiz_id);

            $data_quiz->update([
              'jumlah_soal' => $request->jmlh_quiz
            ]);

            return $request->all();
        }


        public function deleteQuestion(Request $request, $id)
        {
            $question = Question::where('id', $request->id)->first();

            $question->delete();

            $data_quiz = Quiz::find($question->quiz_id);

            $data_quiz->update([
              'jumlah_soal' => $request->jmlh_quiz
            ]);

            return $request->all();
        }


        public function updateQuestion(Request $request)
        {
            $data_question = Question::find($request->id);

            $data_question->update([
              'id' => $request->id,
              'quiz_id' => $request->quiz_id,
              'pertanyaan' => $request->pertanyaan
            ]);


            return $request->all();
        }






        public function createOption(Request $request)
        {
            $data_option =  Option::create([
                'question_id' => $request->question_id,
                'pilihan_jawaban' => $request->pilihan_jawaban,
                'is_correct' => 0
            ]);


            return response()->json($data_option);
        }


        public function deleteOption(Request $request)
        {
            Option::where('id', $request->id)->delete();
            return $request->all();
        }


        public function updateOption(Request $request)
        {
            $data_option = Option::find($request->id);

            $data_option->update([
              'pilihan_jawaban' => $request->value
            ]);

            return $request->all();
        }


        public function updateOptionAnswer(Request $request)
        {
            $data_option = Option::find($request->id);

            if ($request->benar == 0) {
              $data_option->update([
                'pilihan_jawaban' => $request->value,
                'is_correct' => $request->salah
              ]);
            }else {
              $data_option->update([
                'pilihan_jawaban' => $request->value,
                'is_correct' => $request->benar
                ]);
            }


            return $request->all();
        }


    /////////////////////////////////////////////////////////////////////////////

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
    public function store(Request $request, $id, $matkul, $id_prodi, $semester, $tahun_ajaran)
    {
          $dosen = Dosen::where('id', $id)->first();
          $data_quiz =  Quiz::create([
              'id_prodi' => $id_prodi,
              'id_semester' => $semester,
              'id_tahun_ajaran' => $tahun_ajaran,
              'mapel_id' => $matkul,
              'kode_soal' => $request->kode_soal,
              'judul_kuis' => $request->judul_kuis,
              'jumlah_soal' => 0,
              'durasi' => $request->durasi,
              'tanggal_mulai' => $request->tanggal_mulai,
              'tanggal_akhir' => $request->tanggal_akhir,
              'dibuat_oleh' => Auth::user()->id,
              'jenisujian_id' => $request->jenis_soal,
              'id_dosen' => $dosen->id
          ]);

          $data_quiz->kelas()->attach($request->id_kelas);

          return redirect()->route('admin.kumpulansoal.edit', $data_quiz->id )->with('sukses', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KumpulanSoal  $kumpulanSoal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $data_quiz = Quiz::find($id);

          $pengampu = Pengampu::where('id_dosen', $data_quiz->id_dosen)
                              ->where('id_semester', $data_quiz->id_semester)
                              ->where('mapel_id', $data_quiz->mapel_id)
                              ->where('id_prodi', $data_quiz->id_prodi)
                              ->where('id_tahun_ajaran', $data_quiz->id_tahun_ajaran)->first();

          $data_question = Question::where('quiz_id', $data_quiz->id)->get();

          $data_option = Option::where('question_id', $data_quiz->id)->first();

          return view('admin.kumpulansoal.show',[

            'data_quiz' => $data_quiz,
            'data_question' => $data_question,
            'data_option' => $data_option,
            'pengampu' => $pengampu

          ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KumpulanSoal  $kumpulanSoal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $data_quiz = Quiz::find($id);
          $pengampu = Pengampu::where('id_dosen', $data_quiz->id_dosen)
                              ->where('id_semester', $data_quiz->id_semester)
                              ->where('mapel_id', $data_quiz->mapel_id)
                              ->where('id_prodi', $data_quiz->id_prodi)
                              ->where('id_tahun_ajaran', $data_quiz->id_tahun_ajaran)->first();

          $data_question = Question::where('quiz_id', $data_quiz->id)->get();

          $data_option = Option::where('question_id', $data_quiz->id)->first();

          return view('admin.kumpulansoal.edit', compact('data_quiz', 'data_question', 'data_option','pengampu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KumpulanSoal  $kumpulanSoal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $data_quiz = Quiz::find($id);

          $data_quiz->update([
              'kode_soal' => $request->kode_soal,
              'judul_kuis' => $request->judul_kuis,
              // 'jumlah_soal' => 0,
              'durasi' => $request->durasi,
              'tanggal_mulai' => $request->tanggal_mulai,
              'tanggal_akhir' => $request->tanggal_akhir,
              // 'dibuat_oleh' => Auth::user()->id,
              'jenisujian_id' => $request->jenis_soal
              // 'dibuat_oleh' => $data_guru->id
          ]);

          $data_quiz->kelas()->sync($request->id_kelas);

          return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KumpulanSoal  $kumpulanSoal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data_quiz = Quiz::find($id);
        $data_quiz->delete($data_quiz);

        return redirect('/admin/kumpulansoal')->with('sukses','Data Berhasil Dihapus');
    }

    
    public function prodi(Request $request, $id_dosen, $id){
      $prodi = Pengampu::join('prodi', 'pengampu.id_prodi','=','prodi.id_prodi')
      ->where('mapel_id', $id)->where('id_dosen', $id_dosen)
      ->groupBy('nama_program_studi')->pluck('prodi.id_prodi','nama_program_studi');
      return json_encode($prodi);
  }

  public function semester(Request $request, $id, $prodi){
      $dosen = Dosen::where('user_id', Auth::id())->first();
      $semester = Pengampu::join('semesters', 'pengampu.id_semester','=','semesters.id')
      ->where('mapel_id', $id)->where('id_dosen', $dosen->id)->where('id_prodi', $prodi)
      ->groupBy('id_semester')->pluck('semesters.id','nama_semester');
      return json_encode($semester);
  }

  public function tahunAjaran(Request $request, $id, $prodi, $semester){
      $dosen = Dosen::where('user_id', Auth::id())->first();
      $tahun_ajaran = Pengampu::join('tahun_ajarans', 'pengampu.id_tahun_ajaran','=','tahun_ajarans.id')
      ->where('mapel_id', $id)->where('id_dosen', $dosen->id)->where('id_prodi', $prodi)->where('id_Semester', $semester)
      ->groupBy('id_tahun_ajaran')->pluck('tahun_ajarans.id','nama_tahun_ajaran');
      return json_encode($tahun_ajaran);
  }
}
