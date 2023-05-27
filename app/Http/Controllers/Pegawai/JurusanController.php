<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Jenjang;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Gate;

class JurusanController extends Controller
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
        if (Gate::denies('view-jurusan')) {
            abort(403, 'User does not have the right permissions.');
        }
        $latestPosts = DB::table('fakultas')
                   ->select('nama_fakultas', DB::raw('id as id_fakultas'));

        $jurusan = DB::table('jurusans')
                ->joinSub($latestPosts, 'fakultas', function ($join) {
                    $join->on('jurusans.id_fakultas', '=', 'fakultas.id_fakultas');
                })->get();


        $fakultas = Fakultas::all();
        // dd($users);

        return view('pegawai.jurusan.index',
            ['jurusan' => $jurusan,
            'fakultas' => $fakultas]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Gate::denies('create-jurusan')) {
            abort(403, 'User does not have the right permissions.');
        }
        $this->validate($request, [
            'kode_jurusan' => 'required|unique:jurusans',
            'nama_jurusan' => 'required'
        ]);
        
        $jurusan = Jurusan::create([
            'id_fakultas' => $request->id_fakultas,
            'kode_jurusan' => $request->kode_jurusan,
            'nama_jurusan' => $request->nama_jurusan,
        ]);
        return redirect()->route('pegawai.jurusan.index')->with('sukses', 'Data Berhasil Ditambahkan');
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
        if (Gate::denies('update-jurusan')) {
            abort(403, 'User does not have the right permissions.');
        }
        $this->validate($request, [
            'kode_jurusan' => 'required',
            'nama_jurusan' => 'required',
        ]);
        $jurusan = Jurusan::where('id',$id);
        $jurusan->update([
            'id_fakultas' => $request->id_fakultas,
            'kode_jurusan' => $request->kode_jurusan,
            'nama_jurusan' => $request->nama_jurusan,
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
        if (Gate::denies('delete-jurusan')) {
            abort(403, 'User does not have the right permissions.');
        }
        $jurusan = Jurusan::where('id',$id);

        $jurusan->delete();

        return redirect()->route('pegawai.jurusan.index')->with('sukses', 'Data Berhasil Dihapus');

    }
}
