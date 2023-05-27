<?php

namespace App\Http\Controllers\Siswa;

use App\DataPribadi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\KelasMahasiswa;
use App\Models\Mahasiswa;
use App\Models\SiswaDetail;
use App\ListKota;
use App\ListNegara;
use App\ListKecamatan;
use App\User;
use App\JenisPendidikan;
use App\JenisPekerjaan;
use App\JenisPenghasilan;

class DataPribadiController extends Controller
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
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        return view('siswa.datapribadi.index', [
            'mahasiswa' => $mahasiswa
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataPribadi  $dataPribadi
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        $data_kota = ListKota::orderBy('name')->get();
        $data_negara = ListNegara::orderBy('nama_negara')->get();
        $jenis_pendidikan = JenisPendidikan::all();
        $jenis_pekerjaan = JenisPekerjaan::all();
        $jenis_penghasilan = JenisPenghasilan::all();


        return view('siswa.datapribadi.edit', [
            'mahasiswa' => $mahasiswa,
            'data_kota' => $data_kota,
            'data_negara' => $data_negara,
            'jenis_pendidikan' => $jenis_pendidikan,
            'jenis_pekerjaan' => $jenis_pekerjaan,
            'jenis_penghasilan' => $jenis_penghasilan
        ]);
    }

    public function updateProfile(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();


        $str_arr = explode(",", $request->nama_agama);
        $int = (int)$str_arr[0];
        $id_agama = $int;
        $nama_agama = $str_arr[1];

        $wilayah = explode(",", $request->nama_kota);
        $id_wilayah = (int)$wilayah[0];
        $nama_wilayah = $wilayah[1];

        $kecamatan = explode(",", $request->kecamatan);
        $id_kecamatan = (int)$kecamatan[0];
        $nama_kecamatan = $kecamatan[1];

        $negara = explode(",", $request->kewarganegaraan);
        $kode_negara = (int)$negara[0];
        $nama_negara = $negara[1];

        $pendidikan = explode(",", $request->pendidikan_ayah);
        $id_pendidikkan_ayah = (int)$pendidikan[0];
        $nama_pendidikan_ayah = $pendidikan[1];

        $pendidikan2 = explode(",", $request->pendidikan_ibu);
        $id_pendidikan_ibu = (int)$pendidikan2[0];
        $nama_pendidikan_ibu = $pendidikan2[1];

        $pekerjaan = explode(",", $request->pekerjaan_ayah);
        $id_pekerjaan_ayah = (int)$pekerjaan[0];
        $nama_pekerjaan_ayah = $pekerjaan[1];

        $pekerjaan2 = explode(",", $request->pekerjaan_ibu);
        $id_pekerjaan_ibu = (int)$pekerjaan2[0];
        $nama_pekerjaan_ibu = $pekerjaan2[1];


        $penghasilan = explode(",", $request->penghasilan_ayah);
        $id_penghasilan_ayah = (int)$penghasilan[0];
        $nama_penghasilan_ayah = $penghasilan[1];

        $penghasilan2 = explode(",", $request->penghasilan_ibu);
        $id_penghasilan_ibu = (int)$penghasilan2[0];
        $nama_penghasilan_ibu = $penghasilan2[1];


        $mahasiswa->update([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'handphone' => $request->handphone,
            'email' => $request->email,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jalan' => $request->jalan,
            'dusun' => $request->dusun,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'kelurahan' => $request->kelurahan,
            'kode_pos' => $request->kode_pos,
            'id_agama' => $id_agama,
            'nama_agama' => $nama_agama,
            'handphone' => $request->handphone,
            'email' => $request->email,
            'id_wilayah' => $id_wilayah,
            'nama_wilayah' => $nama_wilayah,
            'id_kecamatan' => $id_kecamatan,
            'nama_kecamatan' => $nama_kecamatan,
            'id_negara' => $kode_negara,
            'kewarganegaraan' => $nama_negara,
            //Ayah
            'nik_ayah' => $request->nik_ayah,
            'nama_ayah' => $request->nama_ayah,
            'tanggal_lahir_ayah' => $request->tanggal_lahir_ayah,
            'id_pendidikan_ayah' => $id_pendidikkan_ayah,
            'nama_pendidikan_ayah' => $nama_pendidikan_ayah,
            'id_pekerjaan_ayah' => $id_pekerjaan_ayah,
            'nama_pekerjaan_ayah' => $nama_pekerjaan_ayah,
            'id_penghasilan_ayah' => $id_penghasilan_ayah,
            'nama_penghasilan_ayah' => $nama_penghasilan_ayah,

            //Ibu 
            'nik_ibu' => $request->nik_ibu,
            'nama_ibu' => $request->nama_ibu,
            'tanggal_lahir_ibu' => $request->tanggal_lahir_ibu,
            'id_pendidikan_ibu' => $id_pendidikan_ibu,
            'nama_pendidikan_ibu' => $nama_pendidikan_ibu,
            'id_pekerjaan_ibu' => $id_pekerjaan_ibu,
            'nama_pekerjaan_ibu' => $nama_pekerjaan_ibu,
            'id_penghasilan_ibu' => $id_penghasilan_ibu,
            'nama_penghasilan_ibu' => $nama_penghasilan_ibu,
        ]);

        $user = User::where('id', $mahasiswa->user_id)->first();

        $user->update([
            'name' => $request->nama_mahasiswa,
            'email' => $request->email
        ]);
        return redirect()->back()->with([
            'success' => 'Berhasil update biodata pribadi'
        ]);
    }

    public function getKecamatan($id)
    {
        $kecamatan = ListKecamatan::where('regency_id', $id)->orderBy('name')->pluck('id', 'name');
        return json_encode($kecamatan);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataPribadi  $dataPribadi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataPribadi $dataPribadi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataPribadi  $dataPribadi
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataPribadi $dataPribadi)
    {
        //
    }
}
