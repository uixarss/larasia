<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\DosenInputNilaiKHSRequest;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\KartuHasilStudi;
use App\Models\KartuHasilStudiDetail;
use App\Models\Mahasiswa;
use App\Models\MataPelajaran;
use App\Models\Pengampu;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KHSController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Pilih Mata Kuliah
     * 
     */
    public function pilihMatkul()
    {
        $tahun = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        $dosen = Dosen::where('user_id', Auth::id())->first();

        $pengampu = Pengampu::where('id_tahun_ajaran', $tahun->id)
            ->where('id_semester', $semester->id)->where('id_dosen', $dosen->id)
            ->get();
        return view('guru.khs.matkul', compact(['pengampu']));
    }
    /**
     * Pilih Kelas 
     */
    public function pilihKelas($kode_mapel)
    {
        $tahun = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $mapel = MataPelajaran::where('kode_mapel', $kode_mapel)->first();
        $data_jadwal = Jadwal::where('tahun_ajaran_id', $tahun->id)
            ->where('semester_id', $semester->id)->where('id_dosen', $dosen->id)
            ->where('mapel_id', $mapel->id)->distinct()
            ->groupBy('kelas_id')
            ->get();

        return view('guru.khs.kelas', compact(['data_jadwal']));
    }

    /**
     * Pilih Mahasiswa
     */
    public function pilihMahasiswa($kode_mapel, $kelas_id)
    {
        $tahun = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $mapel = MataPelajaran::where('kode_mapel', $kode_mapel)->first();
        $data_khs = KartuHasilStudi::where('id_tahun_ajaran', $tahun->id)
            ->where('id_semester', $semester->id);
        $data_mahasiswa = Mahasiswa::
            join('kartu_hasil_studis', 'kartu_hasil_studis.id_mahasiswa', '=', 'mahasiswa.id')
            ->join('kartu_hasil_studi_details', 'kartu_hasil_studis.id', '=', 'kartu_hasil_studi_details.kartu_hasil_studi_id')
            ->where('mahasiswa.kelas_id', $kelas_id)
            ->where('kartu_hasil_studi_details.mapel_id', '=', $mapel->id)
            ->where('kartu_hasil_studis.id_tahun_ajaran', $tahun->id)
            ->where('kartu_hasil_studis.id_semester', $semester->id)
            ->get();
        // dd($data_mahasiswa);

        return view('guru.khs.mahasiswa', compact(['data_mahasiswa', 'mapel', 'tahun', 'semester', 'dosen']));
    }

    public function storeNilai($kode_mapel, $kelas_id, $id_mahasiswa, $id, DosenInputNilaiKHSRequest $request)
    {

        $tahun = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $mapel = MataPelajaran::where('kode_mapel', $kode_mapel)->first();
        $mahasiswa = Mahasiswa::find($id_mahasiswa);
        $khs = KartuHasilStudi::where('id_tahun_ajaran', $tahun->id)
            ->where('id_semester', $semester->id)->where('id_mahasiswa', $mahasiswa->id)->first();
        $detail = KartuHasilStudiDetail::find($id);
        if ($detail != null) {
            $detail->update([
                'mutu' => $request->mutu,
                'nilai' => $request->nilai,
                'id_dosen' => $dosen->id
            ]);

            return redirect()->back()->with([
                'success' => 'Berhasil input KHS ' . $mahasiswa->nama_mahasiswa
            ]);
        } else {
            $detail = KartuHasilStudiDetail::where('kartu_hasil_studi_id', $khs->id)
            ->where('mapel_id', $mapel->id)->first();
            $detail->update([
                'mutu' => $request->mutu,
                'nilai' => $request->nilai,
                'id_dosen' => $dosen->id
            ]);
            return redirect()->back()->with([
                'error' => 'Gagal input KHS ' . $mahasiswa->nama_mahasiswa
            ]);
        }
    }

    public function updateNilai($kode_mapel, $kelas_id, $id_mahasiswa, $id, DosenInputNilaiKHSRequest $request)
    {
        $detail = KartuHasilStudiDetail::find($id);
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $mahasiswa = Mahasiswa::find($id_mahasiswa);
        $detail->update([
            'mutu' => $request->mutu,
            'nilai' => $request->nilai,
            'id_dosen' => $dosen->id
        ]);

        return redirect()->back()->with([
            'success' => 'Berhasil update KHS ' . $mahasiswa->nama_mahasiswa
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}