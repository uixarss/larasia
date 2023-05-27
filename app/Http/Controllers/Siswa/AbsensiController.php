<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\AbsensiMahasiswa;
use App\Models\AbsensiMahasiswaSP;
use App\Models\AbsensiDosen;
use App\Models\AbsensiDosenSP;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use App\Models\Waktu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function absensiMahasiswaMasuk(Request $request)
    {
        // $this->validate($request, [
        //     'id_tahun_ajaran' => 'required',
        //     'id_semester' => 'required',
        //     'id_prodi' => 'required',
        //     'mapel_id' => 'required',
        //     'kelas_id' => 'required',
        //     'hari_id' => 'required',
        //     'id_dosen' => 'required'
        // ]);
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        $waktu = Waktu::find($request->waktu_id);
        $str_time = strtotime($time);
        $str_jam_masuk = strtotime($waktu->jam_masuk);
        $selisih_waktu = $str_time - $str_jam_masuk;
        $jam    = floor($selisih_waktu / (60 * 60));
        $menit    = $selisih_waktu - ($jam * (60 * 60));
        $data_terlambat = 15 * 60;

        if ($mahasiswa == null) {
            return abort(403, 'Permission Denied');
        }
        $new_arr[] = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));
        // $absensi_mahasiswa = AbsensiMahasiswa::where('id_tahun_ajaran', $request->id_tahun_ajaran)->where('id_semester', $request->id_semester)
        //     ->where('id_mahasiswa', $mahasiswa->id)->where('mapel_id', $request->mapel_id)
        //     ->where('id_dosen', $request->id_dosen)->where('hari_id', $request->hari_id)
        //     ->where('tanggal_masuk', $date)->where('waktu_id', $request->waktu_id)->first();
        $absensi_mahasiswa = AbsensiMahasiswa::find($request->id);
        if ($absensi_mahasiswa == null) {
            return redirect()->back()->with([
                'error' => 'Dosen belum melakukan absensi'
            ]);
        }

        $jam_masuk_dosen = AbsensiDosen::select('jam_masuk')->where('id_tahun_ajaran', $request->id_tahun_ajaran)->where('id_semester', $request->id_semester)->where('mapel_id', $request->mapel_id)
            ->where('id_dosen', $request->id_dosen)->where('hari_id', $request->hari_id)
            ->where('tanggal_masuk', $date)->where('waktu_id', $request->waktu_id)->first();
        $jam_masuk_dosen = $jam_masuk_dosen->jam_masuk;
        $str_jam_masuk_dosen = strtotime($jam_masuk_dosen);
        $selisih_waktu_masuk = $str_time - $str_jam_masuk_dosen;
        $jam_masuk    = floor($selisih_waktu_masuk / 60);

        $menit_masuk    = $selisih_waktu_masuk - $jam_masuk * (60 * 60);
        // var_dump($selisih_waktu_masuk);
        // var_dump($jam_masuk);
        // dd($jam_masuk_dosen);
        if ($jam_masuk > 15) {
            return redirect()->back()->with([
                'error' => 'Anda Terlambat! Hubungi Dosen untuk melakukan absensi'
            ]);
        }
        $absensi_mahasiswa->update([
            'tanggal_masuk' => $date,
            'jam_masuk' => $time,
            'status' => 'Hadir',
            'long' => $new_arr[0]['geoplugin_longitude'],
            'lat' => $new_arr[0]['geoplugin_latitude'],
            'ip_address' => $this->getIp(),
            'user_agent' => $request->server('HTTP_USER_AGENT'),
        ]);
        return redirect()->back()->with([
            'success' => 'Berhasil absen masuk'
        ]);;


        // }
    }
    public function absensiMahasiswaKeluar(Request $request)
    {
        // $this->validate($request, [
        //     'id_tahun_ajaran' => 'required',
        //     'id_semester' => 'required',
        //     'id_prodi' => 'required',
        //     'mapel_id' => 'required',
        //     'kelas_id' => 'required',
        //     'hari_id' => 'required',
        // ]);
        try {
            $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
            $date = date("Y-m-d");
            $time = date("H:i:s");

            $absensi_mahasiswa = AbsensiMahasiswa::where('id_tahun_ajaran', $request->id_tahun_ajaran)->where('id_semester', $request->id_semester)
                ->where('id_mahasiswa', $mahasiswa->id)->where('mapel_id', $request->mapel_id)
                ->where('id_dosen', $request->id_dosen)->where('hari_id', $request->hari_id)
                ->where('tanggal_masuk', $date)->where('waktu_id', $request->waktu_id)->first();
            if ($absensi_mahasiswa == null) {
                return redirect()->back()->with([
                    'error' => 'Dosen belum melakukan absensi'
                ]);
            }
            $absensi_mahasiswa->update([
                'jam_keluar' => $time,
            ]);
            return redirect()->back()->with([
                'success' => 'Berhasil absen keluar'
            ]);
        } catch (\Exception $th) {
            return redirect()->back()->with([
                'error' => $th->getMessage()
            ]);
        }
    }

    //Pengganti

    public function absensiMahasiswaPenggantiMasuk(Request $request)
    {
        // $this->validate($request, [
        //     'id_tahun_ajaran' => 'required',
        //     'id_semester' => 'required',
        //     'id_prodi' => 'required',
        //     'mapel_id' => 'required',
        //     'kelas_id' => 'required',
        //     'hari_id' => 'required',
        //     'id_dosen' => 'required'
        // ]);
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        $waktu = Waktu::find($request->waktu_id);
        $str_time = strtotime($time);
        $str_jam_masuk = strtotime($waktu->jam_masuk);
        $selisih_waktu = $str_time - $str_jam_masuk;
        $jam    = floor($selisih_waktu / (60 * 60));
        $menit    = $selisih_waktu - $jam * (60 * 60);

        $data_terlambat = 15 * 60;
        if ($mahasiswa == null) {
            return abort(403, 'Permission Denied');
        }
        $new_arr[] = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));
        $absensi_mahasiswa = AbsensiMahasiswa::where('id_tahun_ajaran', $request->id_tahun_ajaran)->where('id_semester', $request->id_semester)
            ->where('id_mahasiswa', $mahasiswa->id)->where('mapel_id', $request->mapel_id)
            ->where('id_dosen', $request->id_dosen)->where('hari_id', $request->hari_id)
            ->where('tanggal_masuk', $date)->where('waktu_id', $request->waktu_id)->first();
        if ($absensi_mahasiswa == null) {
            return redirect()->back()->with([
                'error' => 'Dosen belum melakukan absensi'
            ]);
        }
        $absensi_mahasiswa->update([
            'tanggal_masuk' => $date,
            'jam_masuk' => $time,
            'status' => 'Hadir',
            'long' => $new_arr[0]['geoplugin_longitude'],
            'lat' => $new_arr[0]['geoplugin_latitude'],
            'ip_address' => $this->getIp(),
            'user_agent' => $request->server('HTTP_USER_AGENT'),
        ]);
        return redirect()->back()->with([
            'success' => 'Berhasil absen masuk'
        ]);;


        // }
    }
    public function absensiMahasiswaPenggantiKeluar(Request $request)
    {
        // $this->validate($request, [
        //     'id_tahun_ajaran' => 'required',
        //     'id_semester' => 'required',
        //     'id_prodi' => 'required',
        //     'mapel_id' => 'required',
        //     'kelas_id' => 'required',
        //     'hari_id' => 'required',
        // ]);
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        $date = date("Y-m-d");
        $time = date("H:i:s");

        $absensi_mahasiswa = AbsensiMahasiswa::where('id_tahun_ajaran', $request->id_tahun_ajaran)->where('id_semester', $request->id_semester)
            ->where('id_mahasiswa', $mahasiswa->id)->where('mapel_id', $request->mapel_id)
            ->where('id_dosen', $request->id_dosen)->where('hari_id', $request->hari_id)
            ->where('tanggal_masuk', $date)->where('waktu_id', $request->waktu_id)->first();
        if ($absensi_mahasiswa == null) {
            return redirect()->back()->with([
                'error' => 'Dosen belum melakukan absensi'
            ]);
        }
        $absensi_mahasiswa->update([
            'jam_keluar' => $time,
        ]);
        return redirect()->back()->with([
            'success' => 'Berhasil absen keluar'
        ]);
    }
    public function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }


    public function absensiSPMahasiswaMasuk(Request $request)
    {
        // $this->validate($request, [
        //     'id_tahun_ajaran' => 'required',
        //     'id_semester' => 'required',
        //     'id_prodi' => 'required',
        //     'mapel_id' => 'required',
        //     'kelas_id' => 'required',
        //     'hari_id' => 'required',
        //     'id_dosen' => 'required'
        // ]);
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        $waktu = Waktu::find($request->waktu_id);
        $str_time = strtotime($time);
        $str_jam_masuk = strtotime($waktu->jam_masuk);
        $selisih_waktu = $str_time - $str_jam_masuk;
        $jam    = floor($selisih_waktu / (60 * 60));
        $menit    = $selisih_waktu - ($jam * (60 * 60));
        $data_terlambat = 15 * 60;

        if ($mahasiswa == null) {
            return abort(403, 'Permission Denied');
        }
        $new_arr[] = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR']));
        $absensi_mahasiswa = AbsensiMahasiswaSP::where('id_tahun_ajaran', $request->id_tahun_ajaran)->where('id_semester', $request->id_semester)
            ->where('id_mahasiswa', $mahasiswa->id)->where('mapel_id', $request->mapel_id)
            ->where('id_dosen', $request->id_dosen)->where('hari_id', $request->hari_id)
            ->where('tanggal_masuk', $date)->where('waktu_id', $request->waktu_id)->first();
        if ($absensi_mahasiswa == null) {
            return redirect()->back()->with([
                'error2' => 'Dosen belum melakukan absensi'
            ]);
        }

        $jam_masuk_dosen = AbsensiDosenSP::select('jam_masuk')->where('id_tahun_ajaran', $request->id_tahun_ajaran)->where('id_semester', $request->id_semester)->where('mapel_id', $request->mapel_id)
            ->where('id_dosen', $request->id_dosen)->where('hari_id', $request->hari_id)
            ->where('tanggal_masuk', $date)->where('waktu_id', $request->waktu_id)->first();
        $jam_masuk_dosen = $jam_masuk_dosen->jam_masuk;
        $str_jam_masuk_dosen = strtotime($jam_masuk_dosen);
        $selisih_waktu_masuk = $str_time - $str_jam_masuk_dosen;
        $jam_masuk    = floor($selisih_waktu_masuk / 60);

        $menit_masuk    = $selisih_waktu_masuk - $jam_masuk * (60 * 60);
        // var_dump($selisih_waktu_masuk);
        // var_dump($jam_masuk);
        // dd($jam_masuk_dosen);
        if ($jam_masuk > 15) {
            return redirect()->back()->with([
                'error2' => 'Anda Terlambat! Hubungi Dosen untuk melakukan absensi'
            ]);
        }
        $absensi_mahasiswa->update([
            'tanggal_masuk' => $date,
            'jam_masuk' => $time,
            'status' => 'Hadir',
            'long' => $new_arr[0]['geoplugin_longitude'],
            'lat' => $new_arr[0]['geoplugin_latitude'],
            'ip_address' => $this->getIp(),
            'user_agent' => $request->server('HTTP_USER_AGENT'),
        ]);
        return redirect()->back()->with([
            'success2' => 'Berhasil absen masuk'
        ]);;


        // }
    }
    public function absensiSPMahasiswaKeluar(Request $request)
    {
        // $this->validate($request, [
        //     'id_tahun_ajaran' => 'required',
        //     'id_semester' => 'required',
        //     'id_prodi' => 'required',
        //     'mapel_id' => 'required',
        //     'kelas_id' => 'required',
        //     'hari_id' => 'required',
        // ]);
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        $date = date("Y-m-d");
        $time = date("H:i:s");

        $absensi_mahasiswa = AbsensiMahasiswaSP::where('id_tahun_ajaran', $request->id_tahun_ajaran)->where('id_semester', $request->id_semester)
            ->where('id_mahasiswa', $mahasiswa->id)->where('mapel_id', $request->mapel_id)
            ->where('id_dosen', $request->id_dosen)->where('hari_id', $request->hari_id)
            ->where('tanggal_masuk', $date)->where('waktu_id', $request->waktu_id)->first();
        if ($absensi_mahasiswa == null) {
            return redirect()->back()->with([
                'error2' => 'Dosen belum melakukan absensi'
            ]);
        }
        $absensi_mahasiswa->update([
            'jam_keluar' => $time,
        ]);
        return redirect()->back()->with([
            'success2' => 'Berhasil absen keluar'
        ]);
    }
}
