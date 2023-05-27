<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\AbsensiSiswa;
use App\Models\Siswa;
use App\Models\Mahasiswa;
use App\Models\KelasMahasiswa;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class DataAbsensiController extends Controller
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
    public function index(Request $request)
    {
        $siswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        if($siswa){
            $absensii = AbsensiSiswa::where('siswa_id', $siswa->id)
            // ->orderBy('tanggal_absen','ASC')
            ->where('tanggal_absen', Carbon::today()->toDateString())
            ->get();
            $tanggal_absen = '';
        }

        $today = Carbon::now();

        $rMonth =  $today->month;
        $rYear = $today->year;



        $data_absensi = AbsensiSiswa::where('siswa_id', $siswa->id)
        ->whereMonth('tanggal_absen', '=' , $rMonth)
        ->whereYear('tanggal_absen', '=' , $rYear)
        // ->orderBy('id','asc')
        ->get();

        $sakit = AbsensiSiswa::where('siswa_id', $siswa->id)
        ->whereMonth('tanggal_absen', '=' , $rMonth)
        ->whereYear('tanggal_absen', '=' , $rYear)
        ->whereKeterangan('Sakit');

        $izin = AbsensiSiswa::where('siswa_id', $siswa->id)
        ->whereMonth('tanggal_absen', '=' , $rMonth)
        ->whereYear('tanggal_absen', '=' , $rYear)
        ->whereKeterangan('Izin');

        $alpha = AbsensiSiswa::where('siswa_id', $siswa->id)
        ->whereMonth('tanggal_absen', '=' , $rMonth)
        ->whereYear('tanggal_absen', '=' , $rYear)
        ->whereKeterangan('Alpha');

        $hadir = AbsensiSiswa::where('siswa_id', $siswa->id)
        ->whereMonth('tanggal_absen', '=' , $rMonth)
        ->whereYear('tanggal_absen', '=' , $rYear)
        ->whereKeterangan('Hadir');

        $jumlahPertemuan = $data_absensi->count();

        // dd($data_absensi->count());


        $listMonth = ['1','2','3','5','4','6','7','8','9','10','11','12'];
        // dd($listMonth , $today->month);



        return view('siswa.dataabsensi.index', [
            'siswa' => $siswa,
            'absensii' => $absensii,
            'data_absensi' => $data_absensi,
            'tanggal_absen' => $tanggal_absen,
            'listMonth' => $listMonth,
            'sakit' => $sakit,
            'izin' => $izin,
            'alpha' => $alpha,
            'hadir' => $hadir,
            'jumlahPertemuan' => $jumlahPertemuan,
            'rMonth'  => $rMonth,
            'rYear'  => $rYear
        ]);
    }


    public function cariAbsen(Request $request)
    {
          $siswa = Siswa::where('user_id', Auth::user()->id)->first();
          if($siswa){
              $absensii = AbsensiSiswa::where('siswa_id', $siswa->id)
              // ->orderBy('tanggal_absen','ASC')
              ->where('tanggal_absen', Carbon::today()->toDateString())
              ->get();
              $tanggal_absen = '';
          }


          $data_absensi = AbsensiSiswa::where('siswa_id', $siswa->id)
                ->whereMonth('tanggal_absen', '=' , $request->month)
                ->whereYear('tanggal_absen', '=' , $request->year)
                // ->orderBy('id','asc')
                ->get();

          $rMonth = $request->month;
          $rYear = $request->year;

          $sakit = AbsensiSiswa::where('siswa_id', $siswa->id)
          ->whereMonth('tanggal_absen', '=' , $request->month)
          ->whereYear('tanggal_absen', '=' , $request->year)
          ->whereKeterangan('Sakit');

          $izin = AbsensiSiswa::where('siswa_id', $siswa->id)
          ->whereMonth('tanggal_absen', '=' , $request->month)
          ->whereYear('tanggal_absen', '=' , $request->year)
          ->whereKeterangan('Izin');

          $alpha = AbsensiSiswa::where('siswa_id', $siswa->id)
          ->whereMonth('tanggal_absen', '=' , $request->month)
          ->whereYear('tanggal_absen', '=' , $request->year)
          ->whereKeterangan('Alpha');

          $hadir = AbsensiSiswa::where('siswa_id', $siswa->id)
          ->whereMonth('tanggal_absen', '=' , $request->month)
          ->whereYear('tanggal_absen', '=' , $request->year)
          ->whereKeterangan('Hadir');

          $jumlahPertemuan = $data_absensi->count();

          $tanggal_absen = '';



                // return back();

          return view('siswa.dataabsensi.index', [
              'siswa' => $siswa,
              'absensii' => $absensii,
              'data_absensi' => $data_absensi,
              'tanggal_absen' => $tanggal_absen,  
              'sakit' => $sakit,
              'izin' => $izin,
              'alpha' => $alpha,
              'hadir' => $hadir,
              'jumlahPertemuan' => $jumlahPertemuan,
              'rMonth'  => $rMonth,
              'rYear'  => $rYear
          ]);
    }



    public function detaildataabsensi()
    {
        return view('siswa.dataabsensi.detaildataabsensi');
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
     * @param  \App\DataAbsensi  $dataAbsensi
     * @return \Illuminate\Http\Response
     */
    public function show(DataAbsensi $dataAbsensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataAbsensi  $dataAbsensi
     * @return \Illuminate\Http\Response
     */
    public function edit(DataAbsensi $dataAbsensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataAbsensi  $dataAbsensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataAbsensi $dataAbsensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataAbsensi  $dataAbsensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataAbsensi $dataAbsensi)
    {
        //
    }
}
