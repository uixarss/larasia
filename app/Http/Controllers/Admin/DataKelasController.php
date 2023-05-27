<?php

namespace App\Http\Controllers\Admin;

use App\DataKelas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataKelasController extends Controller
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
        return view('admin.datakelas.index');
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
     * @param  \App\DataKelas  $dataKelas
     * @return \Illuminate\Http\Response
     */
    public function show(DataKelas $dataKelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataKelas  $dataKelas
     * @return \Illuminate\Http\Response
     */
    public function edit(DataKelas $dataKelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataKelas  $dataKelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataKelas $dataKelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataKelas  $dataKelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataKelas $dataKelas)
    {
        //
    }
}
