<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPengganti extends Model
{
    protected $table = 'jadwal_penggantis';
    protected $fillable = [
        'mapel_id',
        'id_dosen',
        'kelas_id',
        'hari_id',
        'waktu_id',
        'tahun_ajaran_id',
        'semester_id',
        'keterangan',
        'tanggal_pengganti',
        'pertemuan_ke',
        'status',
        'ruangan_id',
        'prodi_id',
        'disetujui_oleh'
    ];

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
        return $this->belongsTo(MataPelajaran::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
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
        return $this->belongsTo(Semester::class);
    }

    public function ruang()
    {
        return $this->belongsTo(Ruangan::class,'ruangan_id', 'id');
    }
}
