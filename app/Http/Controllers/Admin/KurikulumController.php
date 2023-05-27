<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Kurikulum;
use App\Models\KurikulumDetail;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\MataPelajaran;
use App\Models\Prodi;
use App\Models\Semester;
use App\Models\TahunAjaran;

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

        return view('admin.kurikulum.index',
            ['kurikulum' => $kurikulum,
            'fakultas' => $fakultas,
            'semester' => $semester,
            'jumlah' => $jumlah,
            'tahun_ajaran' => $tahun_ajaran]);
    }

    public function create(Request $request){

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
        return redirect()->route('admin.kurikulum.index')->with('sukses', 'Data Berhasil Ditambahkan');

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
        
        $kurikulum = Kurikulum::where('id',$id);

        $kurikulum->delete();

        return redirect()->route('admin.kurikulum.index')->with('sukses', 'Data Berhasil Dihapus');

    }

    public function detail($id)
    {
        $kurikulum = Kurikulum::find($id);

        $kurikulum_detail = KurikulumDetail::where('kurikulum_id', $id)->get();
        $data_dosen = Dosen::all();
        $data_mapel = MataPelajaran::all();

        return view('admin.kurikulum.detail',[
            'kurikulum' => $kurikulum,
            'kurikulum_detail' => $kurikulum_detail,
            'data_dosen' => $data_dosen,
            'data_mapel' => $data_mapel
        ]);
    }

    public function addDetail(Request $request, $id)
    {
        KurikulumDetail::create([
            'kurikulum_id' => $id,
            'dosen_id' => $request->dosen_id,
            'mapel_id' => $request->mapel_id
        ]);

        return redirect()->back()->with([
            'success' => 'Berhasil menambah kurikulum detail terbaru'
        ]);
    }

    public function updateDetail(Request $request, $id)
    {
        $kurikulum_detail = KurikulumDetail::find($id);
        $kurikulum_detail->update([
            'dosen_id' => $request->dosen_id,
            'mapel_id' => $request->mapel_id
        ]);

        return redirect()->back()->with([
            'success' => 'Berhasil mengubah kurikulum detail ' . $kurikulum_detail->dosen->nama_dosen
        ]);
    }

    public function destroyDetail($id)
    {
        $kurikulum_detail = KurikulumDetail::find($id);
        $kurikulum_detail->delete();
        
        return redirect()->back()->with([
            'success' => 'Berhasil menghapus kurikulum detail ' . $kurikulum_detail->dosen->nama_dosen
        ]);
    }
}
