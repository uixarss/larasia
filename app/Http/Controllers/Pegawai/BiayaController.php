<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\JenisBiaya;
use Illuminate\Http\Request;
use Gate;

class BiayaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:pegawai']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('view-keuangan')) {
            abort(403, 'User does not have the right permissions.');
        }
        $biaya = Biaya::all();
        $jenis_biaya = JenisBiaya::all();

        return view('pegawai.biaya.index', [
            'data_biaya' => $biaya,
            'data_jenis_biaya' => $jenis_biaya
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('create-keuangan')) {
            abort(403, 'User does not have the right permissions.');
        }
        $jenis_biaya = JenisBiaya::all();

        return view('pegawai.biaya.create', [
            'data_jenis_biaya' => $jenis_biaya
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('manage-keuangan')) {
            abort(403, 'User does not have the right permissions.');
        }
        $this->validate($request, [
            'nama' => 'required',
            'jumlah' => 'required',
            'jenis_biaya_id' => 'required'
        ]);

        if ($request->deskripsi == null) {
            $request->deskripsi = '-';
        }
        $biaya = new Biaya();
        $biaya->nama = $request->nama;
        $biaya->deskripsi = $request->deskripsi;
        $biaya->jenis_biaya_id = $request->jenis_biaya_id;
        $biaya->jumlah = $request->jumlah;
        $biaya->save();

        return redirect()->route('pegawai.biaya.index')->with(['success' => 'Berhasil menambah ' . $request->nama . '.']);
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
    public function edit(Biaya $biaya)
    {
        if (Gate::denies('edit-keuangan')) {
            abort(403, 'User does not have the right permissions.');
        }
        $jenis_biaya = JenisBiaya::all();
        return view('pegawai.biaya.edit', [
            'biaya' => $biaya,
            'data_jenis_biaya' => $jenis_biaya
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        if (Gate::denies('update-keuangan')) {
            abort(403, 'User does not have the right permissions.');
        }
        $biaya = Biaya::find($id);
        $biaya->nama = $request->nama;
        $biaya->deskripsi = $request->deskripsi;
        $biaya->jenis_biaya_id = $request->jenis_biaya_id;
        $biaya->jumlah = $request->jumlah;
        $biaya->save();
        return redirect()->route('pegawai.biaya.index')->with(['success' => 'Berhasil update ' . $biaya->nama . '.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('delete-keuangan')) {
            abort(403, 'User does not have the right permissions.');
        }
        $biaya = Biaya::find($id);
        $biaya->delete($biaya);

        return redirect()->back()->with(['success' => 'Berhasil menghapus biaya']);
    }


    public function storeJenisBiaya(Request $request)
    {
        if (Gate::denies('manage-keuangan')) {
            abort(403, 'User does not have the right permissions.');
        }
        $this->validate($request, [
            'nama' => 'required'
        ]);

        $jenis_biaya = new JenisBiaya();
        $jenis_biaya->nama = $request->nama;
        $jenis_biaya->save();

        return redirect()->back()->with(['success' => 'Berhasil menambah jenis biaya baru']);
    }

    public function destroyJenisBiaya($id)
    {
        if (Gate::denies('manage-keuangan')) {
            abort(403, 'User does not have the right permissions.');
        }
        $jenis_biaya = JenisBiaya::find($id);
        $jenis_biaya->delete($jenis_biaya);

        return redirect()->back()->with(['success' => 'Berhasil menghapus jenis biaya']);
    }
}
