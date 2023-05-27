<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Pimpinan;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_pimpinan = Pimpinan::with(['fakultas','jurusan','prodi','dosen'])->get();
        $data_dosen = Dosen::get();
        $data_fakultas = Fakultas::get();
        $data_jurusan = Jurusan::get();

        return view('admin.pimpinan.index',[
            'data_pimpinan' => $data_pimpinan,
            'data_fakultas' => $data_fakultas,
            'data_jurusan' => $data_jurusan,
            'data_dosen' => $data_dosen
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
        $this->validate($request,[
            'fakultas_id' => 'required',
            'jurusan_id' => 'required',
            'prodi_id' => 'required',
            'dosen_id'=> 'required',
            'status'=> 'required',
            'mulai_menjabat' => 'required',
            'akhir_menjabat' => 'required',
            'posisi_jabatan' => 'required'
        ]);

        $pimpinan = Pimpinan::create([
            'fakultas_id' => $request->fakultas_id,
            'jurusan_id' => $request->jurusan_id,
            'prodi_id' => $request->prodi_id,
            'dosen_id' => $request->dosen_id,
            'status' => $request->status,
            'mulai_menjabat' => $request->mulai_menjabat,
            'akhir_menjabat' => $request->akhir_menjabat,
            'posisi_jabatan' => $request->posisi_jabatan
        ]);

        return redirect()->back()->with(['success' => 'Berhasil menambah pimpinan'.' '. $pimpinan->dosen->nama_dosen]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pimpinan = Pimpinan::find($id);

        $pimpinan->delete();

        return redirect()->back()->with(['success' => 'Berhasil menghapus pimpinan']);
    }

    public function prodi(Request $request, $id){
        $prodi = Prodi::where('id_jurusan', $id)->orderBy('id_prodi')->pluck('id_prodi', 'nama_program_studi');
        return json_encode($prodi);
  
    }
    public function jurusan(Request $request, $id){
        $jurusan = Jurusan::where('id_fakultas', $id)->orderBy('id')->pluck('id', 'nama_jurusan');
        return json_encode($jurusan);
  
    }
}
