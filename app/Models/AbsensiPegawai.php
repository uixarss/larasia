<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pegawai;

class AbsensiPegawai extends Model
{
    //
    protected $table = 'absensi_pegawais';
    protected $fillable = [
        'pegawai_id',
        'tanggal_absen',
        'jam_masuk',
        'jam_pulang',
        'keterangan'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    
}
