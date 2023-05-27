<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prodi;
use App\AlatTransportasi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class TransportasiController extends Controller
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
        $transportasi = AlatTransportasi::all();

        return view('admin.alattransportasi.index',
            ['transportasi' => $transportasi]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'alat_transportasi' => 'required'
        ]);
    

        $transportasi = AlatTransportasi::create([
            'alat_transportasi' => $request->alat_transportasi
        ]);
        return redirect()->route('admin.transportasi.index')->with('sukses', 'Data Berhasil Ditambahkan');
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
            'alat_transportasi' => 'required'
        ]);

        $alat_transportasi = AlatTransportasi::where('id',$id);
        $alat_transportasi->update([
            'alat_transportasi' => $request->alat_transportasi
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
        
        $alat_transportasi = AlatTransportasi::where('id',$id);

        $alat_transportasi->delete();

        return redirect()->route('admin.transportasi.index')->with('sukses', 'Data Berhasil Dihapus');

    }
}
