<?php

namespace App\Http\Controllers\Siswa;

use App\DataTugas;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadTugasRequest;
use App\Models\Siswa;
use App\Models\KelasMahasiswa;
use App\Models\Mahasiswa;
use App\Models\Tugas;
use App\Models\TahunAjaran;
use App\Models\Semester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\KrsMahasiswaEkstensi;

class DataTugasController extends Controller
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
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        if ($tahun_ajaran == null || $semester == null) {
            abort(403, 'Tahun Ajaran tidak ada yang aktif!');
        }
        $data_ekstensi = KrsMahasiswaEkstensi::where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->where('mahasiswa_id', $mahasiswa->id)->get();
        $data_tugas = Tugas::orderBy('tanggal_akhir', 'DESC')
            ->where('id_tahun_ajaran', $tahun_ajaran->id)
            ->where('id_semester', $semester->id)->get();
        $data_upload_tugas = DB::table('tugas_upload_siswa')->where('siswa_id', $mahasiswa->id)->get();

        return view('siswa.datatugas.index', [
            'data_tugas' => $data_tugas,
            'mahasiswa' => $mahasiswa,
            'data_upload_tugas' => $data_upload_tugas,
            'data_ekstensi' => $data_ekstensi
        ]);
    }

    public function upload($id, UploadTugasRequest $request)
    {
        $siswa = Mahasiswa::where('user_id', Auth::id())->first();

        // $this->validate($request, [
        //     'file_tugas' => 'required|max:2000|mimes:doc,pdf,docx'
        // ]);
        
        $dataTugas = Tugas::find($id);

        if ($dataTugas->tanggal_akhir > date('Y-m-d H:i:s')) {
            if ($request->hasFile('file_tugas')) {
                $filenameWithExt = $request->file('file_tugas')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $filename = str_replace(' ', '_', $filename);
                $extension = $request->file('file_tugas')->getClientOriginalExtension();
                $filenameSimpan = $siswa->nim . '_' . $filename . '.' . $extension;
                $file_simpan = Storage::putFileAs('public/upload/tugas', $request->file('file_tugas'), $filenameSimpan);
    
                $data_upload = DB::table('tugas_upload_siswa')->insert([
                    'tugas_id' => $id,
                    'siswa_id' => $siswa->id,
                    'nama_file_tugas' => $filenameSimpan,
                    'lokasi_file_tugas' => $file_simpan,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            } else {
                $data_upload = DB::table('tugas_upload_siswa')->insert([
                    'tugas_id' => $id,
                    'siswa_id' => $siswa->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
    
            return redirect()->route('siswa.datatugas.index');
        } else {
            return redirect()->back()->with([
               'error'  => 'Sudah lewat dari deadline!'
            ]);
        }

        
    }

    public function unduh($id, Request $request)
    {
        Tugas::find($id);

        return redirect()->route('download.tugas', ['path_tugas' => $request->path_tugas]);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\DataTugas  $dataTugas
     * @return \Illuminate\Http\Response
     */
    public function show(DataTugas $dataTugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataTugas  $dataTugas
     * @return \Illuminate\Http\Response
     */
    public function edit(DataTugas $dataTugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataTugas  $dataTugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataTugas $dataTugas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataTugas  $dataTugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataTugas $dataTugas)
    {
        //
    }
}
