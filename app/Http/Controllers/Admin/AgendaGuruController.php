<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\AgendaDetail;
use App\Models\AgendaDetailSiswa;
use App\Models\DataSekolah;
use App\Models\Guru;
use App\Models\Prodi;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Models\Kelas;
use App\Models\Dosen;
use App\Models\Pengampu;
use App\Models\Siswa;
use Carbon\Carbon;
use Auth;

class AgendaGuruController extends Controller
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
        $data_tahun_ajaran = TahunAjaran::all();
        $data_semester = Semester::all();

        return view('admin.agendaguru.index', [
            'data_tahun_ajaran' => $data_tahun_ajaran,
            'data_semester' => $data_semester
        ]);
    }

    public function agendaGuru($id_tahun_ajaran, $id_semester, $id_prodi)
    {
        $data_guru = Guru::all();
        $data_tahun_ajaran = TahunAjaran::all();
        $data_semester = Semester::all();
        
        $tahun_ajaran = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);
        $prodi = Prodi::where('id_prodi', $id_prodi)->first();

        $pengampu = Pengampu::where('id_tahun_ajaran',$id_tahun_ajaran)
            ->where('id_semester', $id_semester)
            ->where('id_prodi', $id_prodi)
            ->join('mapel', 'pengampu.mapel_id', '=', 'mapel.id')
            ->join('dosen', 'pengampu.id_dosen', '=', 'dosen.id')
            // ->join('agendas', 'pengampu.id_dosen', '=', 'agendas.guru_id')
            
            ->get();
          
        //   dd($pengampu);

        

        return view('admin.agendaguru.detail',[
            'tahun_ajaran' => $tahun_ajaran,
            'semester' => $semester,
            'prodi' => $prodi,
            'data_guru' => $pengampu,
            'data_tahun_ajaran' => $data_tahun_ajaran,
            'data_semester' => $data_semester,
            // 'gurus' => $gurus
        ]);
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

    public function getProdi($id_tahun_ajaran, $id_semester)
    {
        $tahun_ajaran = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);

        $data_prodi = Prodi::with('jurusan.fakultas')->get();

        return view('admin.agendaguru.prodi',[
            'tahun_ajaran' => $tahun_ajaran,
            'semester' => $semester,
            'data_prodi' => $data_prodi
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $id_agenda)
    {
        $data_sekolah = DataSekolah::all()->first();

        $data_kelas = Kelas::all();

        $guru = Dosen::find($id);



        $agenda = Agenda::find($id_agenda);

        $agendadetail = AgendaDetail::where('agenda_id',$agenda->id)->get();



         // $agendadetailsiswa_arr
        // dd($agendadetailsiswa);


        if (!$agenda) {
            abort(404);
        }
        if ($agenda->guru_id != $guru->id) {
            abort(403,'Bukan hak akses Anda');
        }

        return view('admin.agendaguru.show',[
            'data_sekolah' => $data_sekolah,
            'data_kelas' => $data_kelas,
            'agenda' => $agenda,
            'guru' => $guru,
            // 'agendadetailsiswa' => $agendadetailsiswa
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
}
