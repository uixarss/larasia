<?php

namespace App\Http\Controllers\Admin;

use App\AbsensiSiswa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbsensiSiswaController extends Controller
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
        return view('admin.absensisiswa.index');
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
     * @param  \App\AbsensiSiswa  $absensiSiswa
     * @return \Illuminate\Http\Response
     */
    public function show(AbsensiSiswa $absensiSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AbsensiSiswa  $absensiSiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(AbsensiSiswa $absensiSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AbsensiSiswa  $absensiSiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AbsensiSiswa $absensiSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AbsensiSiswa  $absensiSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(AbsensiSiswa $absensiSiswa)
    {
        //
    }
}
