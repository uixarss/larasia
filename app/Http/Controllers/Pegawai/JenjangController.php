<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jenjang;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Gate;

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
        if (Gate::denies('view-jenjang')) {
            abort(403, 'User does not have the right permissions.');
        }
        $jenjang = Jenjang::all();

        return view('pegawai.jenjang.index',
            ['jenjang' => $jenjang]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Gate::denies('create-jenjang')) {
            abort(403, 'User does not have the right permissions.');
        }
        $jen = Jenjang::orderBy('id', 'desc')->first();
        $this->validate($request, [
            'nama_jenjang' => 'required',
        ]);
        

        $jenjang= Jenjang::create([
            'id' => $jen->id+1,
            'nama_jenjang' => $request->nama_jenjang,
            'keterangan' => $request->keterangan
        ]);
        return redirect()->route('pegawai.jenjang.index')->with('sukses', 'Data Berhasil Ditambahkan');
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
        if (Gate::denies('update-jenjang')) {
            abort(403, 'User does not have the right permissions.');
        }
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
        if (Gate::denies('delete-jenjang')) {
            abort(403, 'User does not have the right permissions.');
        }
        $jenjang = Jenjang::find($id);

        $jenjang->delete();

        return redirect()->route('pegawai.jenjang.index')->with('sukses', 'Data Berhasil Dihapus');

    }
}
