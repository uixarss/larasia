<?php

namespace App\Http\Controllers\Admin;

use App\AbsensiGuru;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbsensiGuruController extends Controller
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
        return view('admin.absensiguru.index');
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
     * @param  \App\AbsensiGuru  $absensiGuru
     * @return \Illuminate\Http\Response
     */
    public function show(AbsensiGuru $absensiGuru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AbsensiGuru  $absensiGuru
     * @return \Illuminate\Http\Response
     */
    public function edit(AbsensiGuru $absensiGuru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AbsensiGuru  $absensiGuru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AbsensiGuru $absensiGuru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AbsensiGuru  $absensiGuru
     * @return \Illuminate\Http\Response
     */
    public function destroy(AbsensiGuru $absensiGuru)
    {
        //
    }
}
