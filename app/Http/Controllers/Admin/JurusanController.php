<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\Visi;
use App\Models\Misi;
use Illuminate\Support\Facades\Auth;
use App\Jenjang;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

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
        $latestPosts = DB::table('fakultas')
                   ->select('nama_fakultas', DB::raw('id as id_fakultas'));

        $jurusan = DB::table('jurusans')
                ->joinSub($latestPosts, 'fakultas', function ($join) {
                    $join->on('jurusans.id_fakultas', '=', 'fakultas.id_fakultas');
                })->get();


        $fakultas = Fakultas::all();
        // dd($users);

        return view('admin.jurusan.index',
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
        
        $this->validate($request, [
            'kode_jurusan' => 'required|unique:jurusans',
            'nama_jurusan' => 'required'
        ]);
        
        $jurusan = Jurusan::create([
            'id_fakultas' => $request->id_fakultas,
            'kode_jurusan' => $request->kode_jurusan,
            'nama_jurusan' => $request->nama_jurusan,
        ]);
        return redirect()->route('admin.jurusan.index')->with('sukses', 'Data Berhasil Ditambahkan');
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
        
        $jurusan = Jurusan::where('id',$id);

        $jurusan->delete();

        return redirect()->route('admin.jurusan.index')->with('sukses', 'Data Berhasil Dihapus');

    }

    public function visiJurusan($id)
    {
        $jurusan = Jurusan::find($id);

        $data_visi = $jurusan->visis;
        $data_misi = $jurusan->misis;

        return view('admin.jurusan.visi.index',[
            'data_visi' => $data_visi,
            'data_misi' => $data_misi,
            'jurusan' => $jurusan
        ]);
    }

    public function storeVisiJurusan(Request $request, $id)
    {
        $jurusan = Jurusan::find($id);

        $visi = new Visi([
            'teks' => $request->teks,
            'created_by' => Auth::id()
        ]);

        $jurusan->visis()->save($visi);

        return redirect()->back()->with([
            'success' => 'Berhasil Menambah Visi Jurusan'
        ]);
    }

    public function storeMisiJurusan(Request $request, $id)
    {
        $jurusan = Jurusan::find($id);

        $misi = new Misi([
            'teks' => $request->teks,
            'created_by' => Auth::id()
        ]);

        $jurusan->misis()->save($misi);

        return redirect()->back()->with([
            'success' => 'Berhasil Menambah Misi Jurusan'
        ]);
    }

    public function updateVisiJurusan(Request $request, $id)
    {
        $visi = Visi::find($id);

        $visi->update([
            'teks' => $request->teks,
            'updated_by' => Auth::id()
        ]);

        return redirect()->back()->with([
            'success' => 'Berhasil Update Visi Jurusan'
        ]);
    }

    public function updateMisiJurusan(Request $request, $id)
    {
        $misi = Misi::find($id);

        $misi->update([
            'teks' => $request->teks,
            'updated_by' => Auth::id()
        ]);
        return redirect()->back()->with([
            'success' => 'Berhasil Update Misi Jurusan'
        ]);
    }

    public function destroyVisiJurusan($id)
    {
        $visi = Visi::find($id);
        $visi->delete();
        return redirect()->back()->with([
            'success' => 'Berhasil Hapus Visi Jurusan'
        ]);
    }

    public function destroyMisiJurusan($id)
    {
        $misi = Misi::find($id);
        $misi->delete();
        return redirect()->back()->with([
            'success' => 'Berhasil Hapus Misi Jurusan'
        ]);
    }
}
