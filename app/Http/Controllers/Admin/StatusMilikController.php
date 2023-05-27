<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\StatusMilik;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;


class StatusMilikController extends Controller
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
        $status_milik = StatusMilik::all();

        return view('admin.statusmilik.index',
            ['status_milik' => $status_milik]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'status_milik' => 'required'
        ]);
    

        $status = StatusMilik::create([
            'status_milik' => $request->status_milik
        ]);
        return redirect()->route('admin.statusmilik.index')->with('sukses', 'Data Berhasil Ditambahkan');
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
            'status_milik' => 'required'
        ]);

        $status_milik = StatusMilik::where('id',$id);
        $status_milik->update([
            'status_milik' => $request->status_milik
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
        
        $status_milik = StatusMilik::where('id',$id);

        $status_milik->delete();

        return redirect()->route('admin.statusmilik.index')->with('sukses', 'Data Berhasil Dihapus');

    }
}

