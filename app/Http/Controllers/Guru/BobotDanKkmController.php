<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\GradeNilai;
use App\Models\MataPelajaran;
use App\Models\Bobot;
use App\Models\Dosen;
use App\Models\BobotPengetahuan;
use App\Models\BobotKeterampilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gate;

class BobotDanKkmController extends Controller
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
        $data_guru = Dosen::where('user_id', Auth::id())->first();

        $grade_nilai = GradeNilai::all();

        $data_bobot = Bobot::all();

        // $mapel = MataPelajaran::where('id', $data_guru->mapel->id)->first();
        //
        // dd($data_bobot);
        // dd($mapel->kkms);
        // dd($grade_nilai);

        return view('guru.inputbobotdankkm.index',[
            'data_guru' => $data_guru,
            'data_bobot' => $data_bobot,
            'grade_nilai' => $grade_nilai
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
        if (Gate::denies('create-nilai')) {
            abort(403, 'User does not have the right permissions.');
        }

        $data_bobot_pengetahuan =  BobotPengetahuan::create([
            'nilai_harian' => $request->nilai_harian,
            'nilai_akhir' => $request->nilai_akhir,
            'total_bobot' => 100
        ]);

        $data_bobot_pengetahuan =  BobotKeterampilan::create([
            'nilai_praktek' => $request->nilai_praktek,
            'nilai_project' => $request->nilai_project,
            'total_bobot' => 100
        ]);

        return redirect()->route('guru.bobotdankkm.index')->with('status','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BobotDanKkm  $bobotDanKkm
     * @return \Illuminate\Http\Response
     */
    public function show(BobotDanKkm $bobotDanKkm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BobotDanKkm  $bobotDanKkm
     * @return \Illuminate\Http\Response
     */
    public function edit(BobotDanKkm $bobotDanKkm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BobotDanKkm  $bobotDanKkm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if (Gate::denies('update-nilai')) {
        abort(403, 'User does not have the right permissions.');
      }
      $data_bobot_pengetahuan = BobotPengetahuan::find($id);
      $data_bobot_keterampilan = BobotKeterampilan::find($id);

      $data_bobot_pengetahuan->update([
          'nilai_harian' => $request->nilai_harian,
          'nilai_akhir' => $request->nilai_akhir,
          'total_bobot' => 100
      ]);

      $data_bobot_keterampilan->update([
          'nilai_praktek' => $request->nilai_praktek,
          'nilai_project' => $request->nilai_project,
          'total_bobot' => 100
      ]);

      return redirect()->route('guru.bobotdankkm.index')->with('status','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BobotDanKkm  $bobotDanKkm
     * @return \Illuminate\Http\Response
     */
    public function destroy(BobotDanKkm $bobotDanKkm)
    {
        //
    }
}
