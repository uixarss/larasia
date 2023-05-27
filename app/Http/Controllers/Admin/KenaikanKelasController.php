<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\KenaikanKelas;
use Illuminate\Http\Request;

class KenaikanKelasController extends Controller
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
        return view('admin.kenaikankelas.index');
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
     * @param  \App\KenaikanKelas  $kenaikanKelas
     * @return \Illuminate\Http\Response
     */
    public function show(KenaikanKelas $kenaikanKelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KenaikanKelas  $kenaikanKelas
     * @return \Illuminate\Http\Response
     */
    public function edit(KenaikanKelas $kenaikanKelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KenaikanKelas  $kenaikanKelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KenaikanKelas $kenaikanKelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KenaikanKelas  $kenaikanKelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(KenaikanKelas $kenaikanKelas)
    {
        //
    }
}
