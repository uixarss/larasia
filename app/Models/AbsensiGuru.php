<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Guru;

class AbsensiGuru extends Model
{
    //
    protected $table = 'absensi_gurus';
    protected $fillable = [
        'guru_id',
        'tanggal_absen',
        'jam_masuk',
        'jam_pulang',
        'keterangan'
    ];
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
