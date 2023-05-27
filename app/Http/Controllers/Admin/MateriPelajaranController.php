<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Dosen;
use App\Models\Pengampu;
use App\Models\MateriPelajaran;
use App\Models\Kelas;
use App\Models\Quiz;
use App\Models\Rpp;
use App\Models\Tugas;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class MateriPelajaranController extends Controller
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
        $data_guru = Pengampu::all();

        return view('admin.materipelajaran.index',[
            'data_guru' => $data_guru
        ]);
    }


    // Buat Detail Materi Pelajaran
    public function detailmateri()
    {
        return view('admin.materipelajaran.detailmateri');
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
    public function store(Request $request, $id, $matkul, $id_prodi, $semester, $tahun_ajaran)
    {
        $guru = Dosen::where('id', $id)->first();

        $this->validate($request, [

            'bab_materi' => 'required',
            'nama_materi' => 'required',
            'deskripsi_materi' => 'required',
            'file_materi' => 'required|file|max:2000|mimes:doc,pdf,docx'
        ]);

        if ($request->hasFile('file_materi')) {
            $filenameWithExt = $request->file('file_materi')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = str_replace(' ', '_', $filename);
            $extension = $request->file('file_materi')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            Storage::putFileAs('public/dokumen', $request->file('file_materi'), $filenameSimpan);

            $materi = MateriPelajaran::create([
                'id_prodi' => $id_prodi,
                'id_semester' => $semester,
                'id_tahun_ajaran' => $tahun_ajaran,
                'mapel_id' => $matkul,
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
                'id_prodi' => $id_prodi,
                'id_semester' => $semester,
                'id_tahun_ajaran' => $tahun_ajaran,
                'mapel_id' => $matkul,
                'bab_materi' => $request->bab_materi,
                'nama_materi' => $request->nama_materi,
                'deskripsi_materi' => $request->deskripsi_materi,
                'jumlah_unduh' => 0,
                'created_by' => $guru->id
            ]);
            $materi->kelas()->attach($request->id_kelas);
        }

        return redirect()->route('admin.materipelajaran.show', [ 'id' => $guru->id , 'mapel' => $matkul, 'id_prodi' => $id_prodi, 
        'semester'=> $semester, 'tahun_ajaran' => $tahun_ajaran]);
    }

    public function storeTugas(Request $request, $id, $matkul, $id_prodi, $semester, $tahun_ajaran)
    {
        $dosen = Dosen::where('id', $id)->first();

        $this->validate($request, [
            'kode_tugas' => 'required',
            'judul_tugas' => 'required',
            'deskripsi_tugas' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_akhir' => 'required',
            'id_kelas' => 'required'
        ]);

        if ($request->hasFile('file_tugas')) {
            $this->validate($request,[
                'file_tugas' => 'max:2000|mimes:doc,pdf,docx'
            ]);
            $filenameWithExt = $request->file('file_tugas')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = str_replace(' ', '_', $filename);
            $extension = $request->file('file_tugas')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $file_location = Storage::putFileAs('public/tugas', $request->file('file_tugas'), $filenameSimpan);

            $materi = Tugas::create([
                'id_prodi' => $id_prodi,
                'id_semester' => $semester,
                'id_tahun_ajaran' => $tahun_ajaran,
                'mapel_id' => $matkul,
                'kode_tugas' => $request->kode_tugas,
                'judul_tugas' => $request->judul_tugas,
                'deskripsi_tugas' => $request->deskripsi_tugas,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_akhir' => $request->tanggal_akhir,
                'nama_file_tugas' => $filenameSimpan,
                'lokasi_file_tugas' => $file_location,
                'created_by' => $dosen->id
            ]);
            $materi->kelas()->attach($request->id_kelas);
        } else {
            $materi = Tugas::create([
                'id_prodi' => $id_prodi,
                'id_semester' => $semester,
                'id_tahun_ajaran' => $tahun_ajaran,
                'mapel_id' => $matkul,
                'kode_tugas' => $request->kode_tugas,
                'judul_tugas' => $request->judul_tugas,
                'deskripsi_tugas' => $request->deskripsi_tugas,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_akhir' => $request->tanggal_akhir,
                'created_by' => $dosen->id
            ]);
            $materi->kelas()->attach($request->id_kelas);
        }

        return redirect()->route('admin.materipelajaran.show', [ 'id' => $dosen->id , 'mapel' => $matkul, 'id_prodi' => $id_prodi, 
        'semester'=> $semester, 'tahun_ajaran' => $tahun_ajaran]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MateriPelajaran  $materiPelajaran
     * @return \Illuminate\Http\Response
     */
    public function show($id, $matkul, $id_prodi, $semester, $tahun_ajaran)
    {
        $guru = Dosen::find($id);
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first(); 
        
        if($tahun_ajaran == null || $semester == null){
            abort(403, 'Tahun Ajaran atau Semester Tidak Aktif');
        }

        $data_kelas = Kelas::join('jadwals', 'kelas.id', '=', 'jadwals.kelas_id')
        ->where('id_dosen', $guru->id)
        ->where('tahun_ajaran_id', $tahun_ajaran->id)
        ->where('semester_id', $semester->id)
        ->where('mapel_id', $matkul)
        ->groupBy('kelas.id')
        // ->select('kelas_id')
        // ->with('kelas')
        // ->distinct()
        ->get();

        $data_rpp = Rpp::where('created_by', $guru->user_id)->get();
        $data_tugas = Tugas::where('created_by', $guru->id)
                    ->where('mapel_id',$matkul)->get();
        
        $data_materi_pelajaran = MateriPelajaran::where('created_by', $guru->id)
            ->where('mapel_id', $matkul)
            ->where('id_prodi', $id_prodi)
            ->where('id_semester', $semester->id)
            ->where('id_tahun_ajaran', $tahun_ajaran->id)
            ->get();

        $data_quiz = Quiz::where('id_dosen', $guru->id)
            ->where('mapel_id', $matkul)
            ->where('id_prodi', $id_prodi)
            ->where('id_semester', $semester->id)
            ->where('id_tahun_ajaran', $tahun_ajaran->id)
            ->where('jenisujian_id',1)->get();

        return view('admin.materipelajaran.detailmateri',[
            'id_dosen' => $guru->id,
            'mapel_id' => $matkul,
            'id_prodi' => $id_prodi,
            'semester' => $semester,
            'tahun_ajaran' => $tahun_ajaran,
            'data_kelas' => $data_kelas,
            'data_materi_pelajaran' => $data_materi_pelajaran,
            'data_rpp' => $data_rpp,
            'data_tugas' => $data_tugas,
            'data_quiz' => $data_quiz
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MateriPelajaran  $materiPelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit(MateriPelajaran $materiPelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MateriPelajaran  $materiPelajaran
     * @return \Illuminate\Http\Response
     */
    public function updateMateri(Request $request, $id, $id_dosen)
    {
        $this->validate($request, [

            'bab_materi' => 'required',
            'nama_materi' => 'required',
            'deskripsi_materi' => 'required'
        ]);
        $dosen = Dosen::find($id_dosen);
        $materi = MateriPelajaran::find($id);
        // dd($materi->mapel);

        if ($request->hasFile('file_materi')) {
            $this->validate($request,[
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
                'bab_materi' => $request->bab_materi,
                'nama_materi' => $request->nama_materi,
                'deskripsi_materi' => $request->deskripsi_materi,
                'jumlah_unduh' => 0,
                'created_by' => $dosen->id
            ]);
            
            $materi->kelas()->sync($request->id_kelas);
        }
        
        return redirect()->route('admin.materipelajaran.show', [ 'id' => $dosen->id , 'mapel' => $materi->mapel->id, 'id_prodi' => $materi->prodi->id_prodi, 
        'semester'=> $materi->semester->id, 'tahun_ajaran' => $materi->tahunAjaran->id]);
    }

    public function updateTugas(Request $request, $id, $id_dosen)
    {
        $this->validate($request, [
        'kode_tugas' => 'required',
        'judul_tugas' => 'required',
        'deskripsi_tugas' => 'required',
        'tanggal_mulai' => 'required',
        'tanggal_akhir' => 'required',
        'id_kelas' => 'required'
        ]);
        $tugas = Tugas::find($id);
        $dosen = Dosen::where('id', $id_dosen)->first();
        // dd($dosen);

        if ($request->hasFile('file_tugas')) {
            $this->validate($request, [
                'file_tugas' => 'max:2000|mimes:doc,pdf,docx'
            ]);
            if ($tugas->nama_file_tugas != null) {
                Storage::delete('public/tugas/' . $tugas->nama_file_tugas);
            }
            $filenameWithExt = $request->file('file_tugas')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = str_replace(' ', '_', $filename);
            $extension = $request->file('file_tugas')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $file_location = Storage::putFileAs('public/tugas', $request->file('file_tugas'), $filenameSimpan);
            
            $tugas->update([
            'kode_tugas' => $request->kode_tugas,
            'judul_tugas' => $request->judul_tugas,
            'deskripsi_tugas' => $request->deskripsi_tugas,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_akhir' => $request->tanggal_akhir,
            'nama_file_tugas' => $filenameSimpan,
            'lokasi_file_tugas' => $file_location,
            'created_by' => $dosen->id
            ]);
            $tugas->kelas()->sync($request->id_kelas);
        
        }else{
            $tugas->update([
            'kode_tugas' => $request->kode_tugas,
            'judul_tugas' => $request->judul_tugas,
            'deskripsi_tugas' => $request->deskripsi_tugas,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_akhir' => $request->tanggal_akhir,
            'created_by' => $dosen->id
            ]);      
            $tugas->kelas()->sync($request->id_kelas);
        }

        return redirect()->route('admin.materipelajaran.show', [ 'id' => $dosen->id , 'mapel' => $tugas->mapel->id, 'id_prodi' => $tugas->prodi->id_prodi, 
        'semester'=> $tugas->semester->id, 'tahun_ajaran' => $tugas->tahunAjaran->id]);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MateriPelajaran  $materiPelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dokumen = MateriPelajaran::find($id);


        if ($dokumen->file_materi != null) {
            Storage::delete('public/dokumen/' . $dokumen->file_materi);
        }

        $dokumen->delete($dokumen);


        return redirect()->route('admin.materipelajaran.show', [ 'id' => $dokumen->created_by , 'mapel' => $dokumen->mapel_id, 'id_prodi' => $dokumen->id_prodi, 
        'semester'=> $dokumen->id_semester, 'tahun_ajaran' => $dokumen->id_tahun_ajaran]);
    }


    public function tugasDestroy($id)
    {
        $dokumen = Tugas::find($id);


        if ($dokumen->nama_file_tugas != null) {
            Storage::delete('public/tugas/' . $dokumen->nama_file_tugas);
        }

        $dokumen->delete($dokumen);


        return redirect()->route('admin.materipelajaran.show', [ 'id' => $dokumen->created_by , 'mapel' => $dokumen->mapel_id, 'id_prodi' => $dokumen->id_prodi, 
        'semester'=> $dokumen->id_semester, 'tahun_ajaran' => $dokumen->id_tahun_ajaran]);
    }
}
