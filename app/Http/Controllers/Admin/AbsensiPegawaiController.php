<?php

namespace App\Http\Controllers\Admin;

use App\AbsensiPegawai;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbsensiPegawaiController extends Controller
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
        return view('admin.absensipegawai.index');
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
     * @param  \App\AbsensiPegawai  $absensiPegawai
     * @return \Illuminate\Http\Response
     */
    public function show(AbsensiPegawai $absensiPegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AbsensiPegawai  $absensiPegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(AbsensiPegawai $absensiPegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AbsensiPegawai  $absensiPegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AbsensiPegawai $absensiPegawai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AbsensiPegawai  $absensiPegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(AbsensiPegawai $absensiPegawai)
    {
        //
    }
}
