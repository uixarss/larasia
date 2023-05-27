<?php

namespace App\Http\Controllers\Guru\WaliKelas;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\TahunAjaran;
use App\Models\TahunAjaranGuruKelas;

class DataSiswaController extends Controller
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
        ->where('tahun_ajaran_id',$tahun_ajaran->id)->first();
        // dd($data_walikelas);

        return view('guru.walikelas.datakelas.index',[
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
    public function show($id)
    {
        $data_kelas = Kelas::find($id);

        $data_siswa = Siswa::where('kelas_id', $data_kelas->id)->get();

        return view('guru.walikelas.datakelas.show',[
          'data_kelas' => $data_kelas,
          'data_siswa' => $data_siswa
        ]);
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
