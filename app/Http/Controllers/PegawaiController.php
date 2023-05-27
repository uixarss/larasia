<?php

namespace App\Http\Controllers;

use App\Pegawai;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Gate;
use App\Http\Controllers\Controller;

class PegawaiController extends Controller
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
    public function index(Request $request)
    {
      if($request->has('cari')){
        $data_pegawai = Pegawai::where('nama_pegawai','LIKE','%'.$request->cari.'%')->get();
      }else {
        $data_pegawai = Pegawai::all();
      }
      return view('admin.datapegawai.index')->with('data_pegawai', $data_pegawai);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //insert Ke Tabel User
        $user = new User;
        $user->name = $request->nama_pegawai;
        $user->email = $request->email;
        $user->password = bcrypt('namasaya');

        $role = Role::select('id')->where('name', 'pegawai')->first();
        $user->save();

        $user->roles()->attach($role);

        //Insert Ke Tabel Pegawai
        $pegawai = Pegawai::create($request->all());


        return redirect('/pegawai')->with('sukses','Data Berhasil Ditambahkan');
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
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $pegawai = Pegawai::find($id);
      return view('admin/datapegawai/show')->with('pegawai', $pegawai);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pegawai = Pegawai::find($id);
        return view('admin/datapegawai/edit')->with('pegawai', $pegawai);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->update($request->all());
        if($request->hasfile('avatar')){
          $request->image('avatar')->move('admin/assets/images/users/',$request->file('avatar')->getClientOriginalName());
          $pegawai->avatar = $request->file('avatar')->getClientOriginalName();
          $pegawai->save();
        }
        return redirect('/pegawai')->with('sukses','Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete($pegawai);

        return redirect('/pegawai')->with('sukses','Data Berhasil Dihapus');
    }
}
