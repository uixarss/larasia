<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MataUjian;
use App\Models\JenisUjian;
use App\Models\GradeNilai;
use App\Models\Kkm;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataUjianController extends Controller
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
        $data_jenis_ujian = JenisUjian::all();
        $data_grade_nilai = GradeNilai::all();
        $data_mapel = MataPelajaran::all();
        $data_kkm_rapor = Kkm::all();

        return view('admin.mataujian.index', [
            'data_jenis_ujian' => $data_jenis_ujian,
            'data_grade_nilai' => $data_grade_nilai,
            'data_mapel' => $data_mapel,
            'data_kkm_rapor' => $data_kkm_rapor
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
        $this->validate($request, [
            'kode_jenis_ujian' => 'required|unique:jenis_ujians',
            'nama_jenis_ujian' => 'required'
        ]);
        JenisUjian::create([
            'kode_jenis_ujian' => $request->kode_jenis_ujian,
            'nama_jenis_ujian' => $request->nama_jenis_ujian
        ]);

        $data_jenis_ujian = JenisUjian::all();
        $data_grade_nilai = GradeNilai::all();

        return redirect()->route('admin.mataujian.index')->with('status','Data Jenis Ujian Berhasil Ditambah');
    }

    /**
     * Tambah Grade Nilai
     */
    public function gradeStore(Request $request)
    {
        $this->validate($request,[
            'kode_grade_nilai' => 'required|unique:grade_nilais',
            'nama_grade' => 'required',
            'nilai_rendah' => 'required',
            'nilai_tinggi' => 'required'
        ]);

        GradeNilai::create([
            'kode_grade_nilai' => $request->kode_grade_nilai,
            'nama_grade' => $request->nama_grade,
            'nilai_rendah' => $request->nilai_rendah,
            'nilai_tinggi' => $request->nilai_tinggi
        ]);

        $data_jenis_ujian = JenisUjian::all();
        $data_grade_nilai = GradeNilai::all();

        return redirect()->route('admin.mataujian.index')->with('status','Data Jenis Ujian Berhasil Ditambah');


    }

    /**
     * Tambah Rapor Nilai
     * 
     */
    public function raporStore(Request $request)
    {
        $this->validate($request,[
            'mapel_id' => 'required|unique:kkms',
            'nilai' => 'required'
        ]);

        Kkm::create([
            'mapel_id' => $request->mapel_id,
            'nilai' => $request->nilai
        ]);
        return redirect()->route('admin.mataujian.index')->with('status','Data Jenis Ujian Berhasil Ditambah');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MataUjian  $mataUjian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'kode_jenis_ujian' => 'required',
            'nama_jenis_ujian' => 'required'
        ]);
        $jenis_ujian = JenisUjian::find($id);

        $jenis_ujian->update([
            'kode_jenis_ujian' => $request->kode_jenis_ujian,
            'nama_jenis_ujian' => $request->nama_jenis_ujian
        ]);


        return redirect()->route('admin.mataujian.index')->with('status','Data Jenis Ujian Berhasil Diubah');
    }

    /**
     * Update Grade Nilai
     */

     public function gradeUpdate(Request $request, $id)
     {
        $this->validate($request,[
            'kode_grade_nilai' => 'required',
            'nama_grade' => 'required',
            'nilai_rendah' => 'required',
            'nilai_tinggi' => 'required'
        ]);

        $grade = GradeNilai::find($id);

        $grade->update([
            'kode_grade_nilai' => $request->kode_grade_nilai,
            'nama_grade' => $request->nama_grade,
            'nilai_rendah' => $request->nilai_rendah,
            'nilai_tinggi' => $request->nilai_tinggi
        ]);

        return redirect()->route('admin.mataujian.index')->with('status','Data Grade Nilai Berhasil Diubah');

     }

     /**
      * 
      * Update Rapor KKm
      */
     public function raporUpdate(Request $request, $id)
     {
        $this->validate($request,[
            'mapel_id' => 'required',
            'nilai' => 'required'
        ]);

        $kkm = Kkm::find($id);
        $kkm->update([
            'mapel_id' => $request->mapel_id,
            'nilai' => $request->nilai
        ]);
        return redirect()->route('admin.mataujian.index')->with('status','Data Grade Nilai Berhasil Diubah');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MataUjian  $mataUjian
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $jenis_ujian = JenisUjian::find($id);
        $jenis_ujian->delete($jenis_ujian);

        return redirect()->route('admin.mataujian.index')->with('status','Data Jenis Ujian Berhasil Dihapus');
    }

    /**
     * Destroy Grade Nilai
     */
    public function gradeDestroy($id)
    {
        $grade = GradeNilai::find($id);
        $grade->delete($grade);

        return redirect()->route('admin.mataujian.index')->with('status','Data Jenis Ujian Berhasil Dihapus');

    }
    public function raporDestroy($id)
    {
        $kkm = Kkm::find($id);
        $kkm->delete($kkm);
        return redirect()->route('admin.mataujian.index');
    }
}
