<?php

namespace App\Http\Controllers\Perpustakaan;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Denda;
use App\Models\DendaBuku;
use Illuminate\Support\Facades\Hash;

class PengaturanPerpustakaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perpus = User::where('id', Auth::id())->first();
        $denda = Denda::all()->first();

        $jumlah_denda = DendaBuku::sum('jumlah_denda');

        // dd($jumlah_denda);

        return view('perpustakaan.pengaturan.index', [
          'perpus' => $perpus,
          'denda' => $denda,
          'jumlah_denda' => $jumlah_denda
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

      $denda = Denda::find($request->id);

      if ($denda == null) {
        Denda::create([
          'uang_denda' => $request->jumlah
        ]);
      }else {
        $denda->update([
          'uang_denda' => $request->jumlah
        ]);
      }

      return back();
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
          $user = User::find($id);

          $user->name = $request->name;
          $user->email = $request->email;
          if ($request->password == "") {
            $user->password = $user->password;
            $user->save();
          }else {
            $user->password = Hash::make($request->password);
            $user->save();
          }

          return back();
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
