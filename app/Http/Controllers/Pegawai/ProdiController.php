<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Jurusan;
use App\Jenjang;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Gate;

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
        if (Gate::denies('view-prodi')) {
            abort(403, 'User does not have the right permissions.');
        }
        $prodi = Prodi::join('jurusans','prodi.id_jurusan','=', 'jurusans.id')->get();
        // dd($prodi);
        $jenjang = Jenjang::all();
        $jurusan = Jurusan::all();

        return view('pegawai.prodi.index',
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
        if (Gate::denies('create-prodi')) {
            abort(403, 'User does not have the right permissions.');
        }
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
        return redirect()->route('pegawai.prodi.index')->with('sukses', 'Data Berhasil Ditambahkan');
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
        if (Gate::denies('update-prodi')) {
            abort(403, 'User does not have the right permissions.');
        }
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
        if (Gate::denies('delete-prodi')) {
            abort(403, 'User does not have the right permissions.');
        }
        $prodi = Prodi::where('id_prodi',$id);

        $prodi->delete();

        return redirect()->route('pegawai.prodi.index')->with('sukses', 'Data Berhasil Dihapus');

    }
}
