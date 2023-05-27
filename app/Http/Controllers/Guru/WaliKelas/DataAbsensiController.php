<?php

namespace App\Http\Controllers\Guru\WaliKelas;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\AbsensiSiswa;
use App\Models\TahunAjaran;
use App\Models\TahunAjaranGuruKelas;

use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiSiswaExport;

Carbon::setLocale('id');

class DataAbsensiController extends Controller
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

      return view('guru.walikelas.dataabsensi.index', [
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
        //
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

        // dd($data_kelas->siswa->id);

        $absensi_siswa = AbsensiSiswa::where('tanggal_absen', Carbon::today()->toDateString())->get();
        $absensi_siswa_tanggal = AbsensiSiswa::orderBy('tanggal_absen', 'desc');
        $tanggal_absens = '';

        $kelas_id = $data_kelas->id;


        if (!empty($request->tanggal_absen) || !empty( $data_kelas->id)) {
            $absensi_siswa_tanggal = $absensi_siswa_tanggal->where('tanggal_absen', Carbon::parse($request->tanggal_absen)->toDateString())->get();
            $tanggal_absens = $request->tanggal_absen;
            $kelas_id =  $data_kelas->id;
        }


        return view('guru.walikelas.dataabsensi.show', [
            'data_kelas' => $data_kelas,
            'absensi_siswas' => $absensi_siswa,
            'absensi_siswa_t' => $absensi_siswa_tanggal,
            'tanggal_absen' => $tanggal_absens,
            'kelas_id' => $kelas_id

        ])->with('absensi');
    }


    public function siswaLaporan(Request $request)
    {
        $file_name = str_replace('-','_',$request->tanggal_absen);
        return Excel::download(new AbsensiSiswaExport($request->tanggal_absen),$file_name.'_absensisiswa.xlsx');

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
          $data_kelas = Kelas::find($id);

          $absensi_siswa = AbsensiSiswa::where('siswa_id' , $request->siswa_id)
          ->where('tanggal_absen' , $request->tanggal_absen)
          ->first();

          $absensi_siswa->update([
            'keterangan' => $request->ket_absen
          ]);

          return back();

          // return view('guru.walikelas.dataabsensi.show', [
          //     'data_kelas' => $data_kelas,
          //     'absensi_siswas' => $absensi_siswa
          //
          // ])->with('absensi');


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
