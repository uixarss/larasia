<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Pemasukan;
use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
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
        $bills = Pengeluaran::with('jenis')->get();
        $revenue = Pemasukan::all();
        return view('pegawai.pengeluaran.index', [
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
        //
        $data_biaya = Biaya::all();

        return view('pegawai.pengeluaran.create',[
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
        
        Pengeluaran::create([
            'biaya_id' => $request->biaya_id,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'amount' => $request->amount,
            'transfer_via' => $request->transfer_via,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('pegawai.pengeluaran.index')->with([
            'success' => 'Berhasil menambah pengeluaran'
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
    public function edit(Pengeluaran $pengeluaran)
    {
        if (Gate::denies('edot-keuangan')) {
            abort(403, 'User does not have the right permissions.');
        }
        $data_biaya = Biaya::all();
        return view('pegawai.pengeluaran.edit',[
            'pengeluaran' => $pengeluaran,
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
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->update([
            'biaya_id' => $request->biaya_id,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'amount' => $request->amount,
            'transfer_via' => $request->transfer_via,
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('pegawai.pengeluaran.index')->with(['success' => 'Berhasil update data pengeluaran']);
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
