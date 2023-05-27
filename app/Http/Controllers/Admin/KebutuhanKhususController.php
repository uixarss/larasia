<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\KebutuhanKhusus;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;


class KebutuhanKhususController extends Controller
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
        $kebutuhan_khusus = KebutuhanKhusus::all();

        return view('admin.kebutuhankhusus.index',
            ['kebutuhan_khusus' => $kebutuhan_khusus]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        

        $this->validate($request, [
            'kebutuhan_khusus' => 'required'
        ]);
    

        $kebutuhan = KebutuhanKhusus::create([
            'kebutuhan_khusus' => $request->kebutuhan_khusus
        ]);
        return redirect()->route('admin.kebutuhankhusus.index')->with('sukses', 'Data Berhasil Ditambahkan');
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
            'kebutuhan_khusus' => 'required'
        ]);

        $kebutuhan_khusus = KebutuhanKhusus::where('id',$id);
        $kebutuhan_khusus->update([
            'kebutuhan_khusus' => $request->kebutuhan_khusus
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
        
        $kebutuhan_khusus = KebutuhanKhusus::where('id',$id);

        $kebutuhan_khusus->delete();

        return redirect()->route('admin.kebutuhankhusus.index')->with('sukses', 'Data Berhasil Dihapus');

    }
}

