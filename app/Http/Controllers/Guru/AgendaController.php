<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\DosenStoreAgendaRequest;
use App\Models\Agenda;
use App\Models\AgendaDetail;
use App\Models\AgendaDetailSiswa;
use App\Models\DataSekolah;
use App\Models\Guru;
use App\Models\Dosen;
use App\Models\ProfilPT;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Prodi;
use App\Models\Pengampu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class AgendaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:dosen']);
    }

    public function index()
    {
        // if (Gate::denies('view-agenda')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $data_tahun_ajaran = TahunAjaran::all();
        $data_semester = Semester::all();


        return view('guru.agenda.index', [
            'data_tahun_ajaran' => $data_tahun_ajaran,
            'data_semester' => $data_semester
        ]);
    }

    public function detailAgenda($id_tahun_ajaran, $id_semester, $id_prodi)
    {
        // if (Gate::denies('view-agenda')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $guru = Dosen::where('user_id', Auth::id())->first();

        $tahun_ajaran = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);
        $prodi = Prodi::where('id_prodi', $id_prodi)->first();

        $mapel = DB::table('mapel')
            ->select('nama_mapel', DB::raw('id as mapel_id'));

        $data_agenda = DB::table('agendas')->joinSub($mapel, 'mapel', function ($join) {
            $join->on('agendas.mapel_id', '=', 'mapel.mapel_id');
        })->where('guru_id', '=', $guru->id)
            ->where('tahun_ajaran', $tahun_ajaran->nama_tahun_ajaran)
            ->where('semester', $semester->nama_semester)
            ->where('id_prodi', $id_prodi)
            ->get();


        $data_tahun_ajaran = TahunAjaran::all();
        $data_semester = Semester::all();

        $pengampu = Pengampu::join('mapel', 'pengampu.mapel_id', '=', 'mapel.id')
            ->join('dosen', 'pengampu.id_dosen', '=', 'dosen.id')
            ->where('id_tahun_ajaran', $tahun_ajaran->id)
            ->where('id_semester', $semester->id)
            ->where('id_prodi', $prodi->id_prodi)
            ->where('user_id', Auth::id())->get();
        // dd($pengampu);
        return view('guru.agenda.detail', [
            'tahun_ajaran' => $tahun_ajaran,
            'semester' => $semester,
            'prodi' => $prodi,
            'mapel' => $pengampu,
            'data_agenda' => $data_agenda,
            'data_tahun_ajaran' => $tahun_ajaran,
            'data_semester' => $semester
        ]);
    }

    public function getProdi($id_tahun_ajaran, $id_semester)
    {
        $tahun_ajaran = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);

        $dosen = Dosen::where('user_id', Auth::id())->first();
        $pengampu = Pengampu::where('id_dosen', $dosen->id)
            ->where('id_tahun_ajaran', $tahun_ajaran->id)
            ->where('id_semester', $semester->id)->select('id_prodi');

        $data_prodi = Prodi::whereIn('id_prodi', $pengampu)->get();

        return view('guru.agenda.prodi', [
            'tahun_ajaran' => $tahun_ajaran,
            'semester' => $semester,
            'data_prodi' => $data_prodi
        ]);
    }

    public function store(Request $request)
    {
        // if (Gate::denies('create-agenda')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $guru = Dosen::where('user_id', Auth::id())->first();
        $this->validate($request, [
            // 'id_prodi' => 'required',
            'tahun_ajaran' => 'required',
            'semester' => 'required',
            'mapel_id' => [Rule::unique('agendas')->where(function ($query) use ($request, $guru) {
                return $query->where('id_prodi', $request->id_prodi)
                    ->where('tahun_ajaran', $request->tahun_ajaran)
                    ->where('mapel_id', $request->mapel_id)
                    ->where('guru_id', $guru->id)
                    ->where('semester', $request->semester);
            }), 'required']
        ]);

        $pengampu = Pengampu::join(
            'mapel',
            'pengampu.mapel_id',
            '=',
            'mapel.id'
        )->join(
            'dosen',
            'pengampu.id_dosen',
            '=',
            'dosen.id'
        )->where('user_id', Auth::id())->first();

        // dd($pengampu);


        // dd($pengampu->user_id);

        $agenda = Agenda::create([
            'id_prodi' => $request->id_prodi,
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester,
            'mapel_id' => $request->mapel_id,
            'guru_id' => $guru->id
        ]);

        return redirect()->back();
    }

    public function addDetail(Request $request, $id)
    {
        // if (Gate::denies('manage-agenda')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $this->validate($request, [
            'nama_siswa' => 'required',
            'keterangan' => 'required'
        ]);
        $agenda = AgendaDetailSiswa::create([
            'agendas_detail_id' => $id,
            'nama_siswa' => $request->nama_siswa,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('update-agenda')) {
            abort(403, 'User does not have the right permissions.');
        }
        $this->validate($request, [
            'tahun_ajaran' => 'required',
            'semester' => 'required'
        ]);

        $agenda = Agenda::find($id);
        $agenda->mapel_id = $request->mapel_id;
        $agenda->tahun_ajaran = $request->tahun_ajaran;
        $agenda->semester = $request->semester;
        $agenda->save();

        return redirect()->back();
    }

    public function updateDetail(Request $request, $id)
    {
        // if (Gate::denies('update-agenda')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $this->validate($request, [
            'tanggal_kbm' => 'required',
            'jam_kbm' => 'required',
            'nama_kelas' => 'required',
            'kegiatan' => 'required',
            'penugasan' => 'required'
        ]);

        $agenda = AgendaDetail::find($id);

        $agenda->tanggal_kbm = $request->tanggal_kbm;
        $agenda->jam_kbm = $request->jam_kbm;
        $agenda->nama_kelas = $request->nama_kelas;
        $agenda->kegiatan = $request->kegiatan;
        $agenda->penugasan = $request->penugasan;
        $agenda->save();


        $agenda->save();

        return redirect()->back();
    }
    public function edit($id_tahun_ajaran, $id_semester, $id_prodi, $id)
    {
        // if (Gate::denies('edit-agenda')) {
        //     abort(403, 'User does not have the right permissions.');
        // }


        $tahun_ajaran = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);


        $data_sekolah = DataSekolah::all()->first();
        $data_pt = ProfilPT::all()->first();
        $data_kelas = Kelas::all();
        $guru = Dosen::where('user_id', Auth::id())->first();

        // dd($semester);
        $agenda = Agenda::find($id);
        if (!$agenda) {
            abort(404);
        }

        if ($agenda->guru_id != $guru->id) {
            abort(403, 'Bukan hak akses Anda');
        }


        return view('guru.agenda.edit', [
            'id_prodi' => $id_prodi,
            'tahun_ajaran' => $tahun_ajaran,
            'semester' => $semester,
            'data_sekolah' => $data_pt,
            'data_kelas' => $data_kelas,
            'agenda' => $agenda
        ]);
    }

    public function storeDetail(Request $request, $id)
    {
        // if (Gate::denies('create-agenda')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $this->validate($request, [
            'tanggal_kbm' => 'required',
            'jam_kbm' => 'required',
            'nama_kelas' => 'required',
            'kegiatan' => 'required',
            'penugasan' => 'required'
        ]);

        AgendaDetail::create([
            'agenda_id' => $id,
            'tanggal_kbm' => $request->tanggal_kbm,
            'jam_kbm' => $request->jam_kbm,
            'nama_kelas' => $request->nama_kelas,
            'kegiatan' => $request->kegiatan,
            'penugasan' => $request->penugasan
        ]);

        return redirect()->back();
    }

    public function storeDetailSiswa(Request $request, $id_detail)
    {
        // if (Gate::denies('create-agenda')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $this->validate($request, [
            'nama_siswa' => 'required',
            'keterangan' => 'required'
        ]);

        $agenda_detail = AgendaDetail::find($id_detail);

        if (!$agenda_detail) {
            abort(404);
        }
        $detail_siswa = AgendaDetailSiswa::create([
            'agenda_detail_id' => $agenda_detail->id,
            'nama_siswa' => $request->nama_siswa,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back();
    }

    public function deleteDetail(Request $request, $id)
    {
        // if (Gate::denies('edit-agenda')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $detail_siswa = AgendaDetailSiswa::find($id);

        if (!$detail_siswa) {
            return redirect()->back();
        }

        $detail_siswa->delete($detail_siswa);

        return redirect()->back();
    }

    public function getSiswa($nama_kelas)
    {
        // if (Gate::denies('view-agenda')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $kelas = Kelas::where('nama_kelas', $nama_kelas)->first();

        if (!$kelas) {
            abort(404);
        }

        $data_siswa = Siswa::select('nama_depan', 'nama_belakang')->where('kelas_id', $kelas->id)->get()->toArray();


        return $data_siswa;
    }
}
