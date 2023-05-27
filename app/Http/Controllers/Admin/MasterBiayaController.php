<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterBiayaRequest;
use App\Models\Jurusan;
use App\Models\MasterBiaya;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterBiayaController extends Controller
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
        $data_master_biaya = MasterBiaya::orderBy('kode', 'ASC')->get();
        $data_prodi = Prodi::orderBy('kode_program_studi', 'ASC')->get();

        return view('admin.masterbiaya.index', [
            'data_master_biaya' => $data_master_biaya,
            'data_prodi' => $data_prodi
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
    public function store(MasterBiayaRequest $request)
    {
        try {
            $master = MasterBiaya::create([
                'kode' => $request->kode,
                'nama' => $request->nama,
                'kode_jurusan' => $request->kode_jurusan,
                'tahun_ajaran' => $request->tahun_ajaran,
                'semester' => $request->semester,
                'created_by' => Auth::id(),
            ]);

            return redirect()->back()->with([
                'success' => 'Berhasil menambah master biaya '. $master->nama
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'error' => $th->getMessage()
            ]);
        }
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
        $master = MasterBiaya::find($id);
        $master->delete($master);

        return redirect()->back()->with([
            'success' => 'Master Biaya berhasil dihapus.'
        ]);
    }
}
