<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use App\Models\TahunAjaranGuruKelas;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use TahunAjaranWaliKelas;
use Gate;

class KelasController extends Controller
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
        if (Gate::denies('view-kelas')) {
            abort(403, 'User does not have the right permissions.');
        }
        $tahun_ajaran = TahunAjaran::
            // where('status', true)
            where('start_date', '>', now())
            ->orWhere('end_date', '<', now())
            ->first();
        $data_wali_kelas = TahunAjaranGuruKelas::where('tahun_ajaran_id', $tahun_ajaran->id)
            ->get();

        $kelas = Kelas::orderBy('created_at', 'ASC')->get();;

        $data_guru = Guru::orderby('nama_lengkap', 'ASC')->get();

        return view('pegawai.kelas.index', [
            'kelas' => $kelas,
            'data_wali_kelas' => $data_wali_kelas,
            'data_guru' => $data_guru

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
        if (Gate::denies('create-kelas')) {
            abort(403, 'User does not have the right permissions.');
        }
        $this->validate($request, [
            'kode_kelas' => 'required|unique:kelas',
            'nama_kelas' => 'required',
            'kapasitas' => 'required',
            'jurusan' => 'required',
            'tingkat' => 'required',
            'guru_id' => 'required',
        ]);

        $kelas = Kelas::create([
            'kode_kelas' => $request->kode_kelas,
            'nama_kelas' => $request->nama_kelas,
            'kapasitas' => $request->kapasitas,
            'jurusan' => $request->jurusan,
            'tingkat' => $request->tingkat
        ]);
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        TahunAjaranGuruKelas::create([
            'tahun_ajaran_id' => $tahun_ajaran->id,
            'kelas_id' => $kelas->id,
            'guru_id' => $request->guru_id
        ]);

        return redirect()->route('pegawai.kelas.index')->with('sukses', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        if (Gate::denies('update-kelas')) {
            abort(403, 'User does not have the right permissions.');
        }
        // dd($request->all());
        // Kelas::update($request->all());

        $kelas = Kelas::find($id);

        $kelas->update([
            'kode_kelas' => $request->kode_kelas,
            'nama_kelas' => $request->nama_kelas,
            'kapasitas' => $request->kapasitas,
            'jurusan' => $request->jurusan,
            'tingkat' => $request->tingkat
        ]);
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();

        $wali_kelas = TahunAjaranGuruKelas::where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('kelas_id', $id)->first();

        if ($wali_kelas != null) {
            $wali_kelas->update(['guru_id' => $request->guru_id]);
        } else {
            TahunAjaranGuruKelas::create([
                'tahun_ajaran_id' => $tahun_ajaran->id,
                'kelas_id' => $id,
                'guru_id' => $request->guru_id
            ]);
        }




        return redirect()->route('pegawai.kelas.index')->with('sukses', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('delete-kelas')) {
            abort(403, 'User does not have the right permissions.');
        }
        $kelas = Kelas::find($id);

        $tahun_ajaran = TahunAjaran::where('status', '1')->first();

        $wali_kelas = TahunAjaranGuruKelas::where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('kelas_id', $id)->first();

        $wali_kelas->delete($wali_kelas);
        $kelas->delete($kelas);





        return redirect()->route('pegawai.kelas.index')->with('sukses', 'Data Berhasil Dihapus');
    }
}
