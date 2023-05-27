<?php

namespace App\Http\Controllers\Admin;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\SiswaDetail;
use App\Models\DataSekolah;
use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiswaController extends Controller
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
        $kelas = Kelas::all();

        // if($request->has('cari')){
        //   $data_siswa = Siswa::where('nama_depan','LIKE','%'.$request->cari.'%')->get();
        // }else {
        //   $data_siswa = Siswa::all();
        // }
        $data_siswa = Siswa::all();

        return view('admin.datasiswa.index' , [
          'data_siswa' => $data_siswa,
          'data_kelas' => $kelas
          ]);
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
        $user->name = $request->nama_depan;
        $user->email = $request->email_siswa;
        $user->password = bcrypt('namasaya');

        $role = Role::select('id')->where('name', 'siswa')->first();

        $user->save();

        $user->roles()->attach($role);



        //Insert Ke Tabel Siswa
        $siswa = Siswa::create([
            'NIS' => $request->NIS,
            'user_id' => $user->id,
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'kelas_id' => $request->kelas_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat_sekarang' => $request->alamat,
            'email_siswa' => $request->email_siswa
        ]);

        // dd($siswa);


        return redirect()->route('admin.siswa.index')->with('sukses','Data Berhasil Ditambahkan');


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
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $siswa = Siswa::find($id);
      $kelas = Kelas::all();
      $data_sekolah = DataSekolah::all()->first();

      $siswaDetail = SiswaDetail::where('siswa_id',$siswa->id)->first();

      return view('admin/datasiswa/show')->with(['siswa' => $siswa, 'kelas' => $kelas,'siswadetail' => $siswaDetail,'data_sekolah' => $data_sekolah]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::find($id);

        $data_kelas = Kelas::all();

        return view('admin/datasiswa/edit', ['data_kelas' => $data_kelas, 'siswa' => $siswa]);
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
        $siswa = Siswa::find($id);

        $siswa->update([
          'NISN' => $request->NISN,
          'NIS' => $request->NIS,
          'nama_depan' => $request->nama_depan,
          'nama_belakang' => $request->nama_belakang,
          'user_id' => $siswa->user_id,
          'kelas_id' => $request->kelas_id,
          'tempat_lahir' => $request->tempat_lahir,
          'tanggal_lahir' => $request->tanggal_lahir,
          'jenis_kelamin' => $request->jenis_kelamin,
          'golongan_darah' => $request->golongan_darah,
          'agama' => $request->agama,
          'kebangsaan' => $request->kebangsaan,
          'email_siswa' => $request->email_siswa,
          'no_phone' => $request->no_phone,
          'alamat_sekarang' => $request->alamat
        ]);

        $user = User::where('id', $siswa->user_id )->first();

        $user->update([
          'name' => $request->nama_depan,
          'email' => $request->email_siswa
        ]);



        return redirect()->route('admin.siswa.index')->with('sukses','Data Berhasil Diupdate');
    }


    public function updateDataSekolah(Request $request, $id)
    {
      $siswa = Siswa::find($id);

      $siswa->update([
        'NISN' => $request->NISN,
        'NIS' => $request->NIS,
        'nama_depan' => $request->nama_depan,
        'nama_belakang' => $request->nama_belakang,
        'tahun_masuk' => $request->tahun_masuk,
        'kelas_id' => $request->kelas_id,
        'status' => $request->status
      ]);

      return redirect()->route('admin.siswa.show', $siswa->id)->with('sukses','Data Berhasil Diupdate');
    }



    public function updateDataDiri(Request $request, $id)
    {
        $siswa = Siswa::find($id);

        $siswa->update([
          'nama_depan' => $request->nama_depan,
          'nama_belakang' => $request->nama_belakang,
          'tempat_lahir' => $request->tempat_lahir,
          'tanggal_lahir' => $request->tanggal_lahir,
          'jenis_kelamin' => $request->jenis_kelamin,
          'agama' => $request->agama,
          'kebangsaan' => $request->kebangsaan,
          'email_siswa' => $request->email_siswa,
          'no_phone' => $request->no_phone,
          'alamat_sekarang' => $request->alamat
        ]);

        $user = User::where('id', $siswa->user_id )->first();

        $user->update([
          'name' => $request->nama_depan,
          'email' => $request->email_siswa
        ]);

        $siswaDetail = SiswaDetail::where('siswa_id',$siswa->id)->first();

        if ($siswaDetail != null) {
          $siswaDetail->update([
            'anak_ke' => $request->anak_ke,
            'jumlah_saudara' => $request->jumlah_saudara,
            'kondisi_siswa' => $request->kondisi_siswa
          ]);
        }else{
          SiswaDetail::create([
            'siswa_id' => $siswa->id,
            'anak_ke' => $request->anak_ke,
            'jumlah_saudara' => $request->jumlah_saudara,
            'kondisi_siswa' => $request->kondisi_siswa
          ]);
        }

      return redirect()->route('admin.siswa.show', $siswa->id)->with('sukses','Data Berhasil Diupdate');
    }



    public function updateDataPendidikan(Request $request, $id)
    {
        $siswa = Siswa::find($id);

        $siswaDetail = SiswaDetail::where('siswa_id',$siswa->id)->first();

        if ($siswaDetail != null) {
          $siswaDetail->update([
            'asal_sd' => $request->asal_sd,
            'asal_smp' => $request->asal_smp
          ]);
        }else{
          SiswaDetail::create([
            'siswa_id' => $siswa->id,
            'asal_sd' => $request->asal_sd,
            'asal_smp' => $request->asal_smp
          ]);
        }

        return redirect()->route('admin.siswa.show', $siswa->id)->with('sukses','Data Berhasil Diupdate');
    }




    public function updateDataOrangTua(Request $request, $id)
    {
        $siswa = Siswa::find($id);

        $siswaDetail = SiswaDetail::where('siswa_id',$siswa->id)->first();

        if ($siswaDetail != null) {
          $siswaDetail->update([
            'nama_ayah' => $request->nama_ayah,
            'pendidikan_ayah' => $request->pendidikan_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'penghasilan_ayah' => $request->penghasilan_ayah,
            'alamat_lengkap_ayah' => $request->alamat_lengkap_ayah,
            'no_hp_ayah' => $request->no_hp_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pendidikan_ibu' => $request->pendidikan_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'penghasilan_ibu' => $request->penghasilan_ibu,
            'alamat_lengkap_ibu' => $request->alamat_lengkap_ibu,
            'no_hp_ibu' => $request->no_hp_ibu
          ]);
        }else{
          SiswaDetail::create([
            'siswa_id' => $siswa->id,
            'nama_ayah' => $request->nama_ayah,
            'pendidikan_ayah' => $request->pendidikan_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'penghasilan_ayah' => $request->penghasilan_ayah,
            'alamat_lengkap_ayah' => $request->alamat_lengkap_ayah,
            'no_hp_ayah' => $request->no_hp_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pendidikan_ibu' => $request->pendidikan_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'penghasilan_ibu' => $request->penghasilan_ibu,
            'alamat_lengkap_ibu' => $request->alamat_lengkap_ibu,
            'no_hp_ibu' => $request->no_hp_ibu
          ]);
        }

        return redirect()->route('admin.siswa.show', $siswa->id)->with('sukses','Data Berhasil Diupdate');
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        $siswa = Siswa::find($id);

        $user = User::where('id', $siswa->user_id )->first();
        $user->roles()->detach();

        $siswa->delete($siswa);
        $user->delete($user);

        return redirect()->route('admin.siswa.index')->with('sukses','Data Berhasil Dihapus');
    }
}
