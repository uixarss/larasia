<?php

namespace App\Http\Controllers\Siswa;

use App\DataPembayaran;
use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DataPembayaranController extends Controller
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
        $siswa = Mahasiswa::where('user_id', Auth::id())->first();
        $data_pembayaran_lunas = DB::table('pembayarans')->where('status','LUNAS')
                                    ->where('id_mahasiswa',$siswa->id)
                                    ->get();
        $data_pembayaran_belum_lunas = DB::table('pembayarans')->where('status','BELUM LUNAS')
                                    ->where('id_mahasiswa',$siswa->id)
                                    ->get();

        return view('siswa.pembayaran.index',[
            'data_pembayaran' => $data_pembayaran_belum_lunas,
            'data_lunas' => $data_pembayaran_lunas
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
     * @param  \App\DataPembayaran  $dataPembayaran
     * @return \Illuminate\Http\Response
     */
    public function show(DataPembayaran $dataPembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataPembayaran  $dataPembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(DataPembayaran $dataPembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataPembayaran  $dataPembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataPembayaran $dataPembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataPembayaran  $dataPembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataPembayaran $dataPembayaran)
    {
        //
    }
}
