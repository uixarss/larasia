<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\User;
use App\Role;
use App\JenisPendidikan;
use App\JenisPekerjaan;
use App\ListKota;
use App\StatusMilik;
use App\ListKecamatan;
use App\PangkatGolongan;
use App\Lembaga;

use App\Imports\DosenImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DosenExport;

class DosenController extends Controller
{
    //
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
        
        $data_dosen = Dosen::all();

        return view('admin.datadosen.index' , [
          'data_dosen' => $data_dosen,
          ]);
    }

    public function create(Request $request){
        //insert Ke Tabel User
        $user = new User;
        $user->name = $request->nama_dosen;
        $user->email = $request->email;
        $user->password = bcrypt('123456');

        $role = Role::select('id')->where('name', 'guru')->first();

        $user->save();

        $user->roles()->attach($role);

        //Insert Ke Tabel Siswa
        $dosen = Dosen::create([
          'user_id' => $user->id,
          'photo' => null,
          'matkul_id' => null,
          'nama_dosen' => $request->nama_dosen,
          'tempat_lahir' => $request->tempat_lahir,
          'tanggal_lahir' => $request->tanggal_lahir,
          'jenis_kelamin' => $request->jenis_kelamin,
          'id_status_aktif' => 1,
          'nama_status_aktif'=> 'Aktif',
          'nidn' => $request->nidn,
          'email' => $user->email
        ]);

        return redirect()->route('admin.dosen.index')->with('sukses','Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $dosen = Dosen::find($id);

        $data_kelas = Kelas::all();
        $jenis_pendidikan = JenisPendidikan::all();
        $jenis_pekerjaan = JenisPekerjaan::all();
        $data_kota = ListKota::orderBy('name')->get();
        $pangkat_golongan = PangkatGolongan::all();
        $sumber_gaji = StatusMilik::all();
        $data_lembaga = Lembaga::all();

        return view('admin/datadosen/detail', ['data_kelas' => $data_kelas, 'dosen' => $dosen,
                                            'jenis_pekerjaan' => $jenis_pekerjaan, 'data_kota' => $data_kota,
                                            'pangkat_golongan' => $pangkat_golongan, 'sumber_gaji' => $sumber_gaji,
                                            'data_lembaga' => $data_lembaga]);
    }

    public function updateDataKampus(Request $request, $id)
    {
      $dosen = Dosen::find($id);
        
      $status = explode (",", $request->status); 
      $id_status = (integer)$status[0];
      $nama_status= $status[1];

      
      $sumber_gaji = explode (",", $request->sumber_gaji); 
      $id_sumber_gaji = (integer)$sumber_gaji[0];
      $nama_sumber_gaji= $sumber_gaji[1];

      $panggol = explode (",", $request->pangkat_golongan); 
      $id_panggol = (integer)$panggol[0];
      $nama_panggol= $panggol[1];
      
      $lembaga = explode (",", $request->lembaga); 
      $id_lembaga = (integer)$lembaga[0];
      $nama_lembaga= $lembaga[1];

      $dosen->update([
        'nidn' => $request->nidn,
        'nip' => $request->nip,
        'nama_dosen' => $request->nama_dosen,
        'no_sk_cpns' => $request->no_sk_cpns,
        'tanggal_sk_cpns' => $request->tanggal_sk_cpns,
        'no_sk_pengangkatan' => $request->no_sk_pengangkatan,
        'mulai_sk_pengangkatan' => $request->mulai_sk_pengangkatan,
        'id_lembaga_pengangkatan' => $id_lembaga,
        'nama_lembaga_pengangkatan' => $nama_lembaga,
        'id_pangkat_golongan' => $id_panggol,
        'nama_pangkat_golongan' => $nama_panggol,
        'id_sumber_gaji' => $id_sumber_gaji,
        'nama_sumber_gaji' => $nama_sumber_gaji,
        'tanggal_mulai_pns' => $request->tanggal_mulai_pns,
        'id_status_aktif' => $id_status,
        'nama_status_aktif' => $nama_status
      ]);

      $user = User::where('id', $dosen->user_id )->first();

      $user->update([
        'name' => $request->nama_dosen
      ]);

      return redirect()->route('admin.dosen.edit', $dosen->id)->with('sukses','Data Berhasil Diupdate');

    }


    public function updateDataPribadi(Request $request, $id)
    {
      $dosen = Dosen::find($id);
      $this->validate($request, [
        'email' => 'required',
        'nama_dosen' => 'required'
      ]);
  
      $agama = explode (",", $request->nama_agama); 
      $id_agama = (integer)$agama[0];
      $nama_agama= $agama[1];
      
      $wilayah = explode (",", $request->nama_kota); 
      $id_wilayah = (integer)$wilayah[0];
      $nama_wilayah= $wilayah[1];
      
      $kecamatan = explode (",", $request->kecamatan); 
      $id_kecamatan = (integer)$kecamatan[0];
      $nama_kecamatan= $kecamatan[1];

      $user = User::where('id', $dosen->user_id )->first();

      $dosen->update([
        'nik' => $request->nik,
        'nama_dosen' => $request->nama_dosen,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'id_agama' => $id_agama,
        'nama_agama' => $nama_agama,
        'nama_ibu' => $request->nama_ibu,
        'npwp' => $request->npwp,
        'email' => $request->email,
        'telepon' => $request->telepon,
        'handphone' => $request->handphone,
        'jalan' => $request->jalan,
        'dusun' => $request->dusun,
        'rt' => $request->rt,
        'rw' => $request->rw,
        'ds_kel' => $request->ds_kel,
        'kode_pos' => $request->kode_pos,
        'id_wilayah' => $id_wilayah,
        'nama_wilayah' => $nama_wilayah,
        'id_kecamatan' => $id_kecamatan,
        'nama_kecamatan' => $nama_kecamatan

      ]);

      $user->update([
        'name' => $request->nama_dosen,
        'email' => $request->email
      ]);

      return redirect()->route('admin.dosen.edit', $dosen->id)->with('sukses','Data Berhasil Diupdate');
    }

    public function updateLainnya(Request $request,$id)
    {
      $dosen = Dosen::find($id);
      
      $pekerjaan = explode (",", $request->pekerjaan_suami_istri); 

      if($request->status_pernikahan==1){

        $nama_suami_istri = $request->nama_suami_istri;
        $nip_suami_istri = $request->nip_suami_istri;
        $id_pekerjaan_suami_istri = (integer)$pekerjaan[0];
        $nama_pekerjaan_suami_istri= $pekerjaan[1];

      }else{

        $nama_suami_istri = null;
        $nip_suami_istri = null;
        $id_pekerjaan_suami_istri = null;
        $nama_pekerjaan_suami_istri= null;

      }

      $dosen->update([
        'status_pernikahan' => $request->status_pernikahan,
        'nama_suami_istri' => $nama_suami_istri,
        'nip_suami_istri' => $nip_suami_istri,
        'id_pekerjaan_suami_istri' => $id_pekerjaan_suami_istri,
        'nama_pekerjaan_suami_istri' => $nama_pekerjaan_suami_istri,
        'mampu_handle_kebutuhan_khusus' => $request->mampu_handle_kebutuhan_khusus,
        'mampu_handle_braille' => $request->mampu_handle_braille,
        'mampu_handle_bahasa_isyarat' => $request->mampu_handle_bahasa_isyarat

      ]);

      return redirect()->route('admin.dosen.edit', $dosen->id)->with('sukses','Data Berhasil Diupdate');

    }

    public function store(Request $request,$id)
    {
      $kecamatan = ListKecamatan::where('regency_id', $id)->orderBy('name')->pluck('id', 'name');
      return json_encode($kecamatan);
    }

    public function destroy($id){
      
      $dosen = Dosen::find($id);

      $user = User::where('id', $dosen->user_id )->first();
      $user->roles()->detach();

      $dosen->delete($dosen);
      $user->delete($dosen);

      return redirect()->route('admin.dosen.index')->with('sukses','Data Berhasil Dihapus');
    }

    public function dosenExport(Request $request){

      return Excel::download(new DosenExport,'List Dosen.xlsx');
    }

    public function dosenImport(Request $request)
    {
        // validasi
        $this->validate($request, [
          'file' => 'required|mimes:csv,xls,xlsx'
        ]);
    
        // menangkap file excel
        $file = $request->file('file');
    
    
        // import data
        Excel::import(new DosenImport, $file);
    
        // alihkan halaman kembali
        return redirect()->route('admin.dosen.index')->with('sukses','Data Berhasil Dihapus');
    }
}
