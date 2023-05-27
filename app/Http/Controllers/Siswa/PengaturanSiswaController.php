<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\PengaturanSiswa;
use App\Models\Siswa;
use App\Models\Mahasiswa;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PengaturanSiswaController extends Controller
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
        $siswa = Mahasiswa::where('user_id', Auth::id())->first();
        return view('siswa.pengaturan.index',[
            'siswa' => $siswa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\PengaturanSiswa  $pengaturanSiswa
     * @return \Illuminate\Http\Response
     */
    public function show(PengaturanSiswa $pengaturanSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PengaturanSiswa  $pengaturanSiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(PengaturanSiswa $pengaturanSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PengaturanSiswa  $pengaturanSiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate($request,[
            'nama_mahasiswa' => 'required',
            'email' => 'required|email',
            
        ]);

        // if($v->fails()){
        //     return redirect()->back()->withErrors($v->errors());
        // }


        $user = User::find(Auth::id());
        $siswa = Mahasiswa::where('user_id', Auth::id())->first();

        $user->email = $request->email;
        if ($request->password == "") {
          $user->password = $user->password;
          $user->save();
        }else {
          $user->password = Hash::make($request->password);
          $user->save();
        }

        if($request->hasFile('photo_siswa')){
            $photoSiswa = $request->file('photo_siswa');
            $extension = $photoSiswa->getClientOriginalExtension();
            $filename =  $siswa->NIS . '.' .$extension;
            if (File::exists($photoSiswa)) {
              $photoSiswa->move('admin/assets/images/users/siswa/',$filename);
              File::delete($photoSiswa);
            }

            $siswa->nama_depan = $request->nama_depan;
            $siswa->nama_belakang = $request->nama_belakang;
            $siswa->email_siswa = $request->email;

            $siswa->photo = $filename;

            $siswa->save();

          }else{
            $siswa->nama_mahasiswa = $request->nama_mahasiswa;
            $siswa->email = $request->email;
            $siswa->save();



          }

        return redirect()->back();



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PengaturanSiswa  $pengaturanSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(PengaturanSiswa $pengaturanSiswa)
    {
        //
    }
}
