<?php

namespace App\Http\Controllers\Guru;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Dosen;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Siswa;
use App\Models\TahunAjaranGuruKelas;
use App\Models\NilaiHarian;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Gate;


class NilaiHarianController extends Controller
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
        if (Gate::denies('view-nilai')) {
            abort(403, 'User does not have the right permissions.');
          }
        $data_kelas = Kelas::all();
        $data_mapel = MataPelajaran::all();

        // $data_kelas_mapel = TahunAjaranGuruKelas::all();

        $tahun_ajaran = TahunAjaran::
            // where('status', true)
            where('start_date', '>', now())
            ->orWhere('end_date', '<', now())
            ->first();

        $data_kelas_mapel = TahunAjaranGuruKelas::where('tahun_ajaran_id', $tahun_ajaran->id)
            ->get();

        // $data_siswa = Siswa::where('kelas_id', $data_kelas_mapel->kelas_id)->get();

          // dd($data_kelas_mapel[0]->kelas[0]);

          // dd($data_siswa);
          $tahun_ajaran = TahunAjaran::where('status', '1')->first();
          $semester = Semester::where('status', '1')->first();
          $guru = Dosen::where('user_id', '=', Auth::id())->first();
          $data_jadwal = Jadwal::where('guru_id', $guru->id)
              ->where('tahun_ajaran_id', $tahun_ajaran->id)
              ->where('semester_id', $semester->id)
              ->select('kelas_id')
              ->with('kelas')
              ->distinct()
              ->get();


        return view('guru.inputnilaiharian.index', compact('data_kelas', 'data_mapel' , 'data_kelas_mapel', 'data_jadwal'));
    }

    // public function inputnilai($id) {
    //
    //
    //   return redirect()->route('guru.inputnilaiharian.nilaiharian');
    //
    // }


    // public function insert(Request $request)
    // {
    //   if ($request->ajax()) {
    //       $rules = array(
    //           'nilai_harian.*' => 'required'
    //       );
    //       $error = Validator::make($request->all(), $rules);
    //       if ($error->fails()) {
    //           return response()->json([
    //             'error' => $error->errors()->all()
    //           ]);
    //       }
    //
    //       $nilai_harian = $request->nilai_harian;
    //       $siswa_id = 1;
    //       $mapel_id = 1;
    //
    //       for($count = 0 ; $count < count($nilai_harian); $count++){
    //         $data = array(
    //           'nilai_harian' => $nilai_harian[$count],
    //           'siswa_id' => $siswa_id[$count],
    //           'mapel_id' => $mapel_id[$count]
    //         );
    //         $insert_data[] = $data;
    //
    //       }
    //
    //       NilaiHarian::insert($insert_data);
    //
    //       return response()->json([
    //         'success' => 'Data sukses'
    //       ]);
    //
    //   }
    // }




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
     * @param  \App\NilaiHarian  $nilaiHarian
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiHarian $nilaiHarian)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NilaiHarian  $nilaiHarian
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('edit-nilai')) {
            abort(403, 'User does not have the right permissions.');
        }
        $data_kelas = Kelas::find($id);


        $data_guru = Guru::where('user_id', Auth::id())->first();

        $tahun_ajaran = TahunAjaran::
            // where('status', true)
            where('start_date', '>', now())
            ->orWhere('end_date', '<', now())
            ->first();

        $semester = Semester::where('id', $tahun_ajaran->id)->first();

        $data_siswa = Siswa::where('kelas_id', $data_kelas->id)
        ->with('nilai_harian.mapel')
        ->get();

        // $data_nilai_harian = NilaiHarian::with('nilai_harian')->cursor();

        // $data_nilai_harian = NilaiHarian::take(1000)->get();

        // foreach ($data_siswa as $key => $siswa) {
        //
        //   $data_nilai_harian = NilaiHarian::where('siswa_id', $siswa->id)->get();
        //
        // }
        //
        // dd($data_nilai_harian);






        return view('guru.inputnilaiharian.edit', compact(
          'data_kelas',
          'data_guru',
          'tahun_ajaran',
          'semester',
          'data_siswa'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NilaiHarian  $nilaiHarian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::denies('update-nilai')) {
            abort(403, 'User does not have the right permissions.');
        }
        $data_siswa = Siswa::find($id);

        $data_guru = Guru::where('user_id', Auth::id())->first();

        $this->validate($request, [
            'nilai_harian' => 'required|max:100|min:0'
        ]);

        if ($data_siswa != null ) {
          $nilai_harian = NilaiHarian::create([
              'siswa_id' => $request->siswa_id,
              'guru_id'  => $data_guru->id,
              'mapel_id' => $data_guru->mapel_id,
              'tahun_ajaran_id' => $request->tahun_ajaran_id,
              'semester_id' => $request->semester_id,
              'nilai_harian' => $request->nilai_harian
          ]);
        }else {
          'data Kosong';
        }
        return back();
    }




    public function updateNilai(Request $request, $id , $nilai_id)
    {

        $this->validate($request, [
          'nilai_harian' => 'required|max:100|min:0'
        ]);

        $data_siswa = Siswa::find($id);

        $data_nilai = NilaiHarian::where('id', $nilai_id)->where('siswa_id', $data_siswa->id)->first();

        $data_guru = Guru::where('user_id', Auth::id())->first();

        // dd($data_nilai->nilai_harian);


        $data_nilai->update([
            'siswa_id' => $request->siswa_id,
            'guru_id'  => $data_guru->id,
            'mapel_id' => $data_guru->mapel_id,
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
            'semester_id' => $request->semester_id,
            'nilai_harian' => $request->nilai_harian
        ]);



        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NilaiHarian  $nilaiHarian
     * @return \Illuminate\Http\Response
     */
    public function destroyNilai($id , $nilai_id)
    {
      if (Gate::denies('view-nilai')) {
          abort(403, 'User does not have the right permissions.');
      }
      $data_siswa = Siswa::find($id);

      $data_nilai = NilaiHarian::where('id', $nilai_id)->where('siswa_id', $data_siswa->id)->first();

      $data_nilai->delete($data_nilai);

      return back();

    }
}
