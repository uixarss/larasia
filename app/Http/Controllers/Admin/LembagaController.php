<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lembaga;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class LembagaController extends Controller
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
        $data_lembaga = Lembaga::all();

        return view('admin.lembaga.index',
            ['data_lembaga' => $data_lembaga]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        

        $this->validate($request, [
            'nama_lembaga' => 'required'
        ]);

        $status = Lembaga::create([
            'nama_lembaga' => $request->nama_lembaga
        ]);
        return redirect()->route('admin.lembaga.index')->with('sukses', 'Data Berhasil Ditambahkan');
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
            'nama_lembaga' => 'required'
        ]);

        $lembaga = Lembaga::where('id',$id);
        $lembaga->update([
            'nama_lembaga' => $request->nama_lembaga
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
        
        $lembaga = Lembaga::where('id',$id);

        $lembaga->delete();

        return redirect()->route('admin.lembaga.index')->with('sukses', 'Data Berhasil Dihapus');

    }
}

