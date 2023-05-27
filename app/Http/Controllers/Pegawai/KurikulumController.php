<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Kurikulum;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Gate;

class KurikulumController extends Controller
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
        if (Gate::denies('view-kurikulum')) {
            abort(403, 'User does not have the right permissions.');
        }
        $fakultas = Fakultas::all();
        $jurusan = Jurusan::all();
        $prodi = Prodi::all();
        $semester = Semester::all();
        $tahun_ajaran = TahunAjaran::all();
        // $kurikulum = Kurikulum::all();

        
        $fakulta = DB::table('fakultas')
                    ->select('nama_fakultas', DB::raw('id as id_fakultas'));
        $jurusans = DB::table('jurusans')
                    ->select('nama_jurusan', DB::raw('id as id_jurusan'));
        $prodis = DB::table('prodi')
                    ->select('nama_program_studi', DB::raw('id_prodi as id_prodi'));
        $semesters = DB::table('semesters')
                    ->select('nama_semester', DB::raw('id as id_semester'));
        $tahun_ajarans = DB::table('tahun_ajarans')
                    ->select('nama_tahun_ajaran', DB::raw('id as id_tahun_ajaran'));

        $kurikulum = DB::table('kurikulum')
                ->joinSub($semesters, 'semesters', function ($join) {
                    $join->on('kurikulum.id_semester', '=', 'semesters.id_semester');
                })->joinSub($fakulta, 'fakultas', function ($join) {
                    $join->on('kurikulum.id_fakultas', '=', 'fakultas.id_fakultas');
                })->joinSub($jurusans, 'jurusans', function ($join) {
                    $join->on('kurikulum.id_jurusan', '=', 'jurusans.id_jurusan');
                })->joinSub($prodis, 'prodi', function ($join) {
                    $join->on('kurikulum.id_prodi', '=', 'prodi.id_prodi');
                })->joinSub($tahun_ajarans, 'tahun_ajarans', function ($join) {
                    $join->on('kurikulum.id_tahun_ajaran', '=', 'tahun_ajarans.id_tahun_ajaran');
                })->get();

                // dd($kurikulum);
        $jumlah = count($kurikulum);

        return view('pegawai.kurikulum.index',
            ['kurikulum' => $kurikulum,
            'fakultas' => $fakultas,
            'semester' => $semester,
            'jumlah' => $jumlah,
            'tahun_ajaran' => $tahun_ajaran]);
    }

    public function create(Request $request){
        if (Gate::denies('create-kurikulum')) {
            abort(403, 'User does not have the right permissions.');
        }
        $this->validate($request, [
            'nama_kurikulum' => 'required',
            'jumlah_sks_lulus' => 'required',
            'jumlah_sks_wajib' => 'required',
            'jumlah_sks_pilihan' => 'required'
        ]);



        $kurikulum = Kurikulum::create([
            'nama_kurikulum' => $request->nama_kurikulum,
            'id_fakultas' => $request->id_fakultas,
            'id_jurusan' => $request->id_jurusan,
            'id_prodi' => $request->id_prodi,
            'id_semester' => $request->id_semester,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'jumlah_sks_lulus' => $request->jumlah_sks_lulus,
            'jumlah_sks_wajib' => $request->jumlah_sks_wajib,
            'jumlah_sks_pilihan' => $request->jumlah_sks_pilihan

        ]);
        return redirect()->route('pegawai.kurikulum.index')->with('sukses', 'Data Berhasil Ditambahkan');

    }

    public function jurusan(Request $request, $id){
        $jurusan = Jurusan::where('id_fakultas', $id)->orderBy('nama_jurusan')->pluck('id', 'nama_jurusan');
        return json_encode($jurusan);
    }

    public function prodi(Request $request, $id){
        $prodi = Prodi::where('id_jurusan', $id)->orderBy('nama_program_studi')->pluck('id_prodi', 'nama_program_studi');
        return json_encode($prodi);
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('update-kurikulum')) {
            abort(403, 'User does not have the right permissions.');
        }
        $this->validate($request, [
            'nama_kurikulum' => 'required',
            'jumlah_sks_lulus' => 'required',
            'jumlah_sks_wajib' => 'required',
            'jumlah_sks_pilihan' => 'required'
        ]);

        $kurikulum = Kurikulum::where('id',$id);
        $kurikulum->update([
            'nama_kurikulum' => $request->nama_kurikulum,
            'id_fakultas' => $request->id_fakultas,
            'id_jurusan' => $request->id_jurusan,
            'id_prodi' => $request->id_prodi,
            'id_semester' => $request->id_semester,
            'id_tahun_ajaran' => $request->id_tahun_ajaran,
            'jumlah_sks_lulus' => $request->jumlah_sks_lulus,
            'jumlah_sks_wajib' => $request->jumlah_sks_wajib,
            'jumlah_sks_pilihan' => $request->jumlah_sks_pilihan
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        if (Gate::denies('delete-kurikulum')) {
            abort(403, 'User does not have the right permissions.');
        }
        $kurikulum = Kurikulum::where('id',$id);

        $kurikulum->delete();

        return redirect()->route('pegawai.kurikulum.index')->with('sukses', 'Data Berhasil Dihapus');

    }
}
