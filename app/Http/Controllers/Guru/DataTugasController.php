<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\DosenUploadTugasRequest;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Tugas;
use App\Models\Guru;
use App\Models\Pengampu;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

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
    // if (Gate::denies('view-tugas')) {
    //     abort(403, 'User does not have the right permissions.');
    // }
    $data_kelas = Kelas::all();
    $dosen = Dosen::where('user_id', Auth::id())->first();
    $tahun_ajaran = TahunAjaran::where('status', '1')->first();
    $semester = Semester::where('status', '1')->first();
    if ($tahun_ajaran == null || $semester == null) {
      abort(404);
    }
    $data_tugas = Tugas::where('created_by', $dosen->id)->get();
    $mapel = Pengampu::join('mapel', 'pengampu.mapel_id', '=', 'mapel.id')
      ->where('id_dosen', $dosen->id)->groupBy('nama_mapel')
      ->where('id_tahun_ajaran', $tahun_ajaran->id)
      ->where('id_semester', $semester->id)
      ->get();

    $jumlah = count($data_tugas);

    return view('guru.tugas.index', [
      'data_kelas' => $data_kelas,
      'data_tugas' => $data_tugas,
      'jenis_mapel' => $mapel,
      'jumlah' => $jumlah
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
  public function storeTugas(DosenUploadTugasRequest $request)
  {
    //   if (Gate::denies('create-tugas')) {
    //     abort(403, 'User does not have the right permissions.');
    // }
    $guru = Dosen::where('user_id', Auth::id())->first();

    // $this->validate($request, [
    //   'kode_tugas' => 'required',
    //   'judul_tugas' => 'required',
    //   'deskripsi_tugas' => 'required',
    //   'tanggal_mulai' => 'required',
    //   'tanggal_akhir' => 'required',
    //   'id_kelas' => 'required',
    //   'file_tugas' => 'required|max:2000|mimes:doc,pdf,docx'
    // ]);

    if ($request->hasFile('file_tugas')) {
      $filenameWithExt = $request->file('file_tugas')->getClientOriginalName();
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      $filename = str_replace(' ', '_', $filename);
      $extension = $request->file('file_tugas')->getClientOriginalExtension();
      $filenameSimpan = $filename . '_' . time() . '.' . $extension;
      $file_location = Storage::putFileAs('public/tugas', $request->file('file_tugas'), $filenameSimpan);

      $tugas = Tugas::create([
        'id_prodi' => $request->id_prodi,
        'id_semester' => $request->id_semester,
        'id_tahun_ajaran' => $request->id_tahun_ajaran,
        'mapel_id' => $request->mapel_id,
        'kode_tugas' => $request->kode_tugas,
        'judul_tugas' => $request->judul_tugas,
        'deskripsi_tugas' => $request->deskripsi_tugas,
        'tanggal_mulai' => $request->tanggal_mulai,
        'tanggal_akhir' => $request->tanggal_akhir,
        'nama_file_tugas' => $filenameSimpan,
        'lokasi_file_tugas' => $file_location,
        'created_by' => $guru->id
      ]);

      $tugas->kelas()->attach($request->id_kelas);
    } else {
      $tugas = Tugas::create([
        'id_prodi' => $request->id_prodi,
        'id_semester' => $request->id_semester,
        'id_tahun_ajaran' => $request->id_tahun_ajaran,
        'mapel_id' => $request->mapel_id,
        'kode_tugas' => $request->kode_tugas,
        'judul_tugas' => $request->judul_tugas,
        'deskripsi_tugas' => $request->deskripsi_tugas,
        'tanggal_mulai' => $request->tanggal_mulai,
        'tanggal_akhir' => $request->tanggal_akhir,
        'created_by' => $guru->id
      ]);
      $tugas->kelas()->attach($request->id_kelas);
    }

    return redirect()->route('guru.tugas.index');
  }


  public function unduh($id, Request $request)
  {
    Tugas::find($id);

    return redirect()->route('download.tugas', ['path_tugas' => $request->path_tugas]);
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
    $this->validate($request, [
      'kode_tugas' => 'required',
      'judul_tugas' => 'required',
      'deskripsi_tugas' => 'required',
      'tanggal_mulai' => 'required',
      'tanggal_akhir' => 'required',
      'id_kelas' => 'required'
    ]);
    

    try {
      DB::beginTransaction();
      $tugas = Tugas::find($id);
      $dosen = Dosen::where('user_id', Auth::id())->first();
    // dd($dosen);
      if ($request->hasFile('file_tugas')) {
        $this->validate($request, [
          'file_tugas' => 'max:2048|mimes:doc,pdf,docx'
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
          'id_prodi' => $request->id_prodi,
          'id_semester' => $request->id_semester,
          'id_tahun_ajaran' => $request->id_tahun_ajaran,
          'mapel_id' => $request->mapel_id,
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
      } else {
        $tugas->update([
          'id_prodi' => $request->id_prodi,
          'id_semester' => $request->id_semester,
          'id_tahun_ajaran' => $request->id_tahun_ajaran,
          'mapel_id' => $request->mapel_id,
          'kode_tugas' => $request->kode_tugas,
          'judul_tugas' => $request->judul_tugas,
          'deskripsi_tugas' => $request->deskripsi_tugas,
          'tanggal_mulai' => $request->tanggal_mulai,
          'tanggal_akhir' => $request->tanggal_akhir,
          'created_by' => $dosen->id
        ]);
        $tugas->kelas()->sync($request->id_kelas);
      }
      DB::commit();
      return redirect()->route('guru.tugas.index');
    } catch (\Exception $th) {
      DB::rollBack();
      return redirect()->back()
      // ->with(
      //   'error' => 'Ada kesalahan!'
      // )
      ;
    }

    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    // if (Gate::denies('delete-tugas')) {
    //   abort(403, 'User does not have the right permissions.');
    // }
    $dokumen = Tugas::find($id);

    if ($dokumen->nama_file_tugas != null) {
      Storage::delete('public/tugas/' . $dokumen->nama_file_tugas);
      $dokumen->delete($dokumen);

      return redirect()->route('guru.tugas.index');
    }

    return redirect()->route('guru.tugas.index');
  }
}
