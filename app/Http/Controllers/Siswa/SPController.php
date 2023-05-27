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
use App\Models\KRSSP;
use App\Models\DataSP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SPController extends Controller
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
        //
        $tahun = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);
        $prodi = Prodi::where('id_prodi', $id_prodi)->first();

        $data_mahasiswa = '';

        $data_krs = DataSP::where('id_tahun_ajaran', $id_tahun_ajaran)->where('id_semester', $id_semester)
            ->where('id_prodi', $id_prodi)->get();

        return view('siswa.sp.create', [
            'tahun' => $tahun,
            'semester' => $semester,
            'prodi' => $prodi,
            'data_krs' => $data_krs
        ]);
    }

 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
        $tahun = TahunAjaran::all();
        $semester = Semester::all();
        $prodi = Prodi::all();
        $data_mapel = MataPelajaran::all();
        

        $siswa = Mahasiswa::where('user_id', '=', Auth::id())->first();
        return view('siswa.sp.create', [
            'tahun' => $tahun,
            'semester' => $semester,
            'prodi' => $prodi,
            'data_mapel' => $data_mapel,
            'data_mahasiswa' => $siswa
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
       //$paket = PaketKrs::where('id_prodi', $id_prodi)->where('tingkat_semester', $request->tingkat_semester)->get();

        $krs = DataSP::create([
            'id_tahun_ajaran' => $id_tahun_ajaran,
            'id_semester' => $id_semester,
            'id_fakultas' => $prodi->jurusan->fakultas->id,
            'id_jurusan' => $prodi->jurusan->id,
            'id_prodi' => $id_prodi,
            'id_mahasiswa' => $request->id_mahasiswa,
            'tingkat_semester' => $request->tingkat_semester,
            'status' => 'Belum Aktif',
            'mapel_id' => $request->id_mapel,
        ]);

        return redirect()->back()->with([
            'success' => 'Berhasil menambah Data SP Baru'
        ]);
    }
}