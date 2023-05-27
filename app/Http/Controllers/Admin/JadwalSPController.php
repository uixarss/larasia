<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Waktu;
use App\JadwalPelajaranGuru;
use App\Jobs\ProcessGeneticAlgorithm;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\JadwalSP;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Models\Setting;
use App\Algoritma\GenerateAlgoritma;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Prodi;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalSPController extends Controller
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
        $data_guru = Dosen::all();
        $data_hari = Hari::all();
        $data_tahun_ajaran = TahunAjaran::all();
        $data_semester = Semester::all();
        // $data_kelas = Kelas::all();
        $data_mapel = DB::table('mapel')
            ->rightJoin('krs_sp', 'mapel.id', '=', 'krs_sp.mapel_id')
            ->get();
        $data_waktu = Waktu::all();
        $data_ruangan = Ruangan::all();
        $data_jadwal = JadwalSP::all();
        $data_prodi = Prodi::all();

        return view('admin.jadwalsp.index', [
            'data_guru' => $data_guru,
            'data_hari' => $data_hari,
            'data_tahun_ajaran' => $data_tahun_ajaran,
            'data_semester' => $data_semester,
            'data_jadwal' => $data_jadwal,
            //  'data_kelas' => $data_kelas,
            'data_mapel' => $data_mapel,
            'data_waktu' => $data_waktu,
            'data_ruangan' => $data_ruangan,
            'data_prodi' => $data_prodi
        ]);
    }

    //Untuk Detail Guru

    public function detailjadwalguru()
    {
        return view('admin.jadwalpelajaranguru.detailjadwalguru');
    }

    public function tambahjadwalguru()
    {
        return view('admin.jadwalpelajaranguru.tambahjadwalguru');
    }


    public function submit(Request $request)
    {
        $input_kromosom   = $request->input('jumlah_kromosom');
        $input_year       = $request->input('tahun_ajaran_id');
        $input_semester   = $request->input('semester_id');
        $input_generasi   = $request->input('jumlah_generasi');
        $input_crossover  = $request->input('jumlah_crossover');
        $input_mutasi     = $request->input('jumlah_mutasi');

        $count_teachs     = Guru::count();
        $kromosom         = $input_kromosom * $input_generasi;
        $crossover        = $input_kromosom * $input_crossover;

        $generate         = new GenerateAlgoritma;
        $data_kromosoms   = $generate->randKromosom(1, $count_teachs, $input_year, $input_semester);
        $result_schedules = $generate->checkPinalty();

        ProcessGeneticAlgorithm::dispatchNow($generate);


        $total_gen        = Setting::firstOrNew(['key' => 'total_gen']);
        $total_gen->name  = 'Total Gen';
        $total_gen->value = $crossover;
        $total_gen->save();

        $mutasi        = Setting::firstOrNew(['key' => 'mutasi']);
        $mutasi->name  = 'Mutasi';
        $mutasi->value = (3 * $count_teachs) * $input_kromosom * $input_mutasi;
        $mutasi->save();


        return redirect()->back();
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'tahun_ajaran_id' => 'required',
            'semester_id' => 'required',
            //'kelas_id' => 'required',
            'guru_id' => 'required',
            'mapel_id' => 'required',
            'hari_id' => 'required',
            'waktu_id' => 'required',
            'ruangan_id' => 'required',
            'prodi_id' => 'required'
        ]);

        $data_jadwal = JadwalSP::create([
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
            'semester_id' => $request->semester_id,
            //'kelas_id' => $request->kelas_id,
            'id_dosen' => $request->guru_id,
            'mapel_id' => $request->mapel_id,
            'hari_id' => $request->hari_id,
            'waktu_id' => $request->waktu_id,
            'ruangan_id' => $request->ruangan_id,
            'prodi_id' => $request->prodi_id
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tahun_ajaran_id' => 'required',
            'semester_id' => 'required',
            //'kelas_id' => 'required',
            'guru_id' => 'required',
            'mapel_id' => 'required',
            'hari_id' => 'required',
            'waktu_id' => 'required',
            'ruangan_id' => 'required',
            'prodi_id' => 'required'
        ]);
        $data_jadwal = JadwalSP::find($id);

        $data_jadwal->update([
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
            'semester_id' => $request->semester_id,
            // 'kelas_id' => $request->kelas_id,
            'id_dosen' => $request->guru_id,
            'mapel_id' => $request->mapel_id,
            'hari_id' => $request->hari_id,
            'waktu_id' => $request->waktu_id,
            'ruangan_id' => $request->ruangan_id,
            'prodi_id' => $request->prodi_id
        ]);

        return redirect()->back();
    }

    public function delete($id)
    {
        try {
            $sp = JadwalSP::find($id);
            $sp->delete();

            return redirect()->back()->with([
                'success' => 'Hapus data jadwal semester antara'
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' => $th->getMessage()]);
        }
    }
}
