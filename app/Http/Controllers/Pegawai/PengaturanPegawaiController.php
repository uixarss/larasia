<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class PengaturanPegawaiController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $pegawai = Pegawai::where('user_id', Auth::id())->first();
    return view('pegawai.pengaturan.index', [
      'pegawai' => $pegawai
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
  public function update(Request $request)
  {
    $this->validate($request, [
      'nama_pegawai' => 'required',
      'email' => 'required|email',

    ]);

    $user = User::find(Auth::id());
    $pegawai = Pegawai::where('user_id', Auth::id())->first();

    $user->email = $request->email;
    if ($request->password == "") {
      $user->password = $user->password;
      $user->save();
    } else {
      $user->password = Hash::make($request->password);
      $user->save();
    }

    if ($request->hasFile('photo_pegawai')) {
      $photoPegawai = $request->file('photo_pegawai');
      $extension = $photoPegawai->getClientOriginalExtension();
      $filename =  $pegawai->pegawai . '_' . $pegawai->NIP . '.' . $extension;
      if (File::exists($photoPegawai)) {
        $photoPegawai->move('admin/assets/images/users/pegawai/', $filename);
        File::delete($photoPegawai);
      }

      $pegawai->nama_pegawai = $request->nama_pegawai;
      $pegawai->email = $request->email;

      $pegawai->photo = $filename;

      $pegawai->save();
    } else {
      $pegawai->nama_pegawai = $request->nama_pegawai;
      $pegawai->email = $request->email;
      $pegawai->save();
    }

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
    //
  }
}
