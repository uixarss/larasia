<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Mahasiswa;
use App\Models\DataPeminjamanBuku;
use App\Models\DendaBuku;

class PeminjamanBukuController extends Controller
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
        $siswa = Mahasiswa::where('user_id', Auth::id())->first();

        $data_peminjaman = DataPeminjamanBuku::where('siswa_id', $siswa->id)
            ->where('status', '1')->get();

        $data_pengembalian = DataPeminjamanBuku::where('siswa_id', $siswa->id)
            ->where('status', '0')->get();

        $data_denda = DendaBuku::where('siswa_id', $siswa->id)->get();

        // dd($data_denda);

        return view('siswa.peminjamanbuku.index', [
            'data_peminjaman' => $data_peminjaman,
            'data_pengembalian' => $data_pengembalian,
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
