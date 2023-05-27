<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Hari;
use App\Models\Prodi;
class AbsensiDosenSP extends Model
{
    protected $table = 'absensi_dosen_sp';
    protected $fillable = [
        'id_tahun_ajaran', 'id_semester', 'id_dosen',
         'mapel_id', 'hari_id', 'id_prodi', 'waktu_id',
        'pertemuan_ke','tanggal_masuk','jam_masuk','jam_keluar',
        'status', 'keterangan','long','lat', 'ip_address', 'user_agent'
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

    public function dosen()
    {
        return $this->belongsTo(Dosen::class,'id_dosen');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function waktu()
    {
        return $this->belongsTo(Waktu::class);
    }

    public function hari()
    {
        return $this->belongsTo(Hari::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class,'id_ruangan', 'id');
    }
}
