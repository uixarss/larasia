<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Waktu;
use App\Models\Hari;

class WaktuHariController extends Controller
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
        $data_waktu = Waktu::all();
        $data_hari = Hari::all();
        return view('admin.settingwaktu.index', [
            'data_hari' => $data_hari,
            'data_waktu' => $data_waktu
        ]);
    }


    /**
     * Tambah Waktu
     */

    public function tambahWaktu(Request $request)
    {
        $this->validate($request, [
            'jam_masuk' => 'required',
            'jam_keluar' => 'required'
        ]);

        $data_waktu = Waktu::create([
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar
        ]);

        return redirect()->back();
    }

    /**
     * Tambah Hari
     */

    public function tambahHari(Request $request)
    {
        $this->validate($request, [
            'hari' => 'required'
        ]);
        Hari::create([
            'hari' => $request->hari
        ]);

        return redirect()->back();
    }


    public function updateWaktu(Request $request, $id)
    {
        $data_mapel = Waktu::find($id);

        $data_mapel->update([
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar
        ]);

        return redirect()->back();
    }

    public function updateHari(Request $request, $id)
    {
        $data_mapel = Hari::find($id);

        $data_mapel->update([
            'hari' => $request->hari
        ]);

        return redirect()->back();
    }

    /**
     * Destroy Waktu
     *
     */
    public function destroyWaktu($id)
    {
        $data_waktu = Waktu::find($id);
        $data_waktu->delete($data_waktu);

        return redirect()->back();
    }

    /**
     * Destroy Hari
     */
    public function destroyHari($id)
    {
        $data_hari = Hari::find($id);
        $data_hari->delete($data_hari);

        return redirect()->back();
    }
}
