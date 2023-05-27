<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\AgendaDetail;
use App\Models\AgendaDetailSiswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\Dosen;
use App\Models\Siswa;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Pengampu;
use App\Models\MataPelajaran;
use App\Models\TahunAjaran;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    public function listTahunSemester()
    {

        $data = [];
        $data_tahun_ajaran = TahunAjaran::all();
        $data_semester = Semester::all();

        
        foreach ($data_tahun_ajaran as $tahun_ajaran ) {

            foreach($data_semester as $semester){
                $data2 = [
                    'id_tahun_ajaran' => $tahun_ajaran->id,
                    'id_semester' => $semester->id,
                    'nama' =>  $tahun_ajaran->nama_tahun_ajaran.' / '.$semester->nama_semester
                ];
                
                array_push($data, $data2);
            }

        }

        
        return response()->json($data);
    }

    public function listProdi(Request $request)
    {
        
        $tahun_ajaran = TahunAjaran::find($request->id_tahun_ajaran);
        $semester = Semester::find($request->id_semester);

        $data_prodi = Prodi::with('jurusan.fakultas')->get();

        $data = [];

        foreach($data_prodi as $prodi){
            $data2 = [
                'id_tahun_ajaran' => $tahun_ajaran->id,
                'id_semester' => $semester->id,
                'id_prodi' => $prodi->id_prodi,
                'nama' =>  $prodi->jurusan->fakultas->nama_fakultas.' / '.
                            $prodi->jurusan->nama_jurusan.' / '.
                            $prodi->nama_program_studi
            ];
            
            array_push($data, $data2);
        }

        
        return response()->json($data);

    }

    // list agenda
    public function listAgenda(Request $request)
    {
        
        $guru = Dosen::where('user_id', Auth::id())->first();
        
        $tahun_ajaran = TahunAjaran::find($request->id_tahun_ajaran);
        $semester = Semester::find($request->id_semester);
        $prodi = Prodi::where('id_prodi', $request->id_prodi)->first();
        
        $mapel = DB::table('mapel')
                    ->select('nama_mapel', DB::raw('id as mapel_id'));

        $data_agenda = DB::table('agendas')->joinSub($mapel, 'mapel', function ($join) {
                      $join->on('agendas.mapel_id', '=', 'mapel.mapel_id');
                  })->where('guru_id','=', $guru->id)
                  ->where('tahun_ajaran',$tahun_ajaran->nama_tahun_ajaran)
                  ->where('semester', $semester->nama_semester)
                  ->where('id_prodi', $prodi->id_prodi)
                  ->get();

        
        return response()->json($data_agenda);
    }

    // list agenda detail
    public function listAgendaDetail(Request $request, $agenda_id)
    {
        $agenda_detail = AgendaDetail::where('agenda_id', $agenda_id)->with('agendaDetailSiswa')->get();

        return response()->json($agenda_detail);
    }

    // list agenda detail
    public function listAgendaDetailSiswa(Request $request, $agenda_detail_id)
    {
        $agenda_detail_siswa = AgendaDetailSiswa::where('agendas_detail_id', $agenda_detail_id)->get();

        return response()->json($agenda_detail_siswa);
    }

    // membuat agenda
    public function createAgenda(Request $request)
    {
        $guru = Dosen::where('user_id', Auth::id())->first();
        $mapel = MataPelajaran::where('nama_mapel', $request->nama_mapel)->first();
        $valid = $this->validate($request, [
            'id_prodi' => 'required',
            'nama_mapel' => 'required',
            'tahun_ajaran' => 'required',
            'semester' => 'required'
        ]);

        if (!$valid) {
            return response()->json(false);
        }
        $agenda = Agenda::create([
            'id_prodi' => $request->id_prodi,
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester,
            'mapel_id' => $mapel->id,
            'guru_id' => $guru->id
        ]);

        return response()->json($agenda);
    }

    // update agenda
    public function updateAgenda(Request $request, $id)
    {
        $guru = Dosen::where('user_id', Auth::id())->first();

        $agenda = Agenda::find($id);

        $agenda->update([
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester,
            'mapel_id' => $guru->mapel_id,
            'guru_id' => $guru->id
        ]);

        return response()->json($agenda);
    }

    public function getMatkul(Request $request)
    {
        
        $tahun_ajaran = TahunAjaran::find($request->id_tahun_ajaran);
        $semester = Semester::find($request->id_semester);
        $prodi = Prodi::where('id_prodi', $request->id_prodi)->first();

        $nama_mapel = Pengampu::join('mapel', 'pengampu.mapel_id', '=', 'mapel.id')
            ->join('dosen', 'pengampu.id_dosen', '=', 'dosen.id')
            ->where('id_tahun_ajaran',$tahun_ajaran->id)
            ->where('id_semester', $semester->id)
            ->where('id_prodi', $prodi->id_prodi)
            ->where('user_id', Auth::id())->get('mapel.nama_mapel');

        return response()->json($nama_mapel);
    }

    // get tahun ajaran list
    public function getTahunAjaran(Request $request)
    {
        $data_tahun_ajaran = TahunAjaran::where('id', $request->id_tahun_ajaran)->get();

        return response()->json($data_tahun_ajaran);
    }

    // get semester list
    public function getSemester(Request $request)
    {
        $data_semester = Semester::where('id', $request->id_semester)->get();

        return response()->json($data_semester);
    }

    //membuat agenda detail
    public function storeDetail(Request $request, $id)
    {
        $this->validate($request, [
            'tanggal_kbm' => 'required',
            'jam_kbm' => 'required',
            'nama_kelas' => 'required',
            'kegiatan' => 'required',
            'penugasan' => 'required'
        ]);

        $agenda = AgendaDetail::create([
            'agenda_id' => $id,
            'tanggal_kbm' => $request->tanggal_kbm,
            'jam_kbm' => $request->jam_kbm,
            'nama_kelas' => $request->nama_kelas,
            'kegiatan' => $request->kegiatan,
            'penugasan' => $request->penugasan
        ]);

        return response()->json($agenda);
    }
    public function updateDetail(Request $request, $id_detail)
    {
        $agenda_detail = AgendaDetail::find($id_detail);

        $agenda_detail->update([
            'tanggal_kbm' => $request->tanggal_kbm,
            'jam_kbm' => $request->jam_kbm,
            'nama_kelas' => $request->nama_kelas,
            'kegiatan' => $request->kegiatan,
            'penugasan' => $request->penugasan
        ]);
        return response()->json($agenda_detail);
    }


    public function storeDetailSiswa(Request $request, $id_detail)
    {
        $this->validate($request, [
            'nama_siswa' => 'required',
            'keterangan' => 'required'
        ]);

        $agenda_detail = AgendaDetail::find($id_detail);

        if (!$agenda_detail) {
            abort(404);
        }
        $detail_siswa = AgendaDetailSiswa::create([
            'agendas_detail_id' => $agenda_detail->id,
            'nama_siswa' => $request->nama_siswa,
            'keterangan' => $request->keterangan
        ]);

        return response()->json($detail_siswa);
    }

    public function updateDetailSiswa(Request $request, $id_detail_siswa)
    {
        $agenda_detail_siswa = AgendaDetailSiswa::find($id_detail_siswa);

        $agenda_detail_siswa->update([
            'nama_siswa' => $request->nama_siswa,
            'keterangan' => $request->keterangan
        ]);

        return response()->json($agenda_detail_siswa);
    }

    //list kelas
    public function listKelas()
    {
        $data_kelas = Kelas::all();

        return response()->json($data_kelas);
    }
    // list siswa
    public function listSiswa(Request $request)
    {
        $kelas = Kelas::where('nama_kelas', $request->nama_kelas)->first();
        
        // $kelas = App\Models\Kelas::where('nama_kelas', $request->nama_kelas)->first();
        
        $data_siswa = Mahasiswa::where('kelas_id', $kelas->id)->get('nama_mahasiswa');

        // $data_siswa = Siswa::where('kelas_id', $kelas->id)->get(['id','nama_depan','nama_belakang']);

        return response()->json($data_siswa);
    }
}
