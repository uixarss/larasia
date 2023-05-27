<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    //

    protected $fillable = [
        'gajiable_id',
        'gajiable_type',
        'tanggal',
        'jumlah_gaji',
        'status',
        'tanggal_kenaikan_gaji',
        'jumlah_kenaikan_gaji',
        'keterangan',
    ];

    public function gajiable()
    {
        return $this->morphTo();
    }
    
}
