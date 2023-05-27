<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JenisPekerjaan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class JenisPekerjaanController extends Controller
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
        $jenis_pekerjaan = JenisPekerjaan::all();

        return view('admin.jenispekerjaan.index',
            ['jenis_pekerjaan' => $jenis_pekerjaan]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        


        $this->validate($request, [
            'jenis_pekerjaan' => 'required'
        ]);
    

        $pekerjaan = JenisPekerjaan::create([
            'jenis_pekerjaan' => $request->jenis_pekerjaan
        ]);
        return redirect()->route('admin.jenispekerjaan.index')->with('sukses', 'Data Berhasil Ditambahkan');
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
            'jenis_pekerjaan' => 'required'
        ]);

        $jenis_pekerjaan = JenisPekerjaan::where('id',$id);
        $jenis_pekerjaan->update([
            'jenis_pekerjaan' => $request->jenis_pekerjaan
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
        
        $jenis_pekerjaan = JenisPekerjaan::where('id',$id);

        $jenis_pekerjaan->delete();

        return redirect()->route('admin.jenispekerjaan.index')->with('sukses', 'Data Berhasil Dihapus');

    }
}
