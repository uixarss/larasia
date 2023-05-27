<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Hari;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Models\JadwalPengganti;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Pengampu;
use App\Models\Prodi;
use App\Models\Ruangan;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Models\Waktu;
use Illuminate\Support\Facades\Auth;

class JadwalPenggantiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        $data_jadwal_pengganti = JadwalPengganti::where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)->get();
        $data_mapel = MataPelajaran::all();
        $data_dosen = Dosen::all();
        $data_hari = Hari::all();
        $data_waktu = Waktu::all();
        $data_tahun_ajaran = TahunAjaran::all();
        $data_semester = Semester::all();
        $data_kelas = Kelas::all();
        $data_ruangan = Ruangan::all();
        $data_prodi = Prodi::all();
        return view('admin.jadwalpengganti.index', compact([
            'data_tahun_ajaran', 'data_semester', 'data_dosen',
            'data_mapel', 'data_hari', 'data_waktu', 'data_kelas',
            'data_ruangan', 'data_jadwal_pengganti','data_prodi'
        ]));
    }

    
    public function update(Request $request, $id)
    {
        $jadwal_pengganti = JadwalPengganti::find($id);

        $jadwal_pengganti->update([
            'status' => $request->status,
            'disetujui_oleh' => Auth::user()->name,
        ]);

        return redirect()->back()->with([
            'success' => 'Jadwal pengganti berhasil diubah'
        ]);
    }

    public function mapel(Request $request, $id_dosen)
    {
        $data_pengampu = Pengampu::where('id_dosen', $id_dosen)->get();

        return response()->json($data_pengampu);
    }
}
