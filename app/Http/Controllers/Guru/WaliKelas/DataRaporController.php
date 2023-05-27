<?php

namespace App\Http\Controllers\Guru\WaliKelas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\MataPelajaran;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\TahunAjaranGuruKelas;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\GradeNilai;
use App\Models\NilaiRapor;
use App\Models\NilaiRaporSiswa;


class DataRaporController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_guru = Guru::where('user_id', Auth::user()->id)->first();

        $tahun_ajaran = TahunAjaran::where('status', '1')->first();

        $data_walikelas = TahunAjaranGuruKelas::where('guru_id', $data_guru->id)
        ->where('tahun_ajaran_id', $tahun_ajaran->id)
        ->get();

        return view('guru.walikelas.datarapor.index', [
          'data_walikelas' => $data_walikelas
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

          $data_mapel = MataPelajaran::all();

          $nilai_rapor = NilaiRapor::create([
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester,
            'wali_kelas' => $request->wali_kelas,
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'kelas_siswa' => $request->kelas_siswa

          ]);

          return view('guru.walikelas.datarapor.edit', [
            'nilai_rapor' => $nilai_rapor,
            'data_mapel' => $data_mapel
          ]);

    }



    public function storeRapor(Request $request, $id)
    {
          $rapor_siswa_id = NilaiRapor::find($id);



          $siswa = Siswa::where('NIS', $rapor_siswa_id->nis)->first();

          // dd($siswa->id);

          $nilai_rapor = NilaiRapor::where('id', $rapor_siswa_id->id)->first();

          $nilai_rapor_siswa = NilaiRaporSiswa::where('id', $nilai_rapor->nilai_rapor_id)->first();

          for ($i=0; $i < count($request->nama_mapel) ; $i++) {

            $data = [
              'nilai_rapor_id' => $request->nilai_rapor_id[$i],
              'nama_mapel' => $request->nama_mapel[$i],
              'kkm' => $request->kkm[$i],
              'nilai_akhir' => $request->nilai_akhir[$i],
              'huruf_mutu' => $request->huruf_mutu[$i],
              'keterangan' => $request->keterangan[$i]
            ];

            NilaiRaporSiswa::create($data);
          }

          // dd($aa);

          return redirect()->route('guru.walikelas.datarapor.raporsiswa', $siswa->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data_kelas = Kelas::find($id);

        $data_guru = Guru::where('user_id', Auth::user()->id)->first();

        $data_walikelas = TahunAjaranGuruKelas::where('guru_id', $data_guru->id)->first();

        // dd($data_walikelas);

        $tahun_ajaran = TahunAjaran::
            // where('status', true)
            where('start_date', '>', now())
            ->orWhere('end_date', '<', now())
            ->first();

        $semester = Semester::where('id', $tahun_ajaran->id)->first();

        $data_siswa = Siswa::where('kelas_id', $data_kelas->id)->get();


        $ket_data_rapor = [];
        foreach ($data_siswa as $key => $siswa) {
          $data_rapor = NilaiRapor::where('nis', $siswa->NIS)->first();
          $ket_data_rapor1= [
            'nis' => $siswa->NIS,
            'keterangan' => $data_rapor
          ];
          array_push($ket_data_rapor,$ket_data_rapor1);
        }


        return view('guru.walikelas.datarapor.show',compact(
          'data_kelas',
          'tahun_ajaran',
          'semester',
          'data_siswa',
          'ket_data_rapor',
          'data_walikelas'

        ));
    }


    public function showRapor($id)
    {
        $siswa = Siswa::find($id);

        $nilai_rapor = NilaiRapor::where('nis', $siswa->NIS)->first();

        $nilai_rapor_siswa = NilaiRaporSiswa::where('nilai_rapor_id', $nilai_rapor->id)->get();

        $grade_nilai = GradeNilai::all();


        // dd($nilai_rapor_siswa);

        // dd($nilai_rapor->id);


        return view('guru.walikelas.datarapor.raporsiswa',compact(
          'siswa',
          'nilai_rapor',
          'nilai_rapor_siswa',
          'grade_nilai'

        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::find($id);

        $data_mapel = MataPelajaran::all();

        $nilai_rapor = NilaiRapor::where('nis', $siswa->NIS)->first();

        $nilai_rapor_siswa = NilaiRaporSiswa::where('nilai_rapor_id', $nilai_rapor->id)->first();

        // dd($nilai_rapor_siswa);


        return view('guru.walikelas.datarapor.edit',compact(
          'siswa',
          'data_mapel',
          'nilai_rapor',
          'nilai_rapor_siswa'

        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRapor($id)
    {
          $siswa = Siswa::find($id);

          $nilai_rapor = NilaiRapor::where('nis', $siswa->NIS)->first();

          $nilai_rapor_siswa = NilaiRaporSiswa::where('nilai_rapor_id', $nilai_rapor->id)->get();

          $grade_nilai = GradeNilai::all();

          // dd($nilai_rapor_siswa);

          // dd($nilai_rapor->id);


          return view('guru.walikelas.datarapor.updaterapor',compact(
            'siswa',
            'nilai_rapor',
            'nilai_rapor_siswa',
            'grade_nilai'


          ));
    }


    public function updateRaporSiswa(Request $request, $id)
    {
          $siswa = Siswa::find($id);

          $nilai_rapor = NilaiRapor::where('nis', $siswa->NIS)->first();

          $nilai_rapor_siswa = NilaiRaporSiswa::where('nilai_rapor_id', $nilai_rapor->id)->get();

          $grade_nilai = GradeNilai::all();

          for ($i=0; $i < count($nilai_rapor_siswa) ; $i++) {

            $arr[$i] = NilaiRaporSiswa::where('id', $request->id[$i])->first();

            $arr[$i]->update([
              'nama_mapel' => $request->nama_mapel[$i],
              'kkm' => $request->kkm[$i],
              'nilai_akhir' => $request->nilai_akhir[$i],
              'huruf_mutu' => $request->huruf_mutu[$i],
              'keterangan' => $request->keterangan[$i]
            ]);

          }

          return redirect()->route('guru.walikelas.datarapor.raporsiswa', $siswa->id);
    }



    // public function getGradeNilai()
    // {
    //     $grade_nilai = GradeNilai::all();
    // }

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
