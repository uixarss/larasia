<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use App\User;
use App\Models\Guru;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PengaturanGuruController extends Controller
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
        $guru = Dosen::where('user_id', Auth::id())->first();

        return view('guru.pengaturan.index',[
            'guru' => $guru
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
        $this->validate($request,[
            'nama_lengkap' => 'required',
            'email' => 'required|email',

        ]);

        $user = User::find(Auth::id());
        $guru = Dosen::where('user_id', Auth::id())->first();

        $user->email = $request->email;
        if ($request->password == "") {
          $user->password = $user->password;
          $user->save();
        }else {
          $user->password = Hash::make($request->password);
          $user->save();
        }

        if($request->hasFile('photo_guru')){
            $photoGuru = $request->file('photo_guru');
            $extension = $photoGuru->getClientOriginalExtension();
            $filename = $guru->nama_dosen. '_'.$guru->nidn. '.' .$extension;
            if (File::exists($photoGuru)) {
              $photoGuru->move('admin/assets/images/users/guru/',$filename);
              File::delete($photoGuru);
            }

            $guru->nama_dosen = $request->nama_lengkap;
            $guru->email = $request->email;

            $guru->photo = $filename;

            $guru->save();

          }else{
            $guru->nama_dosen = $request->nama_lengkap;
            $guru->email = $request->email;
            $guru->save();

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
