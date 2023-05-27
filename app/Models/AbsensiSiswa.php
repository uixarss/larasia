<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\Kelas;

class AbsensiSiswa extends Model
{
    //
    protected $table = 'absensi_siswas';
    protected $fillable = [
        'siswa_id',
        'tanggal_absen',
        'jam_masuk',
        'jam_pulang',
        'keterangan'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->hasManyThrough(Kelas::class, Siswa::class);
    }
}
