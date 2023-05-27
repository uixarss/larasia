<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Jurusan;
use App\Models\Visi;
use App\Models\Misi;
use Illuminate\Support\Facades\Auth;
use App\Jenjang;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class ProdiController extends Controller
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
        $prodi = Prodi::join('jurusans','prodi.id_jurusan','=', 'jurusans.id')->get();
        // dd($prodi);
        $jenjang = Jenjang::all();
        $jurusan = Jurusan::all();

        return view('admin.prodi.index',
            ['prodi' => $prodi,
            'jenjang' => $jenjang,
            'jurusan' => $jurusan]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $this->validate($request, [
            'kode_program_studi' => 'required|unique:prodi',
            'nama_program_studi' => 'required',
            'status' => 'required',
            'nama_jenjang_pendidikan' => 'required'
        ]);
        

        $jenjang = $request->nama_jenjang_pendidikan;
        
        $str_arr = explode (",", $jenjang); 
        $int = (int)$str_arr[1];
        $id_jenjang = $int;
        $nama_jenjang= $str_arr[0];

        $prodi = Prodi::create([
            'id_jurusan' => $request->id_jurusan,
            'kode_program_studi' => $request->kode_program_studi,
            'nama_program_studi' => $request->nama_program_studi,
            'status' => $request->status,
            'id_jenjang_pendidikan' => $id_jenjang,
            'nama_jenjang_pendidikan' => $nama_jenjang
        ]);
        return redirect()->route('admin.prodi.index')->with('sukses', 'Data Berhasil Ditambahkan');
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
            'kode_program_studi' => 'required',
            'nama_program_studi' => 'required',
            'status' => 'required',
            'nama_jenjang_pendidikan' => 'required'
        ]);


        $jenjang = $request->nama_jenjang_pendidikan;
        
        $str_arr = explode (",", $jenjang); 
        $int = (int)$str_arr[1];
        $id_jenjang = $int;
        $nama_jenjang= $str_arr[0];

        $prodi = Prodi::where('id_prodi',$id);
        $prodi->update([
            'id_jurusan' => $request->id_jurusan,
            'kode_program_studi' => $request->kode_program_studi,
            'nama_program_studi' => $request->nama_program_studi,
            'status' => $request->status,
            'id_jenjang_pendidikan' => $id_jenjang,
            'nama_jenjang_pendidikan' => $nama_jenjang
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
        
        $prodi = Prodi::where('id_prodi',$id);

        $prodi->delete();

        return redirect()->route('admin.prodi.index')->with('sukses', 'Data Berhasil Dihapus');

    }

    public function visiProdi($id)
    {
        $prodi = Prodi::where('id_prodi',$id)->first();

        $data_visi = Visi::where('visiable_type', Prodi::class)->where('visiable_id', $id)->get();
        $data_misi = Misi::where('misiable_type', Prodi::class)->where('misiable_id', $id)->get();

        return view('admin.prodi.visi.index',[
            'data_visi' => $data_visi,
            'data_misi' => $data_misi,
            'prodi' => $prodi
        ]);
    }

    public function storeVisiProdi(Request $request, $id)
    {
        $prodi = Prodi::where('id_prodi',$id)->first();

        $visi = new Visi([
            'teks' => $request->teks,
            'visiable_id' => $id,
            'visiable_type' => Prodi::class,
            'created_by' => Auth::id()
        ]);
        $visi->save();

        return redirect()->back()->with([
            'success' => 'Berhasil Menambah Visi Prodi'
        ]);
    }

    public function storeMisiProdi(Request $request, $id)
    {
        $prodi = Prodi::where('id_prodi',$id)->first();

        $misi = new Misi([
            'teks' => $request->teks,
            'misiable_id' => $id,
            'misiable_type' => Prodi::class,
            'created_by' => Auth::id()
        ]);

        $misi->save();

        return redirect()->back()->with([
            'success' => 'Berhasil Menambah Misi Prodi'
        ]);
    }

    public function updateVisiProdi(Request $request, $id)
    {
        $visi = Visi::find($id);

        $visi->update([
            'teks' => $request->teks,
            'updated_by' => Auth::id()
        ]);

        return redirect()->back()->with([
            'success' => 'Berhasil Update Visi Prodi'
        ]);
    }

    public function updateMisiProdi(Request $request, $id)
    {
        $misi = Misi::find($id);

        $misi->update([
            'teks' => $request->teks,
            'updated_by' => Auth::id()
        ]);
        return redirect()->back()->with([
            'success' => 'Berhasil Update Misi Prodi'
        ]);
    }

    public function destroyVisiProdi($id)
    {
        $visi = Visi::find($id);
        $visi->delete();
        return redirect()->back()->with([
            'success' => 'Berhasil Hapus Visi Prodi'
        ]);
    }

    public function destroyMisiProdi($id)
    {
        $misi = Misi::find($id);
        $misi->delete();
        return redirect()->back()->with([
            'success' => 'Berhasil Hapus Misi Prodi'
        ]);
    }
}
