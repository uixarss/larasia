<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\Prodi;

class KrsMahasiswaEkstensi extends Model
{
    protected $fillable = [
        'tahun_ajaran_id', 'semester_id',
        'mahasiswa_id', 'id_dosen', 'mapel_id',
        'kelas_id', 'prodi_id', 'tingkat_semester', 'status'
    ];

    public function tahun()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id', 'id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_id', 'id');
    }
}
