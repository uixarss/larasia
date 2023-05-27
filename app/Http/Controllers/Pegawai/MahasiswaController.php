<?php

namespace App\Http\Controllers\Pegawai;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\KelasMahasiswa;
use App\Models\DataSekolah;
use App\User;
use App\Role;
use App\JenisTinggal;
use App\AlatTransportasi;
use App\JenisPendidikan;
use App\JenisPekerjaan;
use App\JenisPenghasilan;
use App\KebutuhanKhusus;
use App\ListKota;
use App\ListKecamatan;
use App\ListNegara;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use Gate;

class MahasiswaController extends Controller
{
  //
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
    // if (Gate::denies('manage-mahasiswa')) {
    //   abort(403, 'User does not have the right permissions.');
    // }
    $kelas = Kelas::all();
    $data_kelas_mahasiswa = KelasMahasiswa::all();
    $data_mahasiswa = Mahasiswa::all();

    return view('pegawai.datamahasiswa.index', [
      'data_mahasiswa' => $data_mahasiswa,
      'data_kelas' => $kelas,
      'data_kelas_mahasiswa' => $data_kelas_mahasiswa
    ])->with('mahasiswa');
  }



  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    // if (Gate::denies('create-mahasiswa')) {
    //   abort(403, 'User does not have the right permissions.');
    // }
    //insert Ke Tabel User
    $user = new User;
    $user->name = $request->nama_mahasiswa;
    $user->email = $request->email;
    $password = $request->nim . '@stikom2021';
    $user->password = bcrypt($password);

    $role = Role::select('id')->where('name', 'mahasiswa')->first();

    $user->save();

    $user->roles()->attach($role);

    $str_arr = explode(",", $request->nama_agama);
    $int = (int)$str_arr[0];
    $id_agama = $int;
    $nama_agama = $str_arr[1];


    //Insert Ke Tabel Siswa
    $mahasiswa = Mahasiswa::create([
      'nim' => $request->nim,
      'user_id' => $user->id,
      'kelas_id' => $request->kelas_id,
      'nama_mahasiswa' => $request->nama_mahasiswa,
      'jenis_kelamin' => $request->jenis_kelamin,
      'tempat_lahir' => $request->tempat_lahir,
      'tanggal_lahir' => $request->tanggal_lahir,
      'id_agama' => $id_agama,
      'nama_agama' => $nama_agama,
      'handphone' => $request->handphone,
      'email' => $request->email,
      'id_status_mahasiswa' => 1,
      'nama_status_mahasiswa' => 'Aktif'
    ]);

    return redirect()->route('pegawai.mahasiswa.index')->with('sukses', 'Data Berhasil Ditambahkan');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $id)
  {
    $kecamatan = ListKecamatan::where('regency_id', $id)->orderBy('name')->pluck('id', 'name');
    return json_encode($kecamatan);
  }

  public function prodi(Request $request, $id)
  {
    $prodi = Prodi::where('id_jurusan', $id)->orderBy('nama_program_studi')->pluck('id_prodi', 'nama_program_studi');
    return json_encode($prodi);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Siswa  $siswa
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Siswa  $siswa
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    if (Gate::denies('edit-mahasiswa')) {
      abort(403, 'User does not have the right permissions.');
    }
    $mahasiswa = Mahasiswa::find($id);
    $fakultas = Fakultas::all();

    $data_kelas = Kelas::all();
    $jenis_tinggal = JenisTinggal::all();
    $alat_transportasi = AlatTransportasi::all();
    $jenis_pendidikan = JenisPendidikan::all();
    $jenis_pekerjaan = JenisPekerjaan::all();
    $jenis_penghasilan = JenisPenghasilan::all();
    $kebutuhan_khusus = KebutuhanKhusus::all();
    $kelas_mahasiswa = KelasMahasiswa::where('user_id', $mahasiswa->user_id)->first();
    $data_kota = ListKota::orderBy('name')->get();
    $data_negara = ListNegara::orderBy('nama_negara')->get();

    $data_jurusan = Jurusan::all();
    $data_prodi = Prodi::all();
    $data_semester = Semester::all();
    $data_tahun_ajaran = TahunAjaran::all();

    return view('pegawai/datamahasiswa/edit', [
      'data_kelas' => $data_kelas, 'mahasiswa' => $mahasiswa, 'kelas_mahasiswa' => $kelas_mahasiswa,
      'data_jurusan' => $data_jurusan, 'data_prodi' => $data_prodi,
      'data_semester' => $data_semester, 'data_tahun_ajaran' => $data_tahun_ajaran,
      'jenis_tinggal' => $jenis_tinggal, 'alat_transportasi' => $alat_transportasi,
      'jenis_pendidikan' => $jenis_pendidikan, 'jenis_pekerjaan' => $jenis_pekerjaan,
      'jenis_penghasilan' => $jenis_penghasilan, 'kebutuhan_khusus' => $kebutuhan_khusus,
      'fakultas' => $fakultas,
      'data_kota' => $data_kota, 'data_negara' => $data_negara
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Siswa  $siswa
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
  }


  public function updateDataKampus(Request $request, $id)
  {

    $this->validate($request, [
      'email' => 'required',
      'nama_mahasiswa' => 'required'
    ]);

    $mahasiswa = Mahasiswa::find($id);

    $str_arr = explode(",", $request->status);
    $int = (int)$str_arr[0];
    $id_status = $int;
    $nama_status = $str_arr[1];

    $mahasiswa->update([
      'nim' => $request->nim,
      'nisn' => $request->nisn,
      'nama_mahasiswa' => $request->nama_mahasiswa,
      'handphone' => $request->handphone,
      'email' => $request->email,
      'id_status_mahasiswa' => $id_status,
      'nama_status_mahasiswa' => $nama_status
    ]);

    $kelas_mahasiswa = KelasMahasiswa::where('user_id', $mahasiswa->user_id)->first();
    if ($kelas_mahasiswa) {
      $kelas_mahasiswa->update([
        'id_kelas' => $request->kelas_id,
        'id_fakultas' => $request->id_fakultas,
        'id_jurusan' => $request->id_jurusan,
        'id_prodi' => $request->id_prodi,
        'id_semester' => $request->id_semester,
        'id_tahun_ajaran' => $request->id_tahun_ajaran
      ]);
    } else {
      KelasMahasiswa::create([
        'user_id' => $mahasiswa->user_id,
        'id_kelas' => $request->kelas_id,
        'id_fakultas' => $request->id_fakultas,
        'id_jurusan' => $request->id_jurusan,
        'id_prodi' => $request->id_prodi,
        'id_semester' => $request->id_semester,
        'id_tahun_ajaran' => $request->id_tahun_ajaran
      ]);
    }

    $user = User::where('id', $mahasiswa->user_id)->first();

    $user->update([
      'name' => $request->nama_mahasiswa,
      'email' => $request->email
    ]);

    return redirect()->route('pegawai.mahasiswa.edit', $mahasiswa->id)->with('sukses', 'Data Berhasil Diupdate');
  }



  public function updateDataDiri(Request $request, $id)
  {
    $mahasiswa = Mahasiswa::find($id);

    $this->validate($request, [
      'email' => 'required',
      'nama_mahasiswa' => 'required',
      'nama_agama' => 'required',
      'nama_kota' => 'required',
      'kecamatan' => 'required',
      'kewarganegaraan' => 'required'
    ]);

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

    $mahasiswa->update([
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
      'npwp' => $request->npwp
    ]);

    $user = User::where('id', $mahasiswa->user_id)->first();

    $user->update([
      'name' => $request->nama_mahasiswa,
      'email' => $request->email
    ]);


    return redirect()->route('pegawai.mahasiswa.edit', $mahasiswa->id)->with('sukses', 'Data Berhasil Diupdate');
  }


  public function updateDataOrangTua(Request $request, $id)
  {
    $mahasiswa = Mahasiswa::find($id);

    $pendidikan = explode(",", $request->pendidikan_ayah);
    $id_pendidikkan_ayah = (int)$pendidikan[0];
    $nama_pendidikan_ayah = $pendidikan[1];

    $pendidikan2 = explode(",", $request->pendidikan_ibu);
    $id_pendidikan_ibu = (int)$pendidikan2[0];
    $nama_pendidikan_ibu = $pendidikan2[1];

    $pendidikan3 = explode(",", $request->pendidikan_wali);
    $id_pendidikan_wali = (int)$pendidikan3[0];
    $nama_pendidikan_wali = $pendidikan3[1];

    $pekerjaan = explode(",", $request->pekerjaan_ayah);
    $id_pekerjaan_ayah = (int)$pekerjaan[0];
    $nama_pekerjaan_ayah = $pekerjaan[1];

    $pekerjaan2 = explode(",", $request->pekerjaan_ibu);
    $id_pekerjaan_ibu = (int)$pekerjaan2[0];
    $nama_pekerjaan_ibu = $pekerjaan2[1];

    $pekerjaan3 = explode(",", $request->pekerjaan_wali);
    $id_pekerjaan_wali = (int)$pekerjaan3[0];
    $nama_pekerjaan_wali = $pekerjaan3[1];

    $penghasilan = explode(",", $request->penghasilan_ayah);
    $id_penghasilan_ayah = (int)$penghasilan[0];
    $nama_penghasilan_ayah = $penghasilan[1];

    $penghasilan2 = explode(",", $request->penghasilan_ibu);
    $id_penghasilan_ibu = (int)$penghasilan2[0];
    $nama_penghasilan_ibu = $penghasilan2[1];

    $penghasilan3 = explode(",", $request->penghasilan_wali);
    $id_penghasilan_wali = (int)$penghasilan3[0];
    $nama_penghasilan_wali = $penghasilan3[1];

    $mahasiswa->update([

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

      //Wali
      'nama_wali' => $request->nama_wali,
      'tanggal_lahir_wali' => $request->tanggal_lahir_wali,
      'id_pendidikan_wali' => $id_pendidikan_wali,
      'nama_pendidikan_wali' => $nama_pendidikan_wali,
      'id_pekerjaan_wali' => $id_pekerjaan_wali,
      'nama_pekerjaan_wali' => $nama_pekerjaan_wali,
      'id_penghasilan_wali' => $id_penghasilan_wali,
      'nama_penghasilan_wali' => $nama_penghasilan_wali

    ]);


    return redirect()->route('pegawai.mahasiswa.edit', $mahasiswa->id)->with('sukses', 'Data Berhasil Diupdate');
  }


  public function updateDataLain(Request $request, $id)
  {
    $mahasiswa = Mahasiswa::find($id);


    $str_arr = explode(",", $request->jenis_tinggal);
    $int = (int)$str_arr[0];
    $id_jenis_tinggal = $int;
    $nama_jenis_tinggal = $str_arr[1];

    $str_arr2 = explode(",", $request->alat_transportasi);
    $int2 = (int)$str_arr2[0];
    $id_alat_transportasi = $int2;
    $nama_alat_transportasi = $str_arr2[1];

    $kebutuhan_mahasiswa = explode(",", $request->kebutuhan_mahasiswa);
    $id_kebutuhan_khusus_mahasiswa = (int)$kebutuhan_mahasiswa[0];
    $nama_kebutuhan_khusus_mahasiswa = $kebutuhan_mahasiswa[1];

    $kebutuhan_ayah = explode(",", $request->kebutuhan_ayah);
    $id_kebutuhan_khusus_ayah = (int)$kebutuhan_ayah[0];
    $nama_kebutuhan_khusus_ayah = $kebutuhan_ayah[1];

    $kebutuhan_ibu = explode(",", $request->kebutuhan_ibu);
    $id_kebutuhan_khusus_ibu = (int)$kebutuhan_ibu[0];
    $nama_kebutuhan_khusus_ibu = $kebutuhan_ibu[1];

    if ($request->penerima_kps == 1) {
      $no_kps = $request->nomor_kps;
    } else {
      $no_kps = null;
    }

    $mahasiswa->update([
      'id_jenis_tinggal' => $id_jenis_tinggal,
      'nama_jenis_tinggal' => $nama_jenis_tinggal,
      'id_alat_transportasi' => $id_alat_transportasi,
      'nama_alat_transportasi' => $nama_alat_transportasi,

      'penerima_kps' => $request->penerima_kps,
      'nomor_kps' => $no_kps,

      'id_kebutuhan_khusus_mahasiswa' => $id_kebutuhan_khusus_mahasiswa,
      'nama_kebutuhan_khusus_mahasiswa' => $nama_kebutuhan_khusus_mahasiswa,

      'id_kebutuhan_khusus_ayah' => $id_kebutuhan_khusus_ayah,
      'nama_kebutuhan_khusus_ayah' => $nama_kebutuhan_khusus_ayah,

      'id_kebutuhan_khusus_ibu' => $id_kebutuhan_khusus_ibu,
      'nama_kebutuhan_khusus_ibu' => $nama_kebutuhan_khusus_ibu,

    ]);


    return redirect()->route('pegawai.mahasiswa.edit', $mahasiswa->id)->with('sukses', 'Data Berhasil Diupdate');
  }




  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Siswa  $siswa
   * @return \Illuminate\Http\Response
   */
  public function delete($id)
  {
    if (Gate::denies('delete-mahasiswa')) {
      abort(403, 'User does not have the right permissions.');
    }
    $mahasiswa = Mahasiswa::find($id);

    $user = User::where('id', $mahasiswa->user_id)->first();
    $user->roles()->detach();

    $kelas_mahasiswa = KelasMahasiswa::where('user_id', $mahasiswa->user_id)->first();

    $kelas_mahasiswa->delete($kelas_mahasiswa);
    $mahasiswa->delete($mahasiswa);
    $user->delete($user);

    return redirect()->route('pegawai.mahasiswa.index')->with('sukses', 'Data Berhasil Dihapus');
  }

  public function mahasiswaExport(Request $request)
  {

    return Excel::download(new MahasiswaExport($request->id), $request->nama_kelas . ' - Mahasiswa.xlsx');
  }

  public function mahasiswaImport(Request $request)
  {
    if (Gate::denies('create-mahasiswa')) {
      abort(403, 'User does not have the right permissions.');
    }
    // validasi
    $this->validate($request, [
      'file' => 'required|mimes:csv,xls,xlsx'
    ]);

    // menangkap file excel
    $file = $request->file('file');


    // import data
    Excel::import(new MahasiswaImport, $file);

    // alihkan halaman kembali
    return redirect()->route('pegawai.mahasiswa.index')->with('sukses', 'Data Berhasil Dihapus');
  }
}
