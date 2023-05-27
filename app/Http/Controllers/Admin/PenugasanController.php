<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TahunAjaran;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\MataPelajaran;
use App\Models\Prodi;
use App\Models\Semester;

class PenugasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_tahun_ajaran = TahunAjaran::all();
        $data_semester = Semester::all();
        $data_fakultas = Fakultas::all();
        $data_jurusan = Jurusan::all();
        $data_prodi = Prodi::all();
        $data_dosen = Dosen::all();
        $data_mapel = MataPelajaran::all();

        return view('admin.penugasan.index', [
            'data_tahun_ajaran' => $data_tahun_ajaran,
            'data_semester' => $data_semester,
            'data_fakultas' => $data_fakultas,
            'data_jurusan' => $data_jurusan,
            'data_prodi' => $data_prodi,
            'data_mapel' => $data_mapel,
            'data_dosen' => $data_dosen
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
