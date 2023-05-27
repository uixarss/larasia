<?php

namespace App\Http\Controllers\Perpustakaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use App\Models\DataBuku;
use App\Models\DataKondisiBuku;
use App\Models\DataPeminjamanBuku;
use App\Event;
use App\Models\Pengumuman;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardPerpustakaanController extends Controller
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

        $jumlah_data_buku = DataBuku::sum('stok_buku');
        $jumlah_kondisi_buku = DataKondisiBuku::sum('jumlah');

        $dt =  Date::today();
        $today = $dt->year.'-'.$dt->month.'-'.$dt->day;

        $jumlah_peminjaman = DataPeminjamanBuku::where('status', '1')
        ->where('tanggal_mulai', $today)
        ->sum('jumlah');

        $jumlah_pengembalian = DataPeminjamanBuku::where('status', '0')
        ->where('tanggal_kembali', $today)
        ->sum('jumlah');

        $pinjam = DataPeminjamanBuku::where('status', '1')->get();
        $pinjam = $pinjam->map(function($p, $key){
          $p->tanggal_mulai = date("Y-n",strtotime($p['tanggal_mulai']));
          return $p;
        });



        // $namaBulan = DataPeminjamanBuku::where('status', '1')
        // // ->whereYear('tanggal_mulai', '2020')
        // ->select('tanggal_mulai','jumlah')
        // ->orderBy('tanggal_mulai', 'desc')
        // ->get()
        // ->groupBy(function (DataPeminjamanBuku $item) {
        //     $data = date("M-Y", strtotime($item['tanggal_mulai']));
        //     return $data;
        //   })
        // ->map(function($p, $key) {
        //   return [
        //     'nama_bulan' => date("Y-m", strtotime($p['0'])),
        //     'jumlah' => $p->sum('jumlah')
        //   ];
        // });

        // dd($pinjam);

        // $nmBulan = array("Januari","Februaru","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        // $noBulan = 1;
        // $namaBulan = [];
        // for($i=0; $i<12; $i++){
        //
        //     $jml = $pinjam->where('tanggal_mulai', '2020'.'-'.$noBulan)->sum('jumlah');
        //
        //     $namaB = [
        //         'nama_bulan' => $nmBulan[$i],
        //         'jumlah' => $jml
        //     ];
        //
        //     // $namaBulan = collect($namaB);
        //
        //     array_push($namaBulan, $namaB);
        //
        //     echo $namaBulan;
        //     $noBulan++;
        // }

        // $jml_01 = $pinjam->where('tanggal_mulai', '2020-1')->sum('jumlah');
        // $jml_02 = $pinjam->where('tanggal_mulai', '2020-2')->sum('jumlah');
        // $jml_03 = $pinjam->where('tanggal_mulai', '2020-3')->sum('jumlah');
        // $jml_04 = $pinjam->where('tanggal_mulai', '2020-4')->sum('jumlah');
        // $jml_05 = $pinjam->where('tanggal_mulai', '2020-5')->sum('jumlah');
        // $jml_06 = $pinjam->where('tanggal_mulai', '2020-6')->sum('jumlah');
        // $jml_07 = $pinjam->where('tanggal_mulai', '2020-7')->sum('jumlah');
        // $jml_08 = $pinjam->where('tanggal_mulai', '2020-8')->sum('jumlah');
        // $jml_09 = $pinjam->where('tanggal_mulai', '2020-9')->sum('jumlah');
        // $jml_10 = $pinjam->where('tanggal_mulai', '2020-10')->sum('jumlah');
        // $jml_11 = $pinjam->where('tanggal_mulai', '2020-11')->sum('jumlah');
        // $jml_12 = $pinjam->where('tanggal_mulai', '2020-12')->sum('jumlah');



        $noBulan = 1;
        // $jml_B = [];
        // for($i=0; $i<12; $i++){
        //     $jml = $pinjam->where('tanggal_mulai', '2020'.'-'.$noBulan)->sum('jumlah');
        //     array_push($jml_B, $jml);
        //     $noBulan++;
        // }

        $namaB = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        $noBulan = 1;
        $arr = [];
        for($i=0; $i<12; $i++){
            $jml = $pinjam->where('tanggal_mulai', '2020'.'-'.$noBulan)->sum('jumlah');
            $arrB = [
                'nama_bulan' => $namaB[$i],
                'jumlah' => $jml
            ];
            array_push($arr, $arrB);
            $noBulan++;
        }

        $namaBulan =collect($arr);

        // echo $namaBulan;

        // dd($namaBulan);



        // $namaBulan = collect([
        //   [
        //     'nama_bulan' => 'Januari',
        //     'jumlah' => $jml_B[0]
        //   ],
        //   [
        //     'nama_bulan' => 'Februari',
        //     'jumlah' => $jml_B[1]
        //   ],
        //   [
        //     'nama_bulan' => 'Maret',
        //     'jumlah' => $jml_B[2]
        //   ],
        //   [
        //     'nama_bulan' => 'April',
        //     'jumlah' => $jml_B[3]
        //   ],
        //   [
        //     'nama_bulan' => 'Mei',
        //     'jumlah' => $jml_B[4]
        //   ],
        //   [
        //     'nama_bulan' => 'Juni',
        //     'jumlah' => $jml_B[5]
        //   ],
        //   [
        //     'nama_bulan' => 'Juli',
        //     'jumlah' => $jml_B[6]
        //   ],
        //   [
        //     'nama_bulan' => 'Agustus',
        //     'jumlah' => $jml_B[7]
        //   ],
        //   [
        //     'nama_bulan' => 'September',
        //     'jumlah' => $jml_B[8]
        //   ],
        //   [
        //     'nama_bulan' => 'Oktober',
        //     'jumlah' => $jml_B[9]
        //   ],
        //   [
        //     'nama_bulan' => 'November',
        //     'jumlah' => $jml_B[10]
        //
        //   ],
        //   [
        //     'nama_bulan' => 'Desember',
        //     'jumlah' => $jml_B[11]
        //   ]
        //
        // ]);

        // dd($namaBulan);

        $events = Event::all();
        $events = Event::paginate(3);
        $data_pengumuman = Pengumuman::where('tanggal_pengumuman','>', Date::today())
                            ->orderBy('tanggal_pengumuman','ASC')
                            ->paginate(3);

        return view('perpustakaan.halamanutama.index',[
          'events' => $events,
          'data_pengumuman' => $data_pengumuman,
          'jumlah_data_buku' => $jumlah_data_buku,
          'jumlah_kondisi_buku' => $jumlah_kondisi_buku,
          'jumlah_peminjaman' => $jumlah_peminjaman,
          'jumlah_pengembalian' => $jumlah_pengembalian,
          'nama_bulan' => $namaBulan
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
    public function show($id)
    {
        //
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
        //
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
