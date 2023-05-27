<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Prodi;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Hari;
use App\Models\Waktu;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Dosen;
use App\Models\Ruangan;

class JadwalSP extends Model

{
    protected $table = 'jadwal_sp';
    protected $fillable = [
        'mapel_id',
        'id_dosen',
        'hari_id',
        'waktu_id',
        'tahun_ajaran_id',
        'semester_id',
        'keterangan',
        'type',
        'ruangan_id',
        'prodi_id'
    ];

    const BEGINNILAI = 1;
    const FRIDAY     = 5;

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id_prodi');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class,'mapel_id', 'id');
    }


    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id');
    }

    public function hari()
    {
        return $this->belongsTo(Hari::class);
    }

    public function waktu()
    {
        return $this->belongsTo(Waktu::class);
    }

    public function tahunajaran()
    {
        return $this->belongsTo(TahunAjaran::class,'tahun_ajaran_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class,'semester_id', 'id');
    }

    public function ruang()
    {
        return $this->belongsTo(Ruangan::class,'ruangan_id', 'id');
    }
}
