<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JenisPenghasilan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;


class JenisPenghasilanController extends Controller
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
        $jenis_penghasilan = JenisPenghasilan::all();

        return view('admin.jenispenghasilan.index',
            ['jenis_penghasilan' => $jenis_penghasilan]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $jenis_penghasilan = JenisPenghasilan::orderBy('id', 'desc')->first();;

        $this->validate($request, [
            'jenis_penghasilan' => 'required'
        ]);
    

        $penghasilan = JenisPenghasilan::create([
            'id' => $jenis_penghasilan->id+1,
            'jenis_penghasilan' => $request->jenis_penghasilan
        ]);
        return redirect()->route('admin.jenispenghasilan.index')->with('sukses', 'Data Berhasil Ditambahkan');
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
            'jenis_penghasilan' => 'required'
        ]);

        $jenis_penghasilan = JenisPenghasilan::where('id',$id);
        $jenis_penghasilan->update([
            'jenis_penghasilan' => $request->jenis_penghasilan
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
        
        $jenis_penghasilan = JenisPenghasilan::where('id',$id);

        $jenis_penghasilan->delete();

        return redirect()->route('admin.jenispenghasilan.index')->with('sukses', 'Data Berhasil Dihapus');

    }
}

