<?php

namespace App\Http\Controllers\Pegawai;
use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Hari;
use App\Models\MataPelajaran;
use App\Models\TipeMataPelajaran;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\Waktu;
use Illuminate\Http\Request;
use Gate;

class MataKuliahController extends Controller
{

    public function __construct()
    {
      $this ->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('view-mata-kuliah')) {
            abort(403, 'User does not have the right permissions.');
        }

        $data_mapel = MataPelajaran::all();
        $data_tipemapel = TipeMataPelajaran::all();
        $data_kelas = Kelas::all();
        $data_waktu = Waktu::all();
        $data_hari = Hari::all();
        return view('pegawai.matakuliah.index',[
          'data_mapel' => $data_mapel ,
          'data_tipemapel' => $data_tipemapel ,
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
        if (Gate::denies('create-mata-kuliah')) {
            abort(403, 'User does not have the right permissions.');
        }
        $this->validate($request, [
            'kode_mapel' => 'required|unique:mapel',
            'nama_mapel' => 'required',
            'jumlah_sks' => 'required'
        ]);

        //Insert Ke Tabel Matapelajaran
        $data_mapel = MataPelajaran::create([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
            'tipe_mapel_id' => $request->tipe_mapel_id,
            'jumlah_sks' => $request->jumlah_sks,
            'jumlah_jam' => $request->jumlah_jam,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('pegawai.matakuliah.index');
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
        if (Gate::denies('update-mata-kuliah')) {
            abort(403, 'User does not have the right permissions.');
        }
          $data_mapel = MataPelajaran::find($id);

          $data_mapel->update([
            'kode_mapel' => $request->kode_mapel,
            'nama_mapel' => $request->nama_mapel,
            'tipe_mapel_id' => $request->tipe_mapel_id,
            'jumlah_sks' => $request->jumlah_sks,
            'jumlah_jam' => $request->jumlah_jam,
            'keterangan' => $request->keterangan
          ]);

          return redirect()->route('pegawai.matakuliah.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('delete-mata-kuliah')) {
            abort(403, 'User does not have the right permissions.');
        }
        $data_mapel = MataPelajaran::find($id);
        $data_mapel->delete($data_mapel);

        return redirect()->route('pegawai.matakuliah.index');
    }

}
