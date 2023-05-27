<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Hari;
use App\Models\MataPelajaran;
use App\Models\TipeMataPelajaran;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\Waktu;
use Illuminate\Http\Request;
use App\Imports\MatkulImport;
use Maatwebsite\Excel\Facades\Excel;

class MataKuliahController extends Controller
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
        $data_mapel = MataPelajaran::all();
        $data_tipemapel = TipeMataPelajaran::all();
        $data_kelas = Kelas::all();
        $data_waktu = Waktu::all();
        $data_hari = Hari::all();
        return view('admin.matakuliah.index', [
            'data_mapel' => $data_mapel,
            'data_tipemapel' => $data_tipemapel,
            'data_kelas' => $data_kelas,
            'data_hari' => $data_hari,
            'data_waktu' => $data_waktu
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'kode_mapel' => 'required|unique:mapel',
            'nama_mapel' => 'required',
            'jumlah_sks' => 'required'
        ]);

        //Insert Ke Tabel Matapelajaran
        $data_mapel = MataPelajaran::create([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
            'type' => $request->type,
            'jumlah_sks' => $request->jumlah_sks,
            'jumlah_jam' => $request->jumlah_jam,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('admin.matakuliah.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data_mapel = MataPelajaran::find($id);

        if ($data_mapel != null) {
            $data_mapel->update([
                'kode_mapel' => $request->kode_mapel,
                'nama_mapel' => $request->nama_mapel,
                'type' => $request->type,
                'jumlah_sks' => $request->jumlah_sks,
                'jumlah_jam' => $request->jumlah_jam,
                'keterangan' => $request->keterangan
            ]);
    
            return redirect()->route('admin.matakuliah.index');
        } else {
            return redirect()->back();
        }
    }


    public function matkulImport(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');


        // import data
        Excel::import(new MatkulImport, $file);

        // alihkan halaman kembali
        return redirect()->back()->with('success', 'Data Berhasil Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data_mapel = MataPelajaran::find($id);
        $data_mapel->delete($data_mapel);

        return redirect()->route('admin.matakuliah.index');
    }
}
