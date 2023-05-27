<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use App\Models\Pemasukan;
use App\Models\Biaya;
use Illuminate\Support\Facades\Auth;
use App\Exports\PemasukanExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapPemasukanExport;

class PemasukanController extends Controller
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
        $bills = Pengeluaran::all();
        $revenue = Pemasukan::all();
        $data_pemasukan = Pemasukan::all();
        return view('admin.pemasukan.index',[
            'data_bills' => $bills,
            'data_revenue' => $revenue,
            'data_pemasukan' => $data_pemasukan
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
        return view('admin.pemasukan.create',[
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

        return redirect()->route('admin.pemasukan.index')->with([
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
        $data_biaya = Biaya::all();
        return view('admin.pemasukan.edit',[
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

        return redirect()->route('admin.pemasukan.index')->with(['success' => 'Berhasil update data pemasukan']);
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

    public function rekapPemasukan(Request $request)
    {

        try {
            $data = explode('-', $request->start);
            $file_name = str_replace('-', '_', $data[0] . '-' . $data[1]);
            return Excel::download(new RekapPemasukanExport($request->start, $request->end), $file_name . '_rekap_pemasukan.xls');
        } catch (\Exception $th) {
            return redirect()->route('admin.pemasukan.index')->with([
                'error' => 'Silahkan coba lagi!'
            ]);
        }
    }

    public function cariRekapPemasukan(Request $request)
    {
        $this->validate($request, [
            'start' => 'required',
            'end' => 'required'
        ]);

        $start = $request->start;
        $end = $request->end;

        $data_pemasukan = Pemasukan::whereBetween('tanggal', [
            Carbon::parse($start)->toDateString(),
            Carbon::parse($end)->toDateString()
        ])
        ->get();

        

        $pemasukan = Pemasukan::where('tanggal', Carbon::today())->get();
        $pemasukan_tanggal = Pemasukan::orderBy('tanggal', 'desc');
        //  $tanggal_absens = '';
        $revenue = Pemasukan::all();
        $bills = Pengeluaran::all();
        

        if (!empty($request->tanggal)) {
            $pemasukan_tanggal = $pemasukan_tanggal->where('tanggal', Carbon::parse($request->tanggal))->get();
        }

        return view('admin.pemasukan.index', [
            'data_pemasukan' => $data_pemasukan,
            'pemasukan' => $pemasukan,
            'pemasukan_tanggal' => $pemasukan_tanggal,
            'tanggal' => $request->tanggal,
            'start' => $start,
            'end' => $end,
            'data_bills' => $bills,
            'data_revenue' => $revenue
        ]);
    }
}
