<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PangkatGolongan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class PangkatGolonganController extends Controller
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
        $pangkat_golongan = PangkatGolongan::all();

        return view('admin.datapangkatgolongan.index',
            ['pangkat_golongan' => $pangkat_golongan]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'jabatan' => 'required',
            'pangkat' => 'required',
            'golongan' => 'required',
            'angka_kredit' => 'required'
        ]);
    

        $panggol = PangkatGolongan::create([
            'jabatan' => $request->jabatan,
            'pangkat' => $request->pangkat,
            'golongan' => $request->golongan,
            'angka_kredit' => $request->angka_kredit
        ]);
        return redirect()->route('admin.pangkatgolongan.index')->with('sukses', 'Data Berhasil Ditambahkan');
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
            'jabatan' => 'required',
            'pangkat' => 'required',
            'golongan' => 'required',
            'angka_kredit' => 'required'
        ]);

        $panggol = PangkatGolongan::where('id',$id);
        
        $panggol->update([
            'jabatan' => $request->jabatan,
            'pangkat' => $request->pangkat,
            'golongan' => $request->golongan,
            'angka_kredit' => $request->angka_kredit
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
        
        $pangkat_golongan = PangkatGolongan::where('id',$id);

        $pangkat_golongan->delete();

        return redirect()->route('admin.pangkatgolongan.index')->with('sukses', 'Data Berhasil Dihapus');

    }
}

