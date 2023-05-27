<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    //
    protected $table = 'absensis';

    protected $fillable = [
        'absensiable_id',
        'absensiable_type',
        'tanggal_absen',
        'jam_masuk',
        'jam_pulang',
        'keterangan'
    ];
    public function absensiable()
    {
        return $this->morphTo();
    }


}
