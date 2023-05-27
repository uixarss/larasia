<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AturBiayaRequest;
use App\Models\AturBiaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AturBiayaController extends Controller
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
        $data_atur_biaya = AturBiaya::orderBy('created_at', 'ASC')->get();

        return view('admin.aturbiaya.index', [
            'data_atur_biaya' => $data_atur_biaya
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
    public function store(AturBiayaRequest $request)
    {
        $atur = AturBiaya::create([
            'kode_master_biaya' => $request->kode_master_biaya,
            'biaya_id' => $request->biaya_id,
            'jumlah' => $request->jumlah,
            'model_pembayaran' => $request->model_pembayaran,
            'tipe_biaya' => $request->tipe_biaya,
            'created_by' => Auth::id()
        ]);

        return redirect()->back()->with([
            'success' => 'Berhasil menambah biaya ' . $atur->master->nama . '.'
        ]);
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
        try {
            $atur = AturBiaya::find($id);

            $atur->delete($atur);

            return redirect()->back()->with([
                'success' => 'Berhasil menghapus data.'
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'error' => $th->getMessage()
            ]);
        }
    }
}
