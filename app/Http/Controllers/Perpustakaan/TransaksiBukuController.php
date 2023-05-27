<?php

namespace App\Http\Controllers\Perpustakaan;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Mahasiswa;
use App\Models\DataBuku;
use App\Models\DataKondisiBuku;
use App\Models\ListKondisi;
use App\Models\DataPeminjamanBuku;
use App\Models\Denda;
use App\Models\DendaBuku;


class TransaksiBukuController extends Controller
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
        $data_siswa = Mahasiswa::orderBy('nim', 'ASC')->get();
        $data_buku = DataBuku::all();
        $list_kondisi = ListKondisi::all();
        $data_peminjaman = DataPeminjamanBuku::all();
        $data_denda = DendaBuku::all();
        

        return view('perpustakaan.transaksibuku.index',[
          'data_siswa' => $data_siswa,
          'data_buku' => $data_buku,
          'list_kondisi' => $list_kondisi,
          'data_peminjaman' => $data_peminjaman,
          'data_denda' => $data_denda
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

      for($a=0; $a < count($request->data_buku_id); $a++){

        $buku = DataBuku::find($request->data_buku_id[$a]);

        $buku->peminjaman()->attach($request->siswa_id, [
          'jumlah' => $request->jumlah[$a],
          'tanggal_mulai' => $request->tanggal_mulai,
          'tanggal_selesai' => $request->tanggal_selesai,
          'penerima' => Auth::user()->id
        ]);

      }

        return back();

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
        $data_peminjaman = DataPeminjamanBuku::find($id);

        $data_kondisi_buku = DataKondisiBuku::where('data_buku_id', $request->data_buku_id)
        ->where('list_kondisi_id', $request->kondisi_id)->first();

        // dd($data_kondisi_buku);

        $denda = Denda::all()->first();


        //update kondisi buku
        if ($data_kondisi_buku != null) {
            $jmlh_kondisi = $data_kondisi_buku->jumlah;
            $update_kondisi_buku = $jmlh_kondisi + $request->jumlah;

            $data_kondisi_buku->update([
                'jumlah' => $update_kondisi_buku
            ]);
        }else{
          if ($request->kondisi_id != '1') {
            DataKondisiBuku::create([
              'data_buku_id' => $request->data_buku_id,
              'list_kondisi_id' => $request->kondisi_id,
              'jumlah' => $request->jumlah
            ]);
          }
        }

        //untuk update denda sama kembali buku
        if ($request->tanggal_kembali > $data_peminjaman->tanggal_selesai) {
          $start = strtotime($data_peminjaman->tanggal_selesai);
          $end   = strtotime($request->tanggal_kembali);
          $diff  = $end - $start;

          $hours = number_format($diff / (60 * 60 / 0.0416667));

          $hasil = $hours * $denda->uang_denda;

          $data_peminjaman->update([
            'list_kondisi_id' => $request->kondisi_id,
            'jumlah' => $request->jumlah,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => '0'
          ]);

          $buku = DataBuku::find($request->data_buku_id);
          $buku->dendabuku()->attach($request->siswa_id, [
            'jumlah_telat' => $hours,
            'jumlah_denda' => $hasil,
            'created_at' => $request->tanggal_kembali
          ]);

        }else{
          $data_peminjaman->update([
            'list_kondisi_id' => $request->kondisi_id,
            'jumlah' => $request->jumlah,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => '0'
          ]);
        }

        return back();

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
