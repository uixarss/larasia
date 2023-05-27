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

class MataPelajaranController extends Controller
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
        return view('admin.matapelajaran.index', [
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

        //Insert Ke Tabel Matapelajaran
        $data_mapel = MataPelajaran::create([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
            'type' => $request->type,
            'jumlah_jam' => $request->jumlah_jam,
            'hari_id' => $request->hari_id,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('admin.matapelajaran.index');
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

        return redirect()->route('admin.matapelajaran.index');
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

        return redirect()->route('admin.matapelajaran.index');
    }



    public function indexPenugasan()
    {
        $data_tahun_ajaran = TahunAjaran::all();

        $data_guru = Guru::all();

        return view('admin.penugasan.index', [
            'data_tahun_ajaran' => $data_tahun_ajaran,
            'data_guru' => $data_guru
        ]);
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

        $data_mapel->update([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
            'type' => $request->type,
            'jumlah_jam' => $request->jumlah_jam,
            'hari_id' => $request->hari_id,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('admin.matapelajaran.index');
    }

    public function updateWaktu(Request $request, $id)
    {
        $data_mapel = Waktu::find($id);

        $data_mapel->update([
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar
        ]);

        return redirect()->route('admin.matapelajaran.index');
    }

    public function updateHari(Request $request, $id)
    {
        $data_mapel = Hari::find($id);

        $data_mapel->update([
            'hari' => $request->hari
        ]);

        return redirect()->route('admin.matapelajaran.index');
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

        return redirect()->route('admin.matapelajaran.index');
    }

    /**
     * Destroy Waktu
     *
     */
    public function destroyWaktu($id)
    {
        $data_waktu = Waktu::find($id);
        $data_waktu->delete($data_waktu);

        return redirect()->route('admin.matapelajaran.index');
    }

    /**
     * Destroy Hari
     */
    public function destroyHari($id)
    {
        $data_hari = Hari::find($id);
        $data_hari->delete($data_hari);

        return redirect()->route('admin.matapelajaran.index');
    }
}
