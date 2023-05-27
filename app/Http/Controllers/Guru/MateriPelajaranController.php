<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\DosenInputRppRequest;
use App\Http\Requests\DosenUploadMateriRequest;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MateriPelajaran;
use App\Models\Rpp;
use App\Models\Dosen;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Jadwal;
use App\Models\Pengampu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class MateriPelajaranController extends Controller
{
    public function __construct()
    {
      $this ->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (Gate::denies('view-materi-pelajaran')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $data_kelas = Kelas::all();
        $data_rpp = Rpp::where('created_by', Auth::id())->get();
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $data_materi_pelajaran = MateriPelajaran::where('created_by', $dosen->id)->get();

        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first(); 
        if($tahun_ajaran == null || $semester == null){
            abort(404);
        }

        $data_mapel = Pengampu::join('mapel', 'pengampu.mapel_id','=','mapel.id')
                ->where('id_dosen', $dosen->id)->groupBy('nama_mapel')
                ->where('id_tahun_ajaran', $tahun_ajaran->id)
                ->where('id_semester', $semester->id)->get();

        // dd($data_materi_pelajaran);
        $jumlah = count($data_materi_pelajaran);
        return view('guru.materipelajaran.index', [
            'data_mapel' => $data_mapel,
            'data_kelas' => $data_kelas,
            'data_rpp' => $data_rpp,
            'data_materi_pelajaran' => $data_materi_pelajaran,
            'jumlah' => $jumlah
        ]);
    }

    /**
     * Store RPP
     * 
     */

    public function storeRpp(DosenInputRppRequest $request)
    {
        // if (Gate::denies('create-materi-pelajaran')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $this->validate($request, [
            'id_rpp' => 'required',
            'bab' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required'
        ]);

        Rpp::create([
            'id_rpp' => $request->id_rpp,
            'bab' => $request->bab,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'created_by' => Auth::id()
        ]);

        return redirect()->route('guru.materipelajaran.index');
    }

    /**
     * Update RPP
     * 
     */
    public function updateRpp(DosenInputRppRequest $request, $id)
    {
        // if (update::denies('view-materi-pelajaran')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $this->validate($request, [
            'id_rpp' => 'required',
            'bab' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required'
        ]);

        $rpp = Rpp::find($id);

        $rpp->update([
            'id_rpp' => $request->id_rpp,
            'bab' => $request->bab,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'created_by' => Auth::id()
        ]);
        return redirect()->route('guru.materipelajaran.index');
    }

    /**
     * Destroy RPP
     * 
     */

    public function destroyRpp($id)
    {
        // if (Gate::denies('delete-materi-pelajaran')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $rpp = Rpp::find($id);
        $rpp->delete($rpp);

        return redirect()->route('guru.materipelajaran.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DosenUploadMateriRequest $request)
    {
        //
        // if (Gate::denies('create-materi-pelajaran')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $guru = Dosen::where('user_id', Auth::id())->first();

        $this->validate($request, [

            'bab_materi' => 'required',
            'nama_materi' => 'required',
            'deskripsi_materi' => 'required',
            'file_materi' => 'required|max:2000|mimes:doc,pdf,docx'
        ]);

        if ($request->hasFile('file_materi')) {
            $filenameWithExt = $request->file('file_materi')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = str_replace(' ', '_', $filename);
            $extension = $request->file('file_materi')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            Storage::putFileAs('public/dokumen', $request->file('file_materi'), $filenameSimpan);

            $materi = MateriPelajaran::create([
                'id_prodi' => $request->id_prodi,
                'id_semester' => $request->id_semester,
                'id_tahun_ajaran' => $request->id_tahun_ajaran,
                'mapel_id' => $request->mapel_id,
                'bab_materi' => $request->bab_materi,
                'nama_materi' => $request->nama_materi,
                'deskripsi_materi' => $request->deskripsi_materi,
                'file_materi' => $filenameSimpan,
                'jumlah_unduh' => 0,
                'created_by' => $guru->id
            ]);
            $materi->kelas()->attach($request->id_kelas);
        } else {
            $materi = MateriPelajaran::create([
                'id_prodi' => $request->id_prodi,
                'id_semester' => $request->id_semester,
                'id_tahun_ajaran' => $request->id_tahun_ajaran,
                'mapel_id' => $request->mapel_id,
                'bab_materi' => $request->bab_materi,
                'nama_materi' => $request->nama_materi,
                'deskripsi_materi' => $request->deskripsi_materi,
                'jumlah_unduh' => 0,
                'created_by' => $guru->id
            ]);
            $materi->kelas()->attach($request->id_kelas);
        }

        return redirect()->route('guru.materipelajaran.index');
    }

    public function updateMateri(Request $request, $id)
    {
        $this->validate($request, [

            'bab_materi' => 'required',
            'nama_materi' => 'required',
            'deskripsi_materi' => 'required'
        ]);
        $materi = MateriPelajaran::find($id);
        $dosen = Dosen::where('user_id', Auth::id())->first();
        // dd($dosen);

        if ($request->hasFile('file_materi')) {
            $this->validate($request, [
                'file_materi' => 'max:2000|mimes:doc,pdf,docx'
            ]);
            if ($materi->file_materi != null) {
                Storage::delete('public/dokumen/' . $materi->file_materi);
            }
            $filenameWithExt = $request->file('file_materi')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = str_replace(' ', '_', $filename);
            $extension = $request->file('file_materi')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            Storage::putFileAs('public/dokumen', $request->file('file_materi'), $filenameSimpan);
            
            $materi->update([
                'id_prodi' => $request->id_prodi,
                'id_semester' => $request->id_semester,
                'id_tahun_ajaran' => $request->id_tahun_ajaran,
                'mapel_id' => $request->mapel_id,
                'bab_materi' => $request->bab_materi,
                'nama_materi' => $request->nama_materi,
                'deskripsi_materi' => $request->deskripsi_materi,
                'file_materi' => $filenameSimpan,
                'jumlah_unduh' => 0,
                'created_by' => $dosen->id
            ]);
            $materi->kelas()->sync($request->id_kelas);
        
        }else{
            $materi->update([
                'id_prodi' => $request->id_prodi,
                'id_semester' => $request->id_semester,
                'id_tahun_ajaran' => $request->id_tahun_ajaran,
                'mapel_id' => $request->mapel_id,
                'bab_materi' => $request->bab_materi,
                'nama_materi' => $request->nama_materi,
                'deskripsi_materi' => $request->deskripsi_materi,
                'jumlah_unduh' => 0,
                'created_by' => $dosen->id
            ]);
            
            $materi->kelas()->sync($request->id_kelas);
        }
        
        return redirect()->route('guru.materipelajaran.index');
    }

    /**
     * Download file materi pelajaran
     * 
     */

    public function download($id, Request $request)
    {
        $dokumen = MateriPelajaran::find($id);

        $dokumen->increment('jumlah_unduh');
        
        return redirect()->route('download.dokumen', ['path' => $request->path]);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (Gate::denies('delete-materi-pelajaran')) {
        //     abort(403, 'User does not have the right permissions.');
        // }
        $dokumen = MateriPelajaran::find($id);

        if ($dokumen->file_materi != null) {
            Storage::delete('public/dokumen/' . $dokumen->file_materi);
        }

        $dokumen->delete($dokumen);


        return redirect()->route('guru.materipelajaran.index');
    }

    public function prodi(Request $request, $id){
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $prodi = Pengampu::join('prodi', 'pengampu.id_prodi','=','prodi.id_prodi')
        ->where('mapel_id', $id)->where('id_dosen', $dosen->id)
        ->groupBy('nama_program_studi')->pluck('prodi.id_prodi','nama_program_studi');
        return json_encode($prodi);
    }

    public function semester(Request $request, $id, $prodi){
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $semester = Pengampu::join('semesters', 'pengampu.id_semester','=','semesters.id')
        ->where('mapel_id', $id)->where('id_dosen', $dosen->id)->where('id_prodi', $prodi)
        ->groupBy('id_semester')->pluck('semesters.id','nama_semester');
        return json_encode($semester);
    }

    public function tahunAjaran(Request $request, $id, $prodi, $semester){
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $tahun_ajaran = Pengampu::join('tahun_ajarans', 'pengampu.id_tahun_ajaran','=','tahun_ajarans.id')
        ->where('mapel_id', $id)->where('id_dosen', $dosen->id)->where('id_prodi', $prodi)->where('id_Semester', $semester)
        ->groupBy('id_tahun_ajaran')->pluck('tahun_ajarans.id','nama_tahun_ajaran');
        return json_encode($tahun_ajaran);
    }

    public function kelas(Request $request, $mapel_id){
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first(); 
        if($tahun_ajaran == null || $semester == null){
        abort(404);
        }
        $guru = Dosen::where('user_id', '=', Auth::id())->first();
        $data_jadwal = Kelas::join('jadwals', 'kelas.id', '=', 'jadwals.kelas_id')
            ->where('id_dosen', $guru->id)
            ->where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->where('mapel_id', $mapel_id)
            // ->select('kelas_id')
            // ->with('kelas')
            // ->distinct()
            // ->get()
            ->pluck('kelas_id','nama_kelas');
        
            
        return json_encode($data_jadwal);
    }
}
