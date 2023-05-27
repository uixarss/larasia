<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Fakultas;
use App\Jenjang;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Gate;

class FakultasController extends Controller
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
        if (Gate::denies('view-fakultas')) {
            abort(403, 'User does not have the right permissions.');
        }
        $fakultas = Fakultas::all();

        return view('pegawai.fakultas.index',
            ['fakultas' => $fakultas,]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Gate::denies('create-fakultas')) {
            abort(403, 'User does not have the right permissions.');
        }
        $this->validate($request, [
            'kode_fakultas' => 'required|unique:fakultas',
            'nama_fakultas' => 'required',
        ]);

        $fakultas = Fakultas::create([
            'kode_fakultas' => $request->kode_fakultas,
            'nama_fakultas' => $request->nama_fakultas,
        ]);
        return redirect()->route('pegawai.fakultas.index')->with('sukses', 'Data Berhasil Ditambahkan');
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
        if (Gate::denies('update-fakultas')) {
            abort(403, 'User does not have the right permissions.');
        }
        $this->validate($request, [
            'kode_fakultas' => 'required',
            'nama_fakultas' => 'required',
        ]);

        $fakultas = Fakultas::where('id',$id);
        $fakultas->update([
            'kode_fakultas' => $request->kode_fakultas,
            'nama_fakultas' => $request->nama_fakultas,
        ]);

        return redirect()->back();
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('delete-fakultas')) {
            abort(403, 'User does not have the right permissions.');
        }
        $fakultas = Fakultas::where('id',$id);

        $fakultas->delete();

        return redirect()->route('pegawai.fakultas.index')->with('sukses', 'Data Berhasil Dihapus');

    }
}
