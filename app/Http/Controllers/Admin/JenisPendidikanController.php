<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prodi;
use App\JenisPendidikan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class JenisPendidikanController extends Controller
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
        $jenis_pendidikan = JenisPendidikan::all();

        return view('admin.jenispendidikan.index',
            ['jenis_pendidikan' => $jenis_pendidikan]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'jenis_pendidikan' => 'required'
        ]);
    

        $pendidikan = JenisPendidikan::create([

            'jenis_pendidikan' => $request->jenis_pendidikan
        ]);
        return redirect()->route('admin.jenispendidikan.index')->with('sukses', 'Data Berhasil Ditambahkan');
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
            'jenis_pendidikan' => 'required'
        ]);

        $jenis_pendidikan = JenisPendidikan::where('id',$id);
        $jenis_pendidikan->update([
            'jenis_pendidikan' => $request->jenis_pendidikan
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
        
        $jenis_pendidikan = JenisPendidikan::where('id',$id);

        $jenis_pendidikan->delete();

        return redirect()->route('admin.jenispendidikan.index')->with('sukses', 'Data Berhasil Dihapus');

    }
}
