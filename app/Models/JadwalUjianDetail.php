<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalUjianDetail extends Model
{
    //
    protected $fillable = [
        'jadwal_ujians_id',
        'nama_ruangan',
        'mapel_id',
        'kelas_id',
        'tanggal_ujian'
    ];

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

}
