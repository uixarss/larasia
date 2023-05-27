<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Hari;
use App\Models\Prodi;

class AbsensiMahasiswa extends Model
{
    //
    protected $fillable = [
        'id_tahun_ajaran', 'id_semester', 'id_dosen', 'id_mahasiswa', 'tingkat_semester',
        'kelas_id', 'mapel_id', 'hari_id', 'id_prodi', 'waktu_id',
        'pertemuan_ke','tanggal_masuk', 'jam_masuk','jam_keluar',
        'status', 'keterangan','long','lat', 'ip_address', 'user_agent', 'id_jadwal'
    ];

    public function tahun()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function tahunajaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran', 'id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function semesters()
    {
        return $this->belongsTo(Semester::class, 'id_semester', 'id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class,'id_mahasiswa', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function waktu()
    {
        return $this->belongsTo(Waktu::class);
    }
    
    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function hari()
    {
        return $this->belongsTo(Hari::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id');
    }
}
