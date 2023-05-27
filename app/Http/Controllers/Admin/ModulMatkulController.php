<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\ModulMatkul;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\MataPelajaran;
use App\Models\Semester;
use App\Models\TahunAjaran;

class ModulMatkulController extends Controller
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
        $data_matkul = MataPelajaran::all();
        $data_tahun_ajaran = TahunAjaran::all();
        $data_matkul = MataPelajaran::all();
        $data_jurusan = Jurusan::all();
        $data_semester = Semester::all();
        $data_tahun_ajaran = TahunAjaran::all();

        $jurusans = DB::table('jurusans')
                   ->select('nama_jurusan', DB::raw('id as id_jurusan'));
        $semesters = DB::table('semesters')
                    ->select('nama_semester', DB::raw('id as id_semester'));
        $matkuls = DB::table('mapel')
                    ->select('nama_mapel', DB::raw('id as id_matkul'));
        $prodi = DB::table('prodi')
                    ->select('nama_program_studi', DB::raw('id_prodi as id_prodi'));
        $tahun_ajaran = DB::table('tahun_ajarans')
                    ->select('nama_tahun_ajaran', DB::raw('id as id_tahun_ajaran'));

        $modul_matkul = DB::table('modul_matkul')
                ->joinSub($jurusans, 'jurusans', function ($join) {
                    $join->on('modul_matkul.id_jurusan', '=', 'jurusans.id_jurusan');
                })->joinSub($semesters, 'semesters', function ($join) {
                    $join->on('modul_matkul.id_semester', '=', 'semesters.id_semester');
                })->joinSub($matkuls, 'mapel', function ($join) {
                    $join->on('modul_matkul.id_matkul', '=', 'mapel.id_matkul');
                })->joinSub($prodi, 'prodi', function ($join) {
                    $join->on('modul_matkul.id_prodi', '=', 'prodi.id_prodi');
                })->joinSub($tahun_ajaran, 'tahun_ajarans', function ($join) {
                    $join->on('modul_matkul.id_tahun_ajaran', '=', 'tahun_ajarans.id_tahun_ajaran');
                })->get();
        $jumlah = count($modul_matkul);

                // dd(count($modul_matkul));

        return view('admin.modulmatkul.index',[
          'modul_matkul' => $modul_matkul,
          'data_matkul' => $data_matkul,
          'data_semester' => $data_semester,
          'data_tahun_ajaran' => $data_tahun_ajaran,
          'data_jurusan' => $data_jurusan,
          'jumlah' => $jumlah
          ]);
    }

    public function prodi(Request $request, $id){
        $prodi = Prodi::where('id_jurusan', $id)->orderBy('nama_program_studi')->pluck('id_prodi', 'nama_program_studi');
        return json_encode($prodi);
  
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'id_jurusan' => 'required',
            'id_prodi' => 'required',
            'id_matkul' => 'required',
            'id_semester' => 'required',
            'id_tahun_ajaran' => 'required'
        ]);

        //Insert Ke Tabel Matapelajaran
        $modul_matkul = ModulMatkul::create([
            'id_jurusan' => $request->id_jurusan,
            'id_prodi' => $request->id_prodi,
            'id_matkul' => $request->id_matkul,
            'id_semester' => $request->id_semester,
            'id_tahun_ajaran' => $request->id_tahun_ajaran
        ]);

        return redirect()->route('admin.modulmatkul.index');
    }

    public function update(Request $request, $id)
    {
        $modul_matkul = ModulMatkul::find($id);

          $modul_matkul->update([
            'id_jurusan' => $request->id_jurusan,
            'id_prodi' => $request->id_prodi,
            'id_matkul' => $request->id_matkul,
            'id_semester' => $request->id_semester,
            'id_tahun_ajaran' => $request->id_tahun_ajaran
          ]);

          return redirect()->route('admin.modulmatkul.index');
    }

    public function destroy($id){

        $modul_matkul = ModulMatkul::find($id);
        $modul_matkul->delete($modul_matkul);

        return redirect()->route('admin.modulmatkul.index');

    }
}
