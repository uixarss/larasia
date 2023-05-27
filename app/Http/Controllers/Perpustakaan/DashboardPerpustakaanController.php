<?php

namespace App\Http\Controllers\Perpustakaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use App\Models\DataBuku;
use App\Models\DataKondisiBuku;
use App\Models\DataPeminjamanBuku;
use App\Models\DendaBuku;
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
    public function index(Request $request)
    {
        //jumlah stokm buku
        $jumlah_data_buku = DataBuku::sum('stok_buku');
        $jumlah_kondisi_buku = DataKondisiBuku::sum('jumlah');

        //data hari ini
        $dt = Carbon::now();
        $today = $dt->year.'-'.$dt->month.'-'.$dt->day;

        $rYear = $dt->year;


        // dd($rYear);

        //jumlah buku pinjam hari ini
        $jumlah_peminjaman = DataPeminjamanBuku::where('status', '1')
        ->where('tanggal_mulai', $today)
        ->sum('jumlah');

        //jumlah buku kembali hari ini
        $jumlah_pengembalian = DataPeminjamanBuku::where('status', '0')
        ->where('tanggal_kembali', $today)
        ->sum('jumlah');

        //chart buku pinjam perbulan
        $namaBulan = DataPeminjamanBuku::where('status', '1')
        ->select(DB::raw('sum(jumlah) as `jumlah`'),
        DB::raw("DATE_FORMAT(tanggal_mulai,'%M %Y') as months"),
        DB::raw('max(tanggal_mulai) as createdAt'))
        ->whereYear('tanggal_mulai', $rYear)
        ->where("tanggal_mulai", ">", \Carbon\Carbon::now()->subMonths(12))
        ->orderBy('createdAt', 'asc')
        ->groupBy('months')
        ->get();

        $jml_pinjam = DataPeminjamanBuku::where('status', '1')
        ->select(DB::raw('sum(jumlah) as `jumlah`'),
        DB::raw("DATE_FORMAT(tanggal_mulai,'%Y') as years"))
        ->first();

        // dd($jml_pinjam->jumlah);


        //chart denda perbulan
        $denda = DendaBuku::select(DB::raw('sum(jumlah_denda) as `jumlah`'),
        DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"),
        DB::raw('max(created_at) as createdAt'))
        ->whereYear('created_at', $rYear)
        ->where("created_at", ">", \Carbon\Carbon::now()->subMonths(12))
        ->orderBy('createdAt', 'asc')
        ->groupBy('months')
        ->get();

        $jumlah_denda = DendaBuku::sum('jumlah_denda');
        $jumlahDenda = "Rp " .number_format($jumlah_denda ,2,',','.');

        // echo $denda;
        // dd($jumlahDenda);


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
          'rYear'  => $rYear,
          'nama_bulan' => $namaBulan,
          'jml_pinjam' => $jml_pinjam,
          'denda' => $denda,
          'jumlahDenda' => $jumlahDenda
        ]);
    }


    public function cariLaporanPeminjaman(Request $request)
    {
      //jumlah stokm buku
      $jumlah_data_buku = DataBuku::sum('stok_buku');
      $jumlah_kondisi_buku = DataKondisiBuku::sum('jumlah');

      //data hari ini
      $dt = Carbon::now();
      $today = $dt->year.'-'.$dt->month.'-'.$dt->day;

      $rYear = $request->year;
      // dd($rYear);

      //jumlah buku pinjam hari ini
      $jumlah_peminjaman = DataPeminjamanBuku::where('status', '1')
      ->where('tanggal_mulai', $today)
      ->sum('jumlah');

      //jumlah buku kembali hari ini
      $jumlah_pengembalian = DataPeminjamanBuku::where('status', '0')
      ->where('tanggal_kembali', $today)
      ->sum('jumlah');

      //chart buku pinjam perbulan
      $namaBulan = DataPeminjamanBuku::where('status', '1')
      ->select(DB::raw('sum(jumlah) as `jumlah`'),
      DB::raw("DATE_FORMAT(tanggal_mulai,'%M %Y') as months"),
      DB::raw('max(tanggal_mulai) as createdAt'))
      ->whereYear('tanggal_mulai', $rYear)
      ->where("tanggal_mulai", ">", \Carbon\Carbon::now()->subMonths(12))
      ->orderBy('createdAt', 'asc')
      ->groupBy('months')
      ->get();

      $jml_pinjam = DataPeminjamanBuku::where('status', '1')
      ->select(DB::raw('sum(jumlah) as `jumlah`'),
      DB::raw("DATE_FORMAT(tanggal_mulai,'%Y') as years"))
      ->whereYear('tanggal_mulai', $rYear)
      ->first();


      //chart denda perbulan
      $denda = DendaBuku::select(DB::raw('sum(jumlah_denda) as `jumlah`'),
      DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"),
      DB::raw('max(created_at) as createdAt'))
      ->whereYear('created_at', $rYear)
      ->where("created_at", ">", \Carbon\Carbon::now()->subMonths(12))
      ->orderBy('createdAt', 'asc')
      ->groupBy('months')
      ->get();

      $jumlah_denda = DendaBuku::whereYear('created_at', $rYear)->sum('jumlah_denda');
      $jumlahDenda = "Rp " .number_format($jumlah_denda ,2,',','.');


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
        'rYear'  => $rYear,
        'nama_bulan' => $namaBulan,
        'jml_pinjam' => $jml_pinjam,
        'denda' => $denda,
        'jumlahDenda' => $jumlahDenda
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
