<?php

namespace App\Http\Controllers\Admin;

use App\DataPegawai;
use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\Fakultas;
use App\Models\Mutasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Role;
use App\User;
use Illuminate\Support\Facades\DB;
use Gate;

class DataPegawaiController extends Controller
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
    $data_guru = Guru::all();
    $data_pegawai = Pegawai::all();
    $mapel = MataPelajaran::all();
    return view('admin.datapegawai.index', ['data_guru' => $data_guru, 'data_pegawai' => $data_pegawai, 'mapel' => $mapel]);
  }

  public function uploaddatapegawaiakademik()
  {
    return view('admin.datapegawai.akademik.uploaddatapegawai');
  }

  public function uploaddatapegawainonakademik()
  {
    return view('admin.datapegawai.nonakademik.uploaddatapegawai');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    //insert Ke Tabel User
    $user = new User;
    $user->name = $request->nama_pegawai;
    $user->email = $request->email;
    $password = $request->nip . '@stikom2021';
    $user->password = bcrypt($password);

    $role = Role::select('id')->where('name', 'pegawai')->first();
    $user->save();

    $user->roles()->attach($role);
    //Insert Ke Tabel Pegawai
    $datapegawai = Pegawai::create([
      'NIP' => $request->nip,
      'user_id' => $user->id,
      'nama_pegawai' => $request->nama_pegawai,
      'email' => $request->email,
      'agama' => $request->agama,
      'tanggal_lahir' => $request->tanggal_lahir,
      'jenis_kelamin' => $request->jenis_kelamin,
      'phone_no' => $request->no_hp,
      'alamat' => $request->alamat,
      'bagian_pegawai' => $request->bagian_pegawai,
      'jabatan_pegawai' => $request->jabatan_pegawai,
      'status_pegawai' => $request->status_pegawai,
      'tanggal_masuk' => $request->tanggal_masuk
    ]);

    return redirect()->route('admin.datapegawai.index')->with('sukses', 'Data Berhasil Ditambahkan');
  }

  public function tambahGuru(Request $request)
  {
    $this->validate($request, [
      'email' => 'required|email',
      'password' => 'required|min:8',
      'nama_lengkap' => 'required',
      'NIP' => 'required',
      'jabatan_pegawai' => 'required',
      'bagian_pegawai' => 'required',
      'status_pegawai' => 'required',
      'tanggal_masuk' => 'required',
      'alamat' => 'required',
    ]);
    $guruRole = Role::where('name', 'guru')->first();

    $user = new User;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->name = $request->nama_lengkap;
    $user->save();

    $user->roles()->attach($guruRole);

    $guru = new Guru;
    $guru->user_id = $user->id;
    $guru->NIP = $request->NIP;
    $guru->nama_lengkap = $request->nama_lengkap;
    $guru->email = $request->email;
    $guru->bagian_pegawai = $request->bagian_pegawai;
    $guru->jabatan_pegawai = $request->jabatan_pegawai;
    $guru->status_pegawai = $request->status_pegawai;
    $guru->tanggal_masuk = $request->tanggal_masuk;
    $guru->alamat = $request->alamat;
    $guru->save();

    return redirect()->back();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\DataPegawai  $dataPegawai
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $datapegawai = DataPegawai::find($id);
    return view('admin/datapegawai/show')->with('pegawai', $datapegawai);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\DataPegawai  $dataPegawai
   * @return \Illuminate\Http\Response
   */
  public function edit(DataPegawai $dataPegawai)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\DataPegawai  $dataPegawai
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {

    $datapegawai = DataPegawai::find($id);


    // $user = new User;
    // $user->name = $request->nama_pegawai;
    // $user->email = $request->email_pegawai;
    // $user->password = bcrypt('namasaya');
    // $user->save();

    $datapegawai->update($request->all());

    return redirect()->route('admin.datapegawai.index')->with('sukses', 'Data Berhasil Ditambahkan');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\DataPegawai  $dataPegawai
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {

    if (Gate::denies('delete-users')) {
      return redirect()->route('admin.datapegawai.index');
    }

    $user = new User;
    $user->roles()->detach();
    $user->delete($id);

    $dataPegawai = DataPegawai::find($id);
    $dataPegawai->delete($id);

    return redirect()->route('admin.datapegawai.index')->with('sukses', 'Data Berhasil Dihapus');
  }

  public function hapusAkademik($id)
  {
    if (Gate::denies('delete-users')) {
      return redirect()->route('admin.datapegawai.index');
    }

    $guru = Guru::find($id);

    $user = new User;

    $user->roles()->detach();
    $user->delete($guru->user_id);
    $guru->delete($id);

    return redirect()->route('admin.datapegawai.index')->with('sukses', 'Data berhasil dihapus');
  }

  public function hapusNonAkademik($id)
  {
    if (Gate::denies('delete-users')) {
      return redirect()->route('admin.datapegawai.index');
    }

    $pegawai = Pegawai::find($id);

    $user = User::where('id', $pegawai->user_id )->first();
    // dd($pegawai);
    $user->roles()->detach();
    
    $pegawai->delete($id);
    $user->delete($pegawai);

    return redirect()->route('admin.datapegawai.index')->with('sukses', 'Data berhasil dihapus');
  }

  public function detailpegawaiakademik($id)
  {
    $guru = Guru::find($id);



    return view('admin.datapegawai.akademik.detailpegawaiakademik', [
      'guru' => $guru
    ]);
  }

  public function detailpegawainonakademik($id)
  {
    $pegawai = Pegawai::find($id);
    $fakultas = Fakultas::all();
    $jumlah = count($pegawai->mutasis);
    
        $fakulta = DB::table('fakultas')
                    ->select('nama_fakultas', DB::raw('id as id_fakultas'));
        $jurusans = DB::table('jurusans')
                    ->select('nama_jurusan', DB::raw('id as id_jurusan'));
        $prodis = DB::table('prodi')
                    ->select('nama_program_studi', DB::raw('id_prodi as id_prodi'));
    
                    
      $data_mutasi = DB::table('mutasis')->joinSub($fakulta, 'fakultas', function ($join) {
                      $join->on('mutasis.id_fakultas', '=', 'fakultas.id_fakultas');
                  })->joinSub($jurusans, 'jurusans', function ($join) {
                      $join->on('mutasis.id_jurusan', '=', 'jurusans.id_jurusan');
                  })->joinSub($prodis, 'prodi', function ($join) {
                      $join->on('mutasis.id_prodi', '=', 'prodi.id_prodi');
                  })->where('mutasiable_id','=', $id)->get();


    return view('admin.datapegawai.nonakademik.detailpegawainonakademik', [
      'pegawai' => $pegawai,
      'data_mutasi' => $data_mutasi,
      'data_fakultas' => $fakultas,
      'jumlah' => $jumlah
    ]);
  }

  /**
   * Store Gaji Pegawai
   * 
   */

  function storeGajiPegawai(Request $request, $id)
  {
    $pegawai = Pegawai::find($id);
    $this->validate($request, [
      'tanggal' => 'required',
      'jumlah_gaji' => 'required',
      'tanggal_kenaikan_gaji' => 'required',
      'jumlah_kenaikan_gaji' => 'required',
      'keterangan' => 'required',
    ]);

    $pegawai->gajis()->create([
      'tanggal' => $request->tanggal,
      'jumlah_gaji' => $request->jumlah_gaji,
      'status' => 'Aktif',
      'tanggal_kenaikan_gaji' => $request->tanggal_kenaikan_gaji,
      'jumlah_kenaikan_gaji' => $request->jumlah_kenaikan_gaji,
      'keterangan' => $request->keterangan,
    ]);

    return redirect()->back();
  }

  /**
   * Update Gaji Pegawai
   * 
   */
  public function updateGajiPegawai(Request $request, $id, $id_gaji)
  {
    $this->validate($request, [
      'tanggal' => 'required',
      'jumlah_gaji' => 'required',
      'tanggal_kenaikan_gaji' => 'required',
      'jumlah_kenaikan_gaji' => 'required',
      'keterangan' => 'required',
    ]);

    $pegawai = Pegawai::find($id);
    $gaji = $pegawai->gajis()->where('id', $id_gaji)->first();


    $gaji->update([
      'tanggal' => $request->tanggal,
      'jumlah_gaji' => $request->jumlah_gaji,
      'tanggal_kenaikan_gaji' => $request->tanggal_kenaikan_gaji,
      'jumlah_kenaikan_gaji' => $request->jumlah_kenaikan_gaji,
      'keterangan' => $request->keterangan,

    ]);
    return redirect()->back();
  }

  /**
   * Delete Gaji Pegawai
   * 
   */
  public function deleteGajiPegawai($id, $id_gaji)
  {
    $pegawai = Pegawai::find($id);
    $gaji = $pegawai->gajis()->where('id', $id_gaji)->first();
    $gaji->delete($gaji);
    return redirect()->back();
  }


  /**
   * Store Gaji Pegawai
   * 
   */

  function storeGajiGuru(Request $request, $id)
  {
    $pegawai = Guru::find($id);
    $this->validate($request, [
      'tanggal' => 'required',
      'jumlah_gaji' => 'required',
      'tanggal_kenaikan_gaji' => 'required',
      'jumlah_kenaikan_gaji' => 'required',
      'keterangan' => 'required',
    ]);

    $pegawai->gajis()->create([
      'tanggal' => $request->tanggal,
      'jumlah_gaji' => $request->jumlah_gaji,
      'status' => 'Aktif',
      'tanggal_kenaikan_gaji' => $request->tanggal_kenaikan_gaji,
      'jumlah_kenaikan_gaji' => $request->jumlah_kenaikan_gaji,
      'keterangan' => $request->keterangan,
    ]);

    return redirect()->back();
  }

  /**
   * Update Gaji Guru
   * 
   */
  public function updateGajiGuru(Request $request, $id, $id_gaji)
  {
    $this->validate($request, [
      'tanggal' => 'required',
      'jumlah_gaji' => 'required',
      'tanggal_kenaikan_gaji' => 'required',
      'jumlah_kenaikan_gaji' => 'required',
      'keterangan' => 'required',
    ]);

    $pegawai = Guru::find($id);
    $gaji = $pegawai->gajis()->where('id', $id_gaji)->first();


    $gaji->update([
      'tanggal' => $request->tanggal,
      'jumlah_gaji' => $request->jumlah_gaji,
      'tanggal_kenaikan_gaji' => $request->tanggal_kenaikan_gaji,
      'jumlah_kenaikan_gaji' => $request->jumlah_kenaikan_gaji,
      'keterangan' => $request->keterangan,

    ]);
    return redirect()->back();
  }

  /**
   * Delete Gaji Guru
   * 
   */
  public function deleteGajiGuru($id, $id_gaji)
  {
    $pegawai = Guru::find($id);
    $gaji = $pegawai->gajis()->where('id', $id_gaji)->first();
    $gaji->delete($gaji);
    return redirect()->back();
  }


  /**
   * Store Sertifikat Pegawai
   * 
   */

  function storeSertifikatPegawai(Request $request, $id)
  {
    $pegawai = Pegawai::find($id);
    $this->validate($request, [
      'sertifikasi' => 'required',
      'lembaga' => 'required',
      'tahun' => 'required',
      'status' => 'required',
      'keterangan' => 'required'
    ]);

    $pegawai->sertifikats()->create([
      'sertifikasi' => $request->sertifikasi,
      'lembaga' => $request->lembaga,
      'tahun' => $request->tahun,
      'status' => $request->status,
      'keterangan' => $request->keterangan
    ]);

    return redirect()->back();
  }

  /**
   * Update Sertifikat Pegawai
   * 
   */
  public function updateSertifikatPegawai(Request $request, $id, $id_sertifikat)
  {
    $this->validate($request, [
      'sertifikasi' => 'required',
      'lembaga' => 'required',
      'tahun' => 'required',
      'status' => 'required',
      'keterangan' => 'required'
    ]);

    $pegawai = Pegawai::find($id);
    $gaji = $pegawai->sertifikats()->where('id', $id_sertifikat)->first();


    $gaji->update([
      'sertifikasi' => $request->sertifikasi,
      'lembaga' => $request->lembaga,
      'tahun' => $request->tahun,
      'status' => $request->status,
      'keterangan' => $request->keterangan

    ]);
    return redirect()->back();
  }

  /**
   * Delete Sertifikat Pegawai
   * 
   */
  public function deleteSertifikatPegawai($id, $id_sertifikat)
  {
    $pegawai = Pegawai::find($id);
    $gaji = $pegawai->sertifikats()->where('id', $id_sertifikat)->first();
    $gaji->delete($gaji);
    return redirect()->back();
  }


  /**
   * Store Sertifikat Guru
   * 
   */

  function storeSertifikatGuru(Request $request, $id)
  {
    $guru = Guru::find($id);
    $this->validate($request, [
      'sertifikasi' => 'required',
      'lembaga' => 'required',
      'tahun' => 'required',
      'status' => 'required',
      'keterangan' => 'required'
    ]);

    $guru->sertifikats()->create([
      'sertifikasi' => $request->sertifikasi,
      'lembaga' => $request->lembaga,
      'tahun' => $request->tahun,
      'status' => $request->status,
      'keterangan' => $request->keterangan
    ]);

    return redirect()->back();
  }

  /**
   * Update Sertifikat Guru
   * 
   */
  public function updateSertifikatGuru(Request $request, $id, $id_sertifikat)
  {
    $this->validate($request, [
      'sertifikasi' => 'required',
      'lembaga' => 'required',
      'tahun' => 'required',
      'status' => 'required',
      'keterangan' => 'required'
    ]);

    $guru = Guru::find($id);
    $sertifikat = $guru->sertifikats()->where('id', $id_sertifikat)->first();


    $sertifikat->update([
      'sertifikasi' => $request->sertifikasi,
      'lembaga' => $request->lembaga,
      'tahun' => $request->tahun,
      'status' => $request->status,
      'keterangan' => $request->keterangan

    ]);
    return redirect()->back();
  }

  /**
   * Delete Sertifikat Guru
   * 
   */
  public function deleteSertifikatGuru($id, $id_sertifikat)
  {
    $guru = Guru::find($id);
    $sertifikat = $guru->sertifikats()->where('id', $id_sertifikat)->first();
    $sertifikat->delete($sertifikat);
    return redirect()->back();
  }


  /**
   * Store Pendidikan Pegawai
   * 
   */

  function storePendidikanPegawai(Request $request, $id)
  {
    $pegawai = Pegawai::find($id);
    $this->validate($request, [
      'tingkat' => 'required',
      'nama_pendidikan' => 'required',
      'tahun_lulus' => 'required',
      'status' => 'required',
      'surat_keputusan' => 'required',
      'keterangan' => 'required'
    ]);

    $pegawai->pendidikans()->create([
      'tingkat' => $request->tingkat,
      'nama_pendidikan' => $request->nama_pendidikan,
      'tahun_lulus' => $request->tahun_lulus,
      'status' => $request->status,
      'surat_keputusan' => $request->surat_keputusan,
      'keterangan' => $request->keterangan
    ]);

    return redirect()->back();
  }

  /**
   * Update Pendidikan Pegawai
   * 
   */
  public function updatePendidikanPegawai(Request $request, $id, $id_pendidikan)
  {
    $this->validate($request, [
      'tingkat' => 'required',
      'nama_pendidikan' => 'required',
      'tahun_lulus' => 'required',
      'status' => 'required',
      'surat_keputusan' => 'required',
      'keterangan' => 'required'

    ]);

    $pegawai = Pegawai::find($id);
    $pendidikan = $pegawai->pendidikans()->where('id', $id_pendidikan)->first();


    $pendidikan->update([
      'tingkat' => $request->tingkat,
      'nama_pendidikan' => $request->nama_pendidikan,
      'tahun_lulus' => $request->tahun_lulus,
      'status' => $request->status,
      'surat_keputusan' => $request->surat_keputusan,
      'keterangan' => $request->keterangan
    ]);
    return redirect()->back();
  }

  /**
   * Delete Pendidikan Pegawai
   * 
   */
  public function deletePendidikanPegawai($id, $id_pendidikan)
  {
    $pegawai = Pegawai::find($id);
    $pendidikan = $pegawai->pendidikans()->where('id', $id_pendidikan)->first();
    $pendidikan->delete($pendidikan);
    return redirect()->back();
  }

  /**
   * Store Pendidikan Guru
   * 
   */

  function storePendidikanGuru(Request $request, $id)
  {
    $guru = Guru::find($id);
    $this->validate($request, [
      'tingkat' => 'required',
      'nama_pendidikan' => 'required',
      'tahun_lulus' => 'required',
      'status' => 'required',
      'surat_keputusan' => 'required',
      'keterangan' => 'required'
    ]);

    $guru->pendidikans()->create([
      'tingkat' => $request->tingkat,
      'nama_pendidikan' => $request->nama_pendidikan,
      'tahun_lulus' => $request->tahun_lulus,
      'status' => $request->status,
      'surat_keputusan' => $request->surat_keputusan,
      'keterangan' => $request->keterangan
    ]);

    return redirect()->back();
  }

  /**
   * Update Pendidikan Guru
   * 
   */
  public function updatePendidikanGuru(Request $request, $id, $id_pendidikan)
  {
    $this->validate($request, [
      'tingkat' => 'required',
      'nama_pendidikan' => 'required',
      'tahun_lulus' => 'required',
      'status' => 'required',
      'surat_keputusan' => 'required',
      'keterangan' => 'required'

    ]);

    $guru = Guru::find($id);
    $pendidikan = $guru->pendidikans()->where('id', $id_pendidikan)->first();


    $pendidikan->update([
      'tingkat' => $request->tingkat,
      'nama_pendidikan' => $request->nama_pendidikan,
      'tahun_lulus' => $request->tahun_lulus,
      'status' => $request->status,
      'surat_keputusan' => $request->surat_keputusan,
      'keterangan' => $request->keterangan
    ]);
    return redirect()->back();
  }

  /**
   * Delete Pendidikan Guru
   * 
   */
  public function deletePendidikanGuru($id, $id_pendidikan)
  {
    $guru = Guru::find($id);
    $pendidikan = $guru->pendidikans()->where('id', $id_pendidikan)->first();
    $pendidikan->delete($pendidikan);
    return redirect()->back();
  }

  /**
   * Store Pekerjaan Guru
   * 
   */

  function storePekerjaanGuru(Request $request, $id)
  {
    $guru = Guru::find($id);
    $this->validate($request, [
      'tahun_awal' => 'required',
      'tahun_akhir' => 'required',
      'tempat' => 'required',
      'jabatan' => 'required',
      'status' => 'required',
      'keterangan' => 'required'
    ]);

    $guru->pekerjaans()->create([
      'tahun_awal' => $request->tahun_awal,
      'tahun_akhir' => $request->tahun_akhir,
      'tempat' => $request->tempat,
      'jabatan' => $request->jabatan,
      'status' => $request->status,
      'keterangan' => $request->keterangan
    ]);

    return redirect()->back();
  }

  /**
   * Update Pekerjaan Guru
   * 
   */
  public function updatePekerjaanGuru(Request $request, $id, $id_pekerjaan)
  {
    $this->validate($request, [
      'tahun_awal' => 'required',
      'tahun_akhir' => 'required',
      'tempat' => 'required',
      'jabatan' => 'required',
      'status' => 'required',
      'keterangan' => 'required'

    ]);

    $guru = Guru::find($id);
    $Pekerjaan = $guru->pekerjaans()->where('id', $id_pekerjaan)->first();


    $Pekerjaan->update([
      'tahun_awal' => $request->tahun_awal,
      'tahun_akhir' => $request->tahun_akhir,
      'tempat' => $request->tempat,
      'jabatan' => $request->jabatan,
      'status' => $request->status,
      'keterangan' => $request->keterangan
    ]);
    return redirect()->back();
  }

  /**
   * Delete Pekerjaan Guru
   * 
   */
  public function deletePekerjaanGuru($id, $id_pekerjaan)
  {
    $guru = Guru::find($id);
    $Pekerjaan = $guru->pekerjaans()->where('id', $id_pekerjaan)->first();
    $Pekerjaan->delete($Pekerjaan);
    return redirect()->back();
  }


  /**
   * Store Pekerjaan Pegawai
   * 
   */

  function storePekerjaanPegawai(Request $request, $id)
  {
    $Pegawai = Pegawai::find($id);
    $this->validate($request, [
      'tahun_awal' => 'required',
      'tahun_akhir' => 'required',
      'tempat' => 'required',
      'jabatan' => 'required',
      'status' => 'required',
      'keterangan' => 'required'
    ]);

    $Pegawai->pekerjaans()->create([
      'tahun_awal' => $request->tahun_awal,
      'tahun_akhir' => $request->tahun_akhir,
      'tempat' => $request->tempat,
      'jabatan' => $request->jabatan,
      'status' => $request->status,
      'keterangan' => $request->keterangan
    ]);

    return redirect()->back();
  }

  /**
   * Update Pekerjaan Pegawai
   * 
   */
  public function updatePekerjaanPegawai(Request $request, $id, $id_pekerjaan)
  {
    $this->validate($request, [
      'tahun_awal' => 'required',
      'tahun_akhir' => 'required',
      'tempat' => 'required',
      'jabatan' => 'required',
      'status' => 'required',
      'keterangan' => 'required'

    ]);

    $Pegawai = Pegawai::find($id);
    $Pekerjaan = $Pegawai->pekerjaans()->where('id', $id_pekerjaan)->first();


    $Pekerjaan->update([
      'tahun_awal' => $request->tahun_awal,
      'tahun_akhir' => $request->tahun_akhir,
      'tempat' => $request->tempat,
      'jabatan' => $request->jabatan,
      'status' => $request->status,
      'keterangan' => $request->keterangan
    ]);
    return redirect()->back();
  }

  /**
   * Delete Pekerjaan Pegawai
   * 
   */
  public function deletePekerjaanPegawai($id, $id_pekerjaan)
  {
    $Pegawai = Pegawai::find($id);
    $Pekerjaan = $Pegawai->pekerjaans()->where('id', $id_pekerjaan)->first();
    $Pekerjaan->delete($Pekerjaan);
    return redirect()->back();
  }

    /**
   * Store Mutasi Pegawai
   * 
   */

  function storeMutasiPegawai(Request $request, $id)
  {
    $Pegawai = Pegawai::find($id);
    $this->validate($request, [
      'id_fakultas' => 'required',
      'id_jurusan' => 'required',
      'id_prodi' => 'required',
      'bagian' => 'required',
      'jabatan' => 'required',
      'tanggal_mutasi' => 'required',
    ]);

    $Pegawai->mutasis()->create([
      'id_fakultas' => $request->id_fakultas,
      'id_jurusan' => $request->id_jurusan,
      'id_prodi' => $request->id_prodi,
      'bagian' => $request->bagian,
      'jabatan' => $request->jabatan,
      'tanggal_mutasi' => $request->tanggal_mutasi,
      'keterangan' => $request->keterangan,
      'status' => 'Selesai'
    ]);

    return redirect()->back();
  }

  /**
   * Update Mutasi Pegawai
   * 
   */
  public function updateMutasiPegawai(Request $request, $id, $id_mutasi)
  {
    $this->validate($request, [
      'id_fakultas' => 'required',
      'id_jurusan' => 'required',
      'id_prodi' => 'required',
      'bagian' => 'required',
      'jabatan' => 'required',
      'tanggal_mutasi' => 'required',

    ]);

    $Pegawai = Pegawai::find($id);
    $Pekerjaan = $Pegawai->mutasis()->where('id', $id_mutasi)->first();


    $Pekerjaan->update([
      'id_fakultas' => $request->id_fakultas,
      'id_jurusan' => $request->id_jurusan,
      'id_prodi' => $request->id_prodi,
      'bagian' => $request->bagian,
      'jabatan' => $request->jabatan,
      'tanggal_mutasi' => $request->tanggal_mutasi,
      'keterangan' => $request->keterangan,
      'status' => 'Selesai'
    ]);
    return redirect()->back();
  }

  /**
   * Delete Mutasi Pegawai
   * 
   */
  public function deleteMutasiPegawai($id, $id_mutasi)
  {
    $Pegawai = Pegawai::find($id);
    $mutasi = $Pegawai->mutasis()->where('id', $id_mutasi)->first();
    $mutasi->delete($mutasi);
    return redirect()->back();
  }

  /**
   * Update Photo Pegawai Akademik
   * 
   */
  public function updatePhotoAkademik(Request $request, $id)
  {
    $guru = Guru::find($id);

    if ($request->hasFile('photo_guru')) {
      $photoGuru = $request->file('photo_guru');
      $extension = $photoGuru->getClientOriginalExtension();
      $filename = $guru->nama_lengkap . '_' . $guru->NIP . '.' . $extension;
      if (File::exists($photoGuru)) {
        $photoGuru->move('admin/assets/images/users/guru/', $filename);
        File::delete($photoGuru);
      }



      $guru->photo = $filename;

      $guru->save();

      $guru->update([
        'NIP' => $request->NIP,
        'nama_lengkap' => $request->nama_lengkap,
        'bagian_pegawai' => 'Akademik',
        'jabatan_pegawai' => $request->jabatan_pegawai,
        'agama' => $request->agama,
        'status_pegawai' => $request->status_pegawai,
        'tanggal_masuk' => $request->tanggal_masuk,
        'alamat' => $request->alamat
      ]);
    } else {

      $guru->update([
        'NIP' => $request->NIP,
        'nama_lengkap' => $request->nama_lengkap,
        'bagian_pegawai' => 'Akademik',
        'jabatan_pegawai' => $request->jabatan_pegawai,
        'agama' => $request->agama,
        'status_pegawai' => $request->status_pegawai,
        'tanggal_masuk' => $request->tanggal_masuk,
        'alamat' => $request->alamat
      ]);
    }



    return view('admin.datapegawai.akademik.detailpegawaiakademik', [
      'guru' => $guru
    ]);
  }

  /**
   * Update Photo Pegawai Non Akademik
   * 
   */
  public function updatePhotoNonAkademik(Request $request, $id)
  {
    $pegawai = Pegawai::find($id);

    if ($request->hasFile('photo_pegawai')) {
      $photoPegawai = $request->file('photo_pegawai');
      $extension = $photoPegawai->getClientOriginalExtension();
      $filename = $pegawai->nama_pegawai . '_' . $pegawai->NIP . '.' . $extension;
      if (File::exists($photoPegawai)) {
        $photoPegawai->move('admin/assets/images/users/pegawai/', $filename);
        File::delete($photoPegawai);
      }


      $pegawai->photo = $filename;

      $pegawai->save();

      $pegawai->update([
        'NIP' => $request->NIP,
        'nama_pegawai' => $request->nama_pegawai,
        'bagian_pegawai' => $request->bagian_pegawai,
        'jabatan_pegawai' => $request->jabatan_pegawai,
        'agama' => $request->agama,
        'status_pegawai' => $request->status_pegawai,
        'tanggal_masuk' => $request->tanggal_masuk,
        'mulai_tugas' => $request->mulai_tugas,
        'akhir_tugas' => $request->akhir_tugas,
        'alamat' => $request->alamat
      ]);
    } else {

      $pegawai->update([
        'NIP' => $request->NIP,
        'nama_pegawai' => $request->nama_pegawai,
        'bagian_pegawai' => $request->bagian_pegawai,
        'jabatan_pegawai' => $request->jabatan_pegawai,
        'agama' => $request->agama,
        'status_pegawai' => $request->status_pegawai,
        'tanggal_masuk' => $request->tanggal_masuk,
        'mulai_tugas' => $request->mulai_tugas,
        'akhir_tugas' => $request->akhir_tugas,
        'alamat' => $request->alamat
      ]);
    }



    $fakultas = Fakultas::all();
    $jumlah = count($pegawai->mutasis);
    
        $fakulta = DB::table('fakultas')
                    ->select('nama_fakultas', DB::raw('id as id_fakultas'));
        $jurusans = DB::table('jurusans')
                    ->select('nama_jurusan', DB::raw('id as id_jurusan'));
        $prodis = DB::table('prodi')
                    ->select('nama_program_studi', DB::raw('id_prodi as id_prodi'));
    
                    
      $data_mutasi = DB::table('mutasis')->joinSub($fakulta, 'fakultas', function ($join) {
                      $join->on('mutasis.id_fakultas', '=', 'fakultas.id_fakultas');
                  })->joinSub($jurusans, 'jurusans', function ($join) {
                      $join->on('mutasis.id_jurusan', '=', 'jurusans.id_jurusan');
                  })->joinSub($prodis, 'prodi', function ($join) {
                      $join->on('mutasis.id_prodi', '=', 'prodi.id_prodi');
                  })->where('mutasiable_id','=', $id)->get();


    return view('admin.datapegawai.nonakademik.detailpegawainonakademik', [
      'pegawai' => $pegawai,
      'data_fakultas' => $fakultas,
      'jumlah' => $jumlah,
      'data_mutasi' => $data_mutasi
    ]);
  }
}
