<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Fakultas;
use App\Jenjang;
use App\Models\Visi;
use App\Models\Misi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
        $fakultas = Fakultas::all();

        return view('admin.fakultas.index',
            ['fakultas' => $fakultas,]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $this->validate($request, [
            'kode_fakultas' => 'required|unique:fakultas',
            'nama_fakultas' => 'required',
        ]);

        $fakultas = Fakultas::create([
            'kode_fakultas' => $request->kode_fakultas,
            'nama_fakultas' => $request->nama_fakultas,
        ]);
        return redirect()->route('admin.fakultas.index')->with('sukses', 'Data Berhasil Ditambahkan');
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
        
        $fakultas = Fakultas::where('id',$id);

        $fakultas->delete();

        return redirect()->route('admin.fakultas.index')->with('sukses', 'Data Berhasil Dihapus');

    }


    public function visiFakultas($id)
    {
        $fakultas = Fakultas::find($id);

        $data_visi = $fakultas->visis;
        $data_misi = $fakultas->misis;

        return view('admin.fakultas.visi.index',[
            'data_visi' => $data_visi,
            'data_misi' => $data_misi,
            'fakultas' => $fakultas
        ]);
    }

    public function storeVisiFakultas(Request $request, $id)
    {
        $fakultas = Fakultas::find($id);

        $visi = new Visi([
            'teks' => $request->teks,
            'created_by' => Auth::id()
        ]);

        $fakultas->visis()->save($visi);

        return redirect()->back()->with([
            'success' => 'Berhasil Menambah Visi Fakultas'
        ]);
    }

    public function storeMisiFakultas(Request $request, $id)
    {
        $fakultas = Fakultas::find($id);

        $misi = new Misi([
            'teks' => $request->teks,
            'created_by' => Auth::id()
        ]);

        $fakultas->misis()->save($misi);

        return redirect()->back()->with([
            'success' => 'Berhasil Menambah Misi Fakultas'
        ]);
    }

    public function updateVisiFakultas(Request $request, $id)
    {
        $visi = Visi::find($id);

        $visi->update([
            'teks' => $request->teks,
            'updated_by' => Auth::id()
        ]);

        return redirect()->back()->with([
            'success' => 'Berhasil Update Visi Fakultas'
        ]);
    }

    public function updateMisiFakultas(Request $request, $id)
    {
        $misi = Misi::find($id);

        $misi->update([
            'teks' => $request->teks,
            'updated_by' => Auth::id()
        ]);
        return redirect()->back()->with([
            'success' => 'Berhasil Update Misi Fakultas'
        ]);
    }

    public function destroyVisiFakultas($id)
    {
        $visi = Visi::find($id);
        $visi->delete();
        return redirect()->back()->with([
            'success' => 'Berhasil Hapus Visi Fakultas'
        ]);
    }

    public function destroyMisiFakultas($id)
    {
        $misi = Misi::find($id);
        $misi->delete();
        return redirect()->back()->with([
            'success' => 'Berhasil Hapus Misi Fakultas'
        ]);
    }
}
