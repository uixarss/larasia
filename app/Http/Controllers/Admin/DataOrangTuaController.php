<?php

namespace App\Http\Controllers\Admin;

use App\Models\DataOrangTua;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\User;
use Gate;

class DataOrangTuaController extends Controller
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
        $dataorangtua = DataOrangTua::all();
        $data_siswa = Siswa::all();
        $data_kelas = Kelas::all();
        return view('admin.dataorangtua.index', ['dataorangtua' => $dataorangtua, 'data_siswa' => $data_siswa, 'data_kelas' => $data_kelas]);
    }

    public function uploaddataorangtua()
    {
      return view('admin.dataorangtua.uploaddataorangtua');
    }

    public function detailOrangTua($id)
    {
      return view('admin.dataorangtua.detaildataorangtua');
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
      $user->name = $request->nama_orangtua;
      $user->email = $request->email_orangtua;
      $user->password = bcrypt('namasaya');

      $role = Role::select('id')->where('name', 'orangtua')->first();
      $user->save();

      $user->roles()->attach($role);

      //Insert Ke Tabel Orang Tua
      $dataOrangTua = DataOrangTua::create([
        'user_id' => $user->id,
        'nama_orangtua' => $request->nama_orangtua,
        'siswa_id' => $request->siswa_id,
        'email_orangtua' => $request->email_orangtua,
        'nohp_orangtua' => $request->nohp_orangtua,
        'alamat' => $request->alamat
      ]);

      return redirect()->route('admin.dataorangtua.index')->with('sukses','Data Berhasil Ditambahkan');

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
     * @param  \App\DataOrangTua  $dataOrangTua
     * @return \Illuminate\Http\Response
     */
    public function show(DataOrangTua $dataOrangTua)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataOrangTua  $dataOrangTua
     * @return \Illuminate\Http\Response
     */
    public function edit(DataOrangTua $dataOrangTua)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataOrangTua  $dataOrangTua
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {

      $user = User::find($id);
      $user->update($request->all());

      $dataOrangTua = DataOrangTua::find($id);
      $dataOrangTua->update($request->all());

      return redirect()->route('admin.dataorangtua.index')->with('sukses','Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataOrangTua  $dataOrangTua
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataOrangTua = DataOrangTua::find($id);

        $user = User::where('id', $dataOrangTua->user_id )->first();
        $user->roles()->detach();

        $dataOrangTua->delete($dataOrangTua);
        $user->delete($user);


        return redirect()->route('admin.dataorangtua.index')->with('sukses','Data Berhasil Ditambahkan');
    }
}
