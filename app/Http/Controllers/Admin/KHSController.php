<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateNilaiKhsRequest;
use Illuminate\Http\Request;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Prodi;
use App\Models\KartuHasilStudi;
use App\Models\KRS;
use App\Models\DaftarUlang;
use App\Models\Mahasiswa;
use App\Models\MataPelajaran;
use App\Models\KartuHasilStudiDetail;
use App\Models\PaketKrs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class KHSController extends Controller
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
        $tahun = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);
        $prodi = Prodi::where('id_prodi', $id_prodi)->first();

        $data_mahasiswa = Mahasiswa::where('id_prodi', $id_prodi)->get();

        $data_khs = KartuHasilStudi::where('id_tahun_ajaran', $id_tahun_ajaran)->where('id_semester', $id_semester)
            ->where('id_prodi', $id_prodi)->get();

        return view('admin.khs.index', [
            'tahun' => $tahun,
            'semester' => $semester,
            'prodi' => $prodi,
            'data_khs' => $data_khs,
            'data_mahasiswa' => $data_mahasiswa
        ]);
    }
    // Memilih Tahun Ajaran
    public function pilihTahun()
    {
        $data_tahun = TahunAjaran::all();
        $data_semester = Semester::all();

        return view('admin.khs.tahun', [
            'data_tahun' => $data_tahun,
            'data_semester' => $data_semester
        ]);
    }
    // Setelah memilih tahun ajaran, memilih prodi
    public function pilihProdi($id_tahun_ajaran, $id_semester)
    {
        $tahun = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);
        $data_prodi = Prodi::all();
        return view('admin.khs.prodi', [
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
            ->whereIn('id', $data_pembayaran);
        $data_mahasiswa = $data_mahasiswa->leftjoin('daftar_ulangs', 'mahasiswa.id', 'daftar_ulangs.id_mahasiswa');
        $data_mahasiswa = $data_mahasiswa->where('daftar_ulangs.id_tahun_ajaran', $id_tahun_ajaran);
        $data_mahasiswa = $data_mahasiswa->where('daftar_ulangs.id_semester', $id_semester);
        $data_mahasiswa = $data_mahasiswa->where('daftar_ulangs.id_prodi', $id_prodi);
        $data_mahasiswa = $data_mahasiswa->get();


        return view('admin.khs.create', [
            'tahun' => $tahun,
            'semester' => $semester,
            'prodi' => $prodi,
            'data_mapel' => $data_mapel,
            'data_mahasiswa' => $data_mahasiswa
        ]);
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


        $khs = KartuHasilStudi::create([
            'id_tahun_ajaran' => $id_tahun_ajaran,
            'id_semester' => $id_semester,
            'id_prodi' => $id_prodi,
            'id_mahasiswa' => $request->id_mahasiswa,
            'tingkat_semester' => $request->tingkat_semester
        ]);

        foreach ($paket as $key => $pak) {
            $khs_detail = KartuHasilStudiDetail::create([
                'kartu_hasil_studi_id' => $khs->id,
                'mapel_id' => $pak->mapel_id
            ]);
        }


        return redirect()->back()->with([
            'success' => 'Berhasil menambah KHS Baru'
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
        $mahasiswa = Mahasiswa::find($id);
        $data_khs = KartuHasilStudi::where('id_mahasiswa', $id)->with('detail')->get();
        $data_krs = KRS::where('id_mahasiswa', $id)->where('id_tahun_ajaran', $id_tahun_ajaran)
            ->where('id_semester', $id_semester)->where('id_prodi', $id_prodi)->with('detail')->get();

        if ($tahun == null || $semester == null || $prodi == null || $data_khs == null) {
            return redirect()->back()->with([
                'error' => 'Data tidak ditemukan'
            ]);
        }
        return view('admin.khs.show', [
            'tahun' => $tahun,
            'semester' => $semester,
            'prodi' => $prodi,
            'data_khs' => $data_khs,
            'mahasiswa' => $mahasiswa
        ]);
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
    public function update_nilai(Request $request)
    {

        try {
            $id = $request->input('id');
            $mutu = $request->input('mutu');
            $nilai = $request->input('nilai');
            $khs_detail = KartuHasilStudiDetail::find($id);
            $khs_detail->mutu = $mutu;
            $khs_detail->nilai = $nilai;
            if ($mutu != null && $nilai != null) {
                $khs_detail->disetujui_oleh = Auth::user()->name;
                $khs_detail->diubah_oleh = Auth::user()->name;
            }
            $khs_detail->save();
            return response()->json([
                'error' => false,
                'data' => 'Berhasil disimpan',
                'status' => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyKHS(Request $request)
    {
        $id = $request->input('id');
        $khs = KartuHasilStudiDetail::find($id);
        $khs->delete();

        // return redirect()->back()->with([
        //   'success' => 'Berhasil menghapus KHS'
        //]);
    }

    public function destroy($id)
    {
        try {
            if (Gate::allows('delete-khs')) {

                $data = KartuHasilStudiDetail::find($id);
                $data->delete();

                return redirect()->back()->with([
                    'success' => 'Berhasil menghapus KHS'
                ]);
            } else {
                return abort(403);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'error' => $th->getMessage()
            ]);
        }
    }

    public function tingkatTerakhir($id_mahasiswa)
    {
        $krs = KRS::where('id_mahasiswa', $id_mahasiswa)->max('tingkat_semester');

        $data = [
            $krs + 1 => $krs + 1
        ];

        return json_encode($data, true);
    }
}
