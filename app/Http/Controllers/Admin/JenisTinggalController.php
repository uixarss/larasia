<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JenisTinggal;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;


class JenisTinggalController extends Controller
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
        $jenis_tinggal = JenisTinggal::all();

        return view('admin.jenistinggal.index',
            ['jenis_tinggal' => $jenis_tinggal]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'jenis_tinggal' => 'required'
        ]);
    

        $tinggal = JenisTinggal::create([
            'jenis_tinggal' => $request->jenis_tinggal
        ]);
        return redirect()->route('admin.jenistinggal.index')->with('sukses', 'Data Berhasil Ditambahkan');
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
            'jenis_tinggal' => 'required'
        ]);

        $jenis_tinggal = JenisTinggal::where('id',$id);
        $jenis_tinggal->update([
            'jenis_tinggal' => $request->jenis_tinggal
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
        
        $jenis_tinggal = JenisTinggal::where('id',$id);

        $jenis_tinggal->delete();

        return redirect()->route('admin.jenistinggal.index')->with('sukses', 'Data Berhasil Dihapus');

    }
}

