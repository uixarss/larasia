<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jenjang;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class JenjangController extends Controller
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
        $jenjang = Jenjang::all();

        return view('admin.jenjang.index',
            ['jenjang' => $jenjang]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'nama_jenjang' => 'required',
        ]);
        

        $jenjang= Jenjang::create([
            'nama_jenjang' => $request->nama_jenjang,
            'keterangan' => $request->keterangan
        ]);
        return redirect()->route('admin.jenjang.index')->with('sukses', 'Data Berhasil Ditambahkan');
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
            'nama_jenjang' => 'required',
        ]);


        $jenjang = Jenjang::find($id);
        $jenjang->update([
            'nama_jenjang' => $request->nama_jenjang,
            'keterangan' => $request->keterangan
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
        
        $jenjang = Jenjang::find($id);

        $jenjang->delete();

        return redirect()->route('admin.jenjang.index')->with('sukses', 'Data Berhasil Dihapus');

    }
}
