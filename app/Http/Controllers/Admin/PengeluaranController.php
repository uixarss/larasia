<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PengeluaranRequest;
use App\Models\Biaya;
use App\Models\Pemasukan;
use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;
use App\Exports\RekapPengeluaranExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;


class PengeluaranController extends Controller
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
        $bills = Pengeluaran::with('jenis')->get();
        $data_pengeluaran = Pengeluaran::with('jenis')->get();
        $revenue = Pemasukan::all();
        return view('admin.pengeluaran.index', [
            'data_bills' => $bills,
            'data_revenue' => $revenue,
            'data_pengeluaran' => $bills
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

        return view('admin.pengeluaran.create',[
            'data_biaya' => $data_biaya
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PengeluaranRequest $request)
    {
        // $this->validate($request, [
        //     'nama' => 'required',
        //     'deskripsi' => 'required',
        //     'tanggal' => 'required',
        //     'amount' => 'required',
        //     'transfer_via' => 'required',
        // ]);
        
        Pengeluaran::create([
            'biaya_id' => $request->biaya_id,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'amount' => $request->amount,
            'transfer_via' => $request->transfer_via,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.pengeluaran.index')->with([
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
        $data_biaya = Biaya::all();
        return view('admin.pengeluaran.edit',[
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

        return redirect()->route('admin.pengeluaran.index')->with(['success' => 'Berhasil update data pengeluaran']);
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

     public function cariRekapPengeluaran(Request $request)
    {
        $this->validate($request, [
            'start' => 'required',
            'end' => 'required'
        ]);

        $start = $request->start;
        $end = $request->end;

        $data_pengeluaran = Pengeluaran::whereBetween('tanggal', [
            Carbon::parse($start)->toDateString(),
            Carbon::parse($end)->toDateString()
        ])
        ->get();

        

        $pengeluaran = Pengeluaran::where('tanggal', Carbon::today())->get();
        $pengeluaran_tanggal = Pengeluaran::orderBy('tanggal', 'desc');
        //  $tanggal_absens = '';
        $revenue = Pemasukan::all();
        $bills = Pengeluaran::with('jenis')->get();
        

        if (!empty($request->tanggal)) {
            $pengeluaran_tanggal = $pengeluaran_tanggal->where('tanggal', Carbon::parse($request->tanggal))->get();
        }

        return view('admin.pengeluaran.index', [
            'data_pengeluaran' => $data_pengeluaran,
            'pengeluaran' => $pengeluaran,
            'pengeluaran_tanggal' => $pengeluaran_tanggal,
            'tanggal' => $request->tanggal,
            'start' => $start,
            'end' => $end,
            'data_bills' => $bills,
            'data_revenue' => $revenue
        ]);
    }

    public function rekapPengeluaran(Request $request)
    {

        try {
            $data = explode('-', $request->start);
            $file_name = str_replace('-', '_', $data[0] . '-' . $data[1]);
            return Excel::download(new RekapPengeluaranExport($request->start, $request->end), $file_name . '_rekap_pengeluaran.xls');
        } catch (\Exception $th) {
            return redirect()->route('admin.pengeluaran.index')->with([
                'error' => 'Silahkan coba lagi!'
            ]);
        }
    }
}
