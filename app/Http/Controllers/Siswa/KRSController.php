<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\KartuHasilStudi;
use App\Models\KRS;
use App\Models\KartuHasilStudiDetail;
use App\Models\Mahasiswa;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Prodi;
use App\Models\Fakultas;
use App\Models\DaftarUlang;
use App\Models\Jurusan;
use App\Models\DataSP;
use Illuminate\Support\Facades\DB;

class KRSController extends Controller
{
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
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        $data_khs = KRS::where('id_mahasiswa', $mahasiswa->id)->with('detail')->with('tahun')->with('semester')->get();

        return view('siswa.krs.index',compact([
            'data_khs','mahasiswa'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function show()
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


    public function create()
    {
        
        $data_mapel = DB::table('mapel')
            ->rightJoin('krs_sp', 'mapel.id', '=', 'krs_sp.mapel_id')
            ->get();
        

        $mahasiswa = Mahasiswa::where('user_id', '=', Auth::id())->first();

        
        $tahun = TahunAjaran::all();
        $semester = Semester::all();
        $prodi = Prodi::where('id_prodi','=', $mahasiswa->id_prodi)->first();
        //dd($mahasiswa->id_prodi);
        $jurusan = Jurusan::where('id','=', $prodi->id_jurusan)->first();
        $fakultas = Fakultas::where('id','=', $jurusan->id_fakultas)->first();
        return view('siswa.sp.create', [
            'tahun' => $tahun,
            'semester' => $semester,
            'prodi' => $prodi,
            'jurusan' => $jurusan,
            'fakultas' => $fakultas,
            'data_mapel' => $data_mapel,
            'data_mahasiswa' => $mahasiswa
        ]);
    }

    public function store(Request $request)
    {
        
       
        $mahasiswa = Mahasiswa::where('user_id', '=', Auth::id())->first();

        
        $tahun = TahunAjaran::all();
        $semester = Semester::all();
        $prodi = Prodi::where('id_prodi','=', $mahasiswa->id_prodi)->first();
        //dd($mahasiswa->id_prodi);
        $jurusan = Jurusan::where('id','=', $prodi->id_jurusan)->first();
        $fakultas = Fakultas::where('id','=', $jurusan->id_fakultas)->first();
        $krs = DataSP::create([
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'id_semester' => '3',
            'id_fakultas' => $fakultas->id,
            'id_jurusan' => $jurusan->id,
            'id_prodi' => $mahasiswa->id_prodi,
            'id_mahasiswa' => $mahasiswa->id,
            'tingkat_semester' => $request->tingkat_semester,
            'status' => 'Belum Aktif',
            'mapel_id' => $request->id_mapel,
        ]);

        return redirect()->back()->with([
            'success' => 'Berhasil menambah Data SP Baru'
        ]);
    }

}