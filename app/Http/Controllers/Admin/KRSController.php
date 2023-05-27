<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DaftarUlang;
use App\Models\KartuHasilStudi;
use App\Models\KartuHasilStudiDetail;
use App\Models\KRS;
use App\Models\KRSDetail;
use App\Models\Mahasiswa;
use App\Models\MataPelajaran;
use App\Models\PaketKrs;
use App\Models\Pembayaran;
use App\Models\Prodi;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KRSController extends Controller
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
    public function index($id_tahun_ajaran, $id_semester, $id_prodi)
    {
        //
        $tahun = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);
        $prodi = Prodi::where('id_prodi', $id_prodi)->first();

        $data_mahasiswa = '';

        $data_krs = KRS::where('id_tahun_ajaran', $id_tahun_ajaran)->where('id_semester', $id_semester)
            ->where('id_prodi', $id_prodi)->get();

        return view('admin.krs.index', [
            'tahun' => $tahun,
            'semester' => $semester,
            'prodi' => $prodi,
            'data_krs' => $data_krs
        ]);
    }

    public function pilihTahun()
    {
        $data_tahun = TahunAjaran::all();
        $data_semester = Semester::all();

        return view('admin.krs.tahun', [
            'data_tahun' => $data_tahun,
            'data_semester' => $data_semester
        ]);
    }

    public function pilihProdi($id_tahun_ajaran, $id_semester)
    {
        $tahun = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);
        $data_prodi = Prodi::all();
        return view('admin.krs.prodi', [
            'tahun' => $tahun,
            'semester' => $semester,
            'data_prodi' => $data_prodi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_tahun_ajaran, $id_semester, $id_prodi)
    {
        $tahun = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);
        $prodi = Prodi::where('id_prodi', $id_prodi)->first();
        $data_mapel = MataPelajaran::all();
        $data_krs = KRS::where('id_tahun_ajaran', $id_tahun_ajaran)->where('id_semester', $id_semester)
            ->where('id_prodi', $id_prodi)->select('id_mahasiswa')->get();
        $data_pembayaran = DaftarUlang::where('id_tahun_ajaran', $id_tahun_ajaran)->where('id_semester', $id_semester)
            ->where('id_prodi', $id_prodi)->where('status_pembayaran', true)->select('id_mahasiswa')->get();

        $data_mahasiswa = DB::table('mahasiswa')->whereNotIn('id', $data_krs)
            ->whereIn('id', $data_pembayaran)
            ->get();
        return view('admin.krs.create', [
            'tahun' => $tahun,
            'semester' => $semester,
            'prodi' => $prodi,
            'data_mapel' => $data_mapel,
            'data_mahasiswa' => $data_mahasiswa
        ]);
    }

    public function tingkatTerakhir($id_mahasiswa)
    {
        $krs = KRS::where('id_mahasiswa', $id_mahasiswa)->max('tingkat_semester');

        $data = [
            $krs + 1 => $krs + 1
        ];

        return json_encode($data, true);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_tahun_ajaran, $id_semester, $id_prodi)
    {
        $prodi = Prodi::where('id_prodi', $id_prodi)->first();
        $paket = PaketKrs::where('id_prodi', $id_prodi)->where('tingkat_semester', $request->tingkat_semester)->get();

        $krs = KRS::create([
            'id_tahun_ajaran' => $id_tahun_ajaran,
            'id_semester' => $id_semester,
            'id_fakultas' => $prodi->jurusan->fakultas->id,
            'id_jurusan' => $prodi->jurusan->id,
            'id_prodi' => $id_prodi,
            'id_mahasiswa' => $request->id_mahasiswa,
            'tingkat_semester' => $request->tingkat_semester
        ]);
        $khs = KartuHasilStudi::create([
            'id_tahun_ajaran' => $id_tahun_ajaran,
            'id_semester' => $id_semester,
            'id_prodi' => $id_prodi,
            'id_mahasiswa' => $request->id_mahasiswa,
            'tingkat_semester' => $request->tingkat_semester
        ]);

        foreach ($paket as $key => $pak) {
            $krs_detail = KRSDetail::create([
                'id_krs' => $krs->id,
                'mapel_id' => $pak->mapel_id
            ]);
        }
        foreach ($paket as $key => $pak) {
            $khs_detail = KartuHasilStudiDetail::create([
                'kartu_hasil_studi_id' => $khs->id,
                'mapel_id' => $pak->mapel_id
            ]);
        }


        return redirect()->back()->with([
            'success' => 'Berhasil menambah KRS Baru'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_tahun_ajaran, $id_semester, $id_prodi, $id)
    {
        $tahun = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);
        $prodi = Prodi::where('id_prodi', $id_prodi)->first();
        $krs = KRS::where('id', $id)->with('detail')->first();

        if ($tahun == null || $semester == null || $prodi == null || $krs == null) {
            return abort(404, 'Data Not Found');
        }
        return view('admin.krs.show', [
            'tahun' => $tahun,
            'semester' => $semester,
            'prodi' => $prodi,
            'krs' => $krs
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_tahun_ajaran, $id_semester, $id_prodi, $id)
    {
        $tahun = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);
        $prodi = Prodi::where('id_prodi', $id_prodi)->first();
        $krs = KRS::where('id', $id)->with('detail')->first();

        if ($tahun == null || $semester == null || $prodi == null || $krs == null) {
            return abort(404, 'Data Not Found');
        }

        return view('admin.krs.edit', [
            'tahun' => $tahun,
            'semester' => $semester,
            'prodi' => $prodi,
            'krs' => $krs
        ]);
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
    public function destroyKRS($id_tahun_ajaran, $id_semester, $id_prodi, $id)
    {
        //
        $krs = KRS::find($id);
        $id_mahasiswa = $krs->id_mahasiswa;
        $tingkat_semester = $krs->tingkat_semester;
        $krs->delete();

        $krs_detail = KRSDetail::where('id_krs',$id);
        $krs_detail->delete();

        $khs = KartuHasilStudi::where('id_mahasiswa',$id_mahasiswa);
        $khs = $khs->where('tingkat_semester',$tingkat_semester);
        $khs = $khs->where('id_tahun_ajaran',$id_tahun_ajaran);
        $khs = $khs->where('id_semester',$id_semester);
        $khs = $khs->where('id_prodi',$id_prodi);
        $khs = $khs->get()->first();

        $khs_id = $khs->id;

        $khs = KartuHasilStudi::find($khs_id)->delete();
        $khs_detail = KartuHasilStudiDetail::where('kartu_hasil_studi_id',$khs_id)->delete();

        return redirect()->back()->with([
            'success' => 'Berhasil menghapus KRS'
        ]);
    }

    public function prodi()
    {
        $data_prodi = Prodi::all();

        return view('admin.paket-krs.index', [
            'data_prodi' => $data_prodi
        ]);
    }

    public function PaketKRSProdi($id_prodi)
    {
        $data_paket = PaketKrs::where('id_prodi', $id_prodi)->get();
        $prodi = Prodi::where('id_prodi', $id_prodi)->first();
        $data_mapel = MataPelajaran::all();

        return view('admin.paket-krs.paket', [
            'data_paket' => $data_paket,
            'data_mapel' => $data_mapel,
            'prodi' => $prodi
        ]);
    }

    public function storePaketKRS(Request $request, $id_prodi)
    {
        $prodi = Prodi::where('id_prodi', $id_prodi)->first();

        foreach ($request->mapel_id as $mapel) {
            PaketKrs::create([
                'id_fakultas' => $prodi->jurusan->fakultas->id,
                'id_jurusan' => $prodi->jurusan->id,
                'id_prodi' => $id_prodi,
                'tingkat_semester' => $request->tingkat_semester,
                'mapel_id' => $mapel
            ]);
        }

        return redirect()->back()->with([
            'success' => 'Berhasil menambah paket KRS'
        ]);
    }

    public function updatePaketKRS(Request $request, $id_prodi, $id)
    {
        $prodi = Prodi::where('id_prodi', $id_prodi)->first();
        $paket = PaketKrs::find($id);

        $paket->update([
            'id_fakultas' => $prodi->jurusan->fakultas->id,
            'id_jurusan' => $prodi->jurusan->id,
            'id_prodi' => $id_prodi,
            'tingkat_semester' => $request->tingkat_semester,
            'mapel_id' => $request->mapel_id
        ]);

        return redirect()->back()->with([
            'success' => 'Berhasil update paket KRS'
        ]);
    }

    public function destroyPaketKRS($id_prodi, $id)
    {
        $paket = PaketKrs::find($id);
        $paket->delete();
        return redirect()->back()->with([
            'success' => 'Berhasil hapus paket KRS'
        ]);
    }
}