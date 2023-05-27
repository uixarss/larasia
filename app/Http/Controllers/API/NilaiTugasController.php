<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Pengampu;
use App\Models\Mahasiswa;
use App\Models\Jadwal;
use App\Models\Tugas;
use App\Models\NilaiTugas;
use App\Models\HasilTugas;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class NilaiTugasController extends Controller
{
    public function getMatkul()
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();

        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first();
        // dd($tahun_ajaran);

        $mapel = Pengampu::where('id_dosen', $dosen->id)
                ->where('id_tahun_ajaran', $tahun_ajaran->id)
                ->where('id_semester', $semester->id)
                ->with('mapel', 'tahunajaran', 'semester', 'prodi')
                ->get();
       
        return response()->json($mapel);
    }

    public function getKelas(Request $request)
    {
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first(); 

        $dosen = Dosen::where('user_id', '=', Auth::id())->first();
        $kelas = Jadwal::where('id_dosen', $dosen->id)
            ->where('tahun_ajaran_id', $tahun_ajaran->id)
            ->where('semester_id', $semester->id)
            ->where('mapel_id', $request->mapel_id)
            ->select('kelas_id')
            ->with('kelas')
            ->distinct()
            ->get();
        
        return response()->json($kelas);
    }

    public function getTugas(Request $request)
    {
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first(); 

        $data_tugas = Tugas::join('tugas_kelas', 'tugas.id', '=', 'tugas_kelas.tugas_id')
                ->where('tugas_kelas.kelas_id', $request->id_kelas)
                ->where('id_tahun_ajaran', $tahun_ajaran->id)
                ->where('id_semester', $semester->id)
                ->get();

        return response()->json($data_tugas);
    }

    public function getMahasiswa(Request $request)
    {
        $data = [];
        $tahun_ajaran = TahunAjaran::where('status', '1')->first();
        $semester = Semester::where('status', '1')->first(); 
        $data_mahasiswa = Mahasiswa::where('kelas_id', $request->id_kelas)
                                // ->where('id_tahun_ajaran', $tahun_ajaran->id)
                                // ->select('mahasiswa.id','mahasiswa.nama_mahasiswa')
                                ->get('id');

                                // dd($data_mahasiswa); 

        $result = NilaiTugas::whereIn('mahasiswa_id', $data_mahasiswa)->get();
        // dd($result);

        foreach ($data_mahasiswa as $mahasiswa ) {
            $mhs = Mahasiswa::find($mahasiswa->id);
            if ($result->where('tugas_id', $request->tugas_id)->where('mahasiswa_id',$mhs->id)->count() > 0) {
                $nilai = NilaiTugas::where('tugas_id', $request->tugas_id)->where('mahasiswa_id',$mhs->id)->first();
                $data2 = [
                    'id_mahasiswa' => $mhs->id,
                    'nama_mahasiswa' => $mhs->nama_mahasiswa,
                    'nilai' => $nilai->nilai_tugas
                ];
                array_push($data, $data2);
            } else {
                $data2 = [
                    'id_mahasiswa' => $mhs->id,
                    'nama_mahasiswa' => $mhs->nama_mahasiswa,
                    'nilai' => 'Belum Dinilai'
                ];
                array_push($data, $data2);
            }
        }

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $nilai = NilaiTugas::create([
            'mahasiswa_id' => $request->mahasiswa_id,
            'dosen_id' => $dosen->id,
            'tugas_id' => $request->tugas_id,
            'nilai_tugas' => $request->nilai_tugas,
            'created_by' => Auth::id()
        ]);

        
        return response()->json("Berhasil DiSimpan");
    }

    public function update(Request $request)
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();
        $nilai = NilaiTugas::where('mahasiswa_id', $request->mahasiswa_id)
        ->where('tugas_id', $request->tugas_id)
        ->where('dosen_id', $dosen->id)
        ->first();

        $nilai->update([
        'nilai_tugas' => $request->nilai_tugas,
        'created_by' => Auth::id()
        ]);

        
        return response()->json("Berhasil DiUbah");
    }
}
