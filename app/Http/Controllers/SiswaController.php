<?php

namespace App\Http\Controllers;

use App\Siswa;
use App\User;
use App\Role;
use Illuminate\Http\Request;

class SiswaController extends Controller
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
          $data_siswa = Siswa::where('nama_depan','LIKE','%'.$request->cari.'%')->get();
        }else {
          $data_siswa = Siswa::all();
        }
        return view('admin.datasiswa.index')->with('data_siswa', $data_siswa);
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
        $user->name = $request->nama_lengkap;
        $user->email = $request->email;
        $user->password = bcrypt('namasaya');
        $user->save();

        //Insert Ke Tabel Siswa
        $siswa = Siswa::create($request->all());
        $role = Role::select('id')->where('name', 'admin')->first();
        
        return redirect('/siswa')->with('sukses','Data Berhasil Ditambahkan');


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
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $siswa = Siswa::find($id);
      return view('admin/datasiswa/show')->with('siswa', $siswa);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::find($id);
        return view('admin/datasiswa/edit')->with('siswa', $siswa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        $siswa->update($request->all());

        return redirect('/siswa')->with('sukses','Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete($siswa);

        return redirect('/siswa')->with('sukses','Data Berhasil Dihapus');
    }
}
