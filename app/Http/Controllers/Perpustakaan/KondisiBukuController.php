<?php

namespace App\Http\Controllers\Perpustakaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataKondisiBuku;
use App\Models\ListKondisi;
use App\Models\DataBuku;
use App\Models\KategoriBuku;

class KondisiBukuController extends Controller
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
        $data_kondisi_buku = DataKondisiBuku::all();
        $list_kondisi = ListKondisi::all();
        $data_buku = DataBuku::all();

        return view('perpustakaan.kondisibuku.index',[
          'data_kondisi_buku' => $data_kondisi_buku,
          'list_kondisi' => $list_kondisi,
          'data_buku' => $data_buku
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

        $buku = DataBuku::find($request->data_buku_id);

        $buku->kondisi()->attach($request->kode_kondisi, ['jumlah' => $request->jumlah]);

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

        $data_kondisi_buku = DataKondisiBuku::find($id);

        $data_kondisi_buku->update([
            'data_buku_id' => $request->data_buku_id,
            'list_kondisi_id' => $request->kode_kondisi,
            'jumlah' => $request->jumlah
        ]);

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
        $data_kondisi_buku = DataKondisiBuku::find($id);
        $data_kondisi_buku->delete($data_kondisi_buku);

        return back();
    }


    /**
     * CRUD LIST KONDSI
     *
     */
    public function tambahKondisi(Request $request)
    {
          ListKondisi::create([
            'kode_kondisi' => $request->kode_kondisi,
            'nama_kondisi' => $request->nama_kondisi
        ]);

        return redirect()->route('perpustakaan.kondisibuku.index');
    }

    public function updateKondisi(Request $request, $id)
    {
          $list_kondisi = ListKondisi::find($id);
          $list_kondisi->update([
            'kode_kondisi' => $request->kode_kondisi,
            'nama_kondisi' => $request->nama_kondisi
        ]);

        return redirect()->route('perpustakaan.kondisibuku.index');
    }

    public function deleteKondisi($id)
    {
        $list_kondisi = ListKondisi::find($id);

        $list_kondisi->delete($list_kondisi);

        return redirect()->route('perpustakaan.kondisibuku.index');
    }
}
