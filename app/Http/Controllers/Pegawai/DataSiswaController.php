<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\SiswaDetail;
use KelasSeeder;

class DataSiswaController extends Controller
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
        $data_kelas = Kelas::all();
        $data_siswa = Siswa::all();
        return view('pegawai.datasiswa.index', [
            'data_kelas' => $data_kelas,
            'data_siswa' => $data_siswa
        ]);
    }

    public function detaildatasiswa($id)
    {
        $siswa = Siswa::find($id);
        $siswa_detail = SiswaDetail::where('siswa_id', $siswa->id)->first();
        $data_kelas = Kelas::all();
        return view('pegawai.datasiswa.detaildatasiswa', [
            'siswa' => $siswa,
            'siswa_detail' => $siswa_detail,
            'data_kelas' => $data_kelas
        ]);
    }

    public function updateSekolahdatasiswa(Request $request, $id)
    {

        $this->validate($request, [
            'NIS' => 'required',
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'kelas_id' => 'required',
            'status' => 'required'
        ]);
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return redirect()->back();
        }

        $siswa->NIS = $request->NIS;
        $siswa->nama_depan = $request->nama_depan;
        $siswa->nama_belakang = $request->nama_belakang;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->status = $request->status;

        $siswa->save();

        return redirect()->back();
    }

    public function updatePribadidatasiswa(Request $request, $id)
    {
        $this->validate($request, [
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'kebangsaan' => 'required',
            'alamat_sekarang' => 'required',
            'anak_ke' => 'required',
            'jumlah_saudara' => 'required',
            'kondisi_siswa' => 'required',
            'agama' => 'required',
            'no_phone' => 'required',
            'email_siswa' => 'required',
        ]);

        $siswa = Siswa::find($id);
        if (!$siswa) {
            return redirect()->back();
        }

        $siswa->nama_depan = $request->nama_depan;
        $siswa->nama_belakang = $request->nama_belakang;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->tempat_lahir = $request->tempat_lahir;
        $siswa->kebangsaan = $request->kebangsaan;
        $siswa->alamat_sekarang =  $request->alamat_sekarang;
        $siswa->agama = $request->agama;
        $siswa->no_phone = $request->no_phone;
        $siswa->email_siswa = $request->email_siswa;
        $siswa->save();

        $id_detail = SiswaDetail::where('siswa_id', $id)->first();

        $siswa_detail = SiswaDetail::find($id_detail->id);

        if (!$siswa_detail) {
            return redirect()->back();
        }
        $siswa_detail->anak_ke = $request->anak_ke;
        $siswa_detail->jumlah_saudara = $request->jumlah_saudara;
        $siswa_detail->kondisi_siswa = $request->kondisi_siswa;
        $siswa_detail->save();


        return redirect()->back();
    }

    public function updatePendidikandatasiswa(Request $request, $id)
    {
        $this->validate($request, [
            'asal_sd' => 'required',
            'asal_smp' => 'required',

        ]);
        $id_detail = SiswaDetail::where('siswa_id', $id)->first();

        $siswa_detail = SiswaDetail::find($id_detail->id);
        if (!$siswa_detail) {
            return redirect()->back();
        }
        $siswa_detail->asal_sd = $request->asal_sd;
        $siswa_detail->asal_smp = $request->asal_smp;
        $siswa_detail->save();

        return redirect()->back();
    }

    public function updateOrtudatasiswa(Request $request, $id)
    {
        $this->validate($request, [
            'nama_ayah' => 'required',
            'no_hp_ayah' => 'required',
            'pendidikan_ayah' => 'required',
            'pekerjaan_ayah' => 'required',
            'penghasilan_ayah' => 'required',
            'alamat_lengkap_ayah' => 'required',
            'nama_ibu' => 'required',
            'no_hp_ibu' => 'required',
            'pendidikan_ibu' => 'required',
            'pekerjaan_ibu' => 'required',
            'penghasilan_ibu' => 'required',
            'alamat_lengkap_ibu' => 'required'

        ]);


        $id_detail = SiswaDetail::where('siswa_id', $id)->first();

        $siswa_detail = SiswaDetail::find($id_detail->id);
        if (!$siswa_detail) {
            return redirect()->back();
        }
        $siswa_detail->nama_ayah = $request->nama_ayah;
        $siswa_detail->no_hp_ayah = $request->no_hp_ayah;
        $siswa_detail->pendidikan_ayah = $request->pendidikan_ayah;
        $siswa_detail->pekerjaan_ayah = $request->pekerjaan_ayah;
        $siswa_detail->penghasilan_ayah = $request->penghasilan_ayah;
        $siswa_detail->alamat_lengkap_ayah = $request->alamat_lengkap_ayah;

        $siswa_detail->nama_ibu = $request->nama_ibu;
        $siswa_detail->no_hp_ibu = $request->no_hp_ibu;
        $siswa_detail->pendidikan_ibu = $request->pendidikan_ibu;
        $siswa_detail->pekerjaan_ibu = $request->pekerjaan_ibu;
        $siswa_detail->penghasilan_ibu = $request->penghasilan_ibu;
        $siswa_detail->alamat_lengkap_ibu = $request->alamat_lengkap_ibu;

        $siswa_detail->save();
        return redirect()->back();
    }
}
