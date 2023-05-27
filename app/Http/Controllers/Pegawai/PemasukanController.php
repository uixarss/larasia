<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use App\Models\Pemasukan;
use App\Models\Biaya;
use Illuminate\Support\Facades\Auth;
use Gate;


class PemasukanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:pegawai']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('view-keuangan')) {
            abort(403, 'User does not have the right permissions.');
        }
        $bills = Pengeluaran::all();
        $revenue = Pemasukan::all();
        return view('pegawai.pemasukan.index',[
            'data_bills' => $bills,
            'data_revenue' => $revenue
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data_biaya = Biaya::all();
        return view('pegawai.pemasukan.create',[
            'data_biaya' => $data_biaya
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('create-keuangan')) {
            abort(403, 'User does not have the right permissions.');
        }
        $this->validate($request, [
            'nama' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'amount' => 'required',
            'transfer_via' => 'required',
        ]);
        
        Pemasukan::create([
            'biaya_id' => $request->biaya_id,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'amount' => $request->amount,
            'transfer_via' => $request->transfer_via,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('pegawai.pemasukan.index')->with([
            'success' => 'Berhasil menambah pemasukan'
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
    public function edit(Pemasukan $pemasukan)
    {
        if (Gate::denies('edit-keuangan')) {
            abort(403, 'User does not have the right permissions.');
        }
        $data_biaya = Biaya::all();
        return view('pegawai.pemasukan.edit',[
            'pemasukan' => $pemasukan,
            'data_biaya' => $data_biaya
        ]);
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
        if (Gate::denies('update-keuangan')) {
            abort(403, 'User does not have the right permissions.');
        }
        $pemasukan = Pemasukan::find($id);
        $pemasukan->update([
            'biaya_id' => $request->biaya_id,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'amount' => $request->amount,
            'transfer_via' => $request->transfer_via,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('pegawai.pemasukan.index')->with(['success' => 'Berhasil update data pemasukan']);
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
