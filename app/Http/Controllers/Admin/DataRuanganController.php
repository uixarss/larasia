<?php

namespace App\Http\Controllers\Admin;

use App\DataRuangan;
use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Ruangan;
use App\Models\RuangEkstra;
use App\Models\RuangLab;
use App\Models\RuangPegawai;
use App\Models\RuangUmum;
use App\Models\TahunAjaran;
use App\Models\TahunAjaranGuruKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataRuanganController extends Controller
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
        $data_ruang_kelas = Kelas::all();
        $data_ruangan = Ruangan::all();
        $data_ruang_pegawai = RuangPegawai::all();
        $data_ruang_lab = RuangLab::all();
        $data_ruang_ekstra = RuangEkstra::all();
        $data_ruang_umum = RuangUmum::all();
        return view('admin.dataruangan.index', [
            'data_ruang_kelas' => $data_ruang_kelas,
            'data_ruang_pegawai' => $data_ruang_pegawai,
            'data_ruang_lab' => $data_ruang_lab,
            'data_ruang_ekstra' => $data_ruang_ekstra,
            'data_ruang_umum' => $data_ruang_umum,
            'data_ruangan' => $data_ruangan
        ]);
    }


    /**
     * Store Ruangan
     * 
     */
    public function ruanganStore(Request $request)
    {
        $this->validate($request, [
            'kode_ruangan' => 'required|unique:ruangans',
            'nama_ruangan' => 'required',
            'kondisi_ruangan' => 'required'
        ]);

        Ruangan::create([
            'kode_ruangan' => $request->kode_ruangan,
            'nama_ruangan' => $request->nama_ruangan,
            'kondisi_ruangan' => $request->kondisi_ruangan
        ]);

        return redirect()->back();
    }
    /**
     * Store Ruang Kelas
     * 
     */
    public function kelasStore(Request $request)
    {
        //
        $this->validate($request, [
            'kode_kelas' => 'required|unique:kelas',
            'nama_kelas' => 'required',
            'kapasitas' => 'required',
            'jurusan' => 'required',
            'tingkat' => 'required',
            'kondisi' => 'required',
            'guru_id' => 'required',
        ]);

        $kelas = Kelas::create([
            'kode_kelas' => $request->kode_kelas,
            'nama_kelas' => $request->nama_kelas,
            'kapasitas' => $request->kapasitas,
            'jurusan' => $request->jurusan,
            'tingkat' => $request->tingkat,
            'kondisi' => $request->kondisi
        ]);
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        TahunAjaranGuruKelas::create([
            'tahun_ajaran_id' => $tahun_ajaran->id,
            'kelas_id' => $kelas->id,
            'guru_id' => $request->guru_id
        ]);

        return redirect()->route('admin.dataruangan.index');
    }

    /**
     * Update Ruangan
     * 
     */
    public function ruanganUpdate(Request $request, $id)
    {
        $ruangan = Ruangan::find($id);
        $ruangan->update([
            'kode_ruangan' => $request->kode_ruangan,
            'nama_ruangan' => $request->nama_ruangan,
            'kondisi_ruangan' => $request->kondisi_ruangan
        ]);
        return redirect()->route('admin.dataruangan.index');
    }

    /**
     * Update Ruang Kelas
     * 
     */
    public function kelasUpdate(Request $request, $id)
    {

        $kelas = Kelas::find($id);

        $kelas->update([
            'kode_kelas' => $request->kode_kelas,
            'nama_kelas' => $request->nama_kelas,
            'kapasitas' => $request->kapasitas,
            'jurusan' => $request->jurusan,
            'tingkat' => $request->tingkat,
            'kondisi' => $request->kondisi
        ]);
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();

        $wali_kelas = TahunAjaranGuruKelas::where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('kelas_id', $id)->first();

        if ($wali_kelas != null) {
            $wali_kelas->update(['guru_id' => $request->guru_id]);
        } else {
            TahunAjaranGuruKelas::create([
                'tahun_ajaran_id' => $tahun_ajaran->id,
                'kelas_id' => $id,
                'guru_id' => $request->guru_id
            ]);
        }

        return redirect()->route('admin.dataruangan.index');
    }

    /**
     * Destroy Ruangan
     * 
     */
    public function ruanganDestroy($id)
    {
        $ruangan = Ruangan::find($id);
        $ruangan->delete($ruangan);

        return redirect()->route('admin.dataruangan.index');
    }

    /**
     * Destroy Ruang Kelas
     * 
     */

    public function kelasDestroy($id)
    {
        $kelas = Kelas::find($id);
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();

        $wali_kelas = TahunAjaranGuruKelas::where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('kelas_id', $id)->first();

        if ($wali_kelas) {
            $wali_kelas->delete($wali_kelas);
        }
        $kelas->delete($kelas);

        return redirect()->route('admin.dataruangan.index');
    }
    /**
     * Store Ruang Pegawai
     *
     */
    public function pegawaiStore(Request $request)
    {
        //
        $this->validate($request, [
            'kode' => 'required|unique:ruang_pegawais',
            'nama' => 'required',
            'bagian' => 'required',
            'kondisi' => 'required'
        ]);

        RuangPegawai::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'bagian' => $request->bagian,
            'kondisi' => $request->kondisi
        ]);

        return redirect()->route('admin.dataruangan.index');
    }

    /**
     * Update Ruang Pegawai
     */
    public function pegawaiUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required',
            'bagian' => 'required',
            'kondisi' => 'required'
        ]);

        $ruang_pegawai = RuangPegawai::find($id);

        $ruang_pegawai->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'bagian' => $request->bagian,
            'kondisi' => $request->kondisi
        ]);

        return redirect()->route('admin.dataruangan.index');
    }

    /**
     * Destroy Ruang Pegawai
     */
    public function pegawaiDestroy($id)
    {
        $ruang_pegawai = RuangPegawai::find($id);
        $ruang_pegawai->delete($ruang_pegawai);

        return redirect()->route('admin.dataruangan.index');
    }


    /**
     * Store Ruang Lab
     *
     */
    public function labStore(Request $request)
    {
        //
        $this->validate($request, [
            'kode' => 'required|unique:ruang_labs',
            'nama' => 'required',
            'kondisi' => 'required'
        ]);

        RuangLab::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kondisi' => $request->kondisi
        ]);

        return redirect()->route('admin.dataruangan.index');
    }

    /**
     * Update Ruang lab
     */
    public function labUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required',
            'kondisi' => 'required'
        ]);

        $ruang_lab = Ruanglab::find($id);

        $ruang_lab->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kondisi' => $request->kondisi
        ]);

        return redirect()->route('admin.dataruangan.index');
    }

    /**
     * Destroy Ruang lab
     */
    public function labDestroy($id)
    {
        $ruang_lab = RuangLab::find($id);
        $ruang_lab->delete($ruang_lab);

        return redirect()->route('admin.dataruangan.index');
    }

    /**
     * Store Ruang ekstra
     *
     */
    public function ekstraStore(Request $request)
    {
        //
        $this->validate($request, [
            'kode' => 'required|unique:ruang_ekstras',
            'nama' => 'required',
            'kondisi' => 'required'
        ]);

        RuangEkstra::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kondisi' => $request->kondisi
        ]);

        return redirect()->route('admin.dataruangan.index');
    }

    /**
     * Update Ruang ekstra
     */
    public function ekstraUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required',
            'kondisi' => 'required'
        ]);

        $ruang_ekstra = RuangEkstra::find($id);

        $ruang_ekstra->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kondisi' => $request->kondisi
        ]);

        return redirect()->route('admin.dataruangan.index');
    }

    /**
     * Destroy Ruang ekstra
     */
    public function ekstraDestroy($id)
    {
        $ruang_ekstra = RuangEkstra::find($id);
        $ruang_ekstra->delete($ruang_ekstra);

        return redirect()->route('admin.dataruangan.index');
    }

    /**
     * Store Ruang umum
     *
     */
    public function umumStore(Request $request)
    {
        //
        $this->validate($request, [
            'kode' => 'required|unique:ruang_umums',
            'nama' => 'required',
            'kondisi' => 'required'
        ]);

        RuangUmum::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kondisi' => $request->kondisi
        ]);

        return redirect()->route('admin.dataruangan.index');
    }

    /**
     * Update Ruang umum
     */
    public function umumUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required',
            'kondisi' => 'required'
        ]);

        $ruang_umum = RuangUmum::find($id);

        $ruang_umum->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kondisi' => $request->kondisi
        ]);

        return redirect()->route('admin.dataruangan.index');
    }

    /**
     * Destroy Ruang umum
     */
    public function umumDestroy($id)
    {
        $ruang_umum = RuangUmum::find($id);
        $ruang_umum->delete($ruang_umum);

        return redirect()->route('admin.dataruangan.index');
    }
}
