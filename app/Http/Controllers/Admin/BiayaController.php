<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisBiayaRequest;
use App\Models\Biaya;
use App\Models\JenisBiaya;
use Illuminate\Http\Request;

class BiayaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $biaya = Biaya::all();
        $jenis_biaya = JenisBiaya::all();

        return view('admin.biaya.index', [
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
        //
        $jenis_biaya = JenisBiaya::all();

        return view('admin.biaya.create', [
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
        //
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

        return redirect()->route('admin.biaya.index')->with(['success' => 'Berhasil menambah ' . $request->nama . '.']);
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
        //
        $jenis_biaya = JenisBiaya::all();
        return view('admin.biaya.edit', [
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
    public function update(Request $request, $id)
    {
        //
        $biaya = Biaya::find($id);
        $biaya->nama = $request->nama;
        $biaya->deskripsi = $request->deskripsi;
        $biaya->jenis_biaya_id = $request->jenis_biaya_id;
        $biaya->jumlah = $request->jumlah;
        $biaya->save();
        return redirect()->route('admin.biaya.index')->with(['success' => 'Berhasil update ' . $biaya->nama . '.']);
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
        $biaya = Biaya::find($id);
        $biaya->delete($biaya);

        return redirect()->back()->with(['success' => 'Berhasil menghapus biaya']);
    }

    public function indexJenisBiaya()
    {
        $data_jenis_biaya = JenisBiaya::orderBy('nama', 'ASC')->get();

        return view('admin.jenisbiaya.index',[
            'data_jenis_biaya' => $data_jenis_biaya
        ]);
    }

    public function storeJenisBiaya(JenisBiayaRequest $request)
    {

        $jenis_biaya = new JenisBiaya();
        $jenis_biaya->nama = $request->nama;
        $jenis_biaya->save();

        return redirect()->back()->with(['success' => 'Berhasil menambah jenis biaya baru']);
    }

    public function updateJenisBiaya(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required'
        ]);
        try {
            $jenis_biaya = JenisBiaya::find($id);
            $jenis_biaya->nama = $request->nama;
            $jenis_biaya->save();
            return redirect()->back()->with(['success' => 'Berhasil mengubah jenis biaya ' . $jenis_biaya->nama]);
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'error' => $th->getMessage()
            ]);
        }
    }

    public function destroyJenisBiaya($id)
    {
        $jenis_biaya = JenisBiaya::find($id);
        $jenis_biaya->delete($jenis_biaya);

        return redirect()->back()->with(['success' => 'Berhasil menghapus jenis biaya']);
    }
}
