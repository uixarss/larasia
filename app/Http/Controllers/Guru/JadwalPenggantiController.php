<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPengganti;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Pengampu;
use App\Models\Ruangan;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Models\Waktu;
use Illuminate\Support\Facades\Auth;
use App\Models\Dosen;
use App\Models\Hari;


class JadwalPenggantiController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal_pengganti' => 'required',
            'kelas_id' => 'required',
            'ruangan_id' => 'required',
            'mapel_id' => 'required',
            'hari_id' => 'required',
            'waktu_id' => 'required',
            'keterangan' => 'required',
            'pertemuan_ke' => 'required',
        ]);
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $pengampu = Pengampu::where('id_dosen', $dosen->id)
            ->where('id_tahun_ajaran', $tahun_ajaran->id)->where('id_semester', $semester->id)
            ->first();

        JadwalPengganti::create([
            'tahun_ajaran_id' => $tahun_ajaran->id,
            'semester_id' => $semester->id,
            'mapel_id' => $request->mapel_id,
            'kelas_id' => $request->kelas_id,
            'tanggal_pengganti' => $request->tanggal_pengganti,
            'ruangan_id' => $request->ruangan_id,
            'hari_id' => $request->hari_id,
            'waktu_id' => $request->waktu_id,
            'id_dosen' => $dosen->id,
            'prodi_id' => $pengampu->id_prodi,
            'keterangan' => $request->keterangan,
            'pertemuan_ke' => $request->pertemuan_ke

        ]);
        return redirect()->back()->with([
            'success' => 'Pengajuan berhasil dikirim!'
        ]);
    }
}
