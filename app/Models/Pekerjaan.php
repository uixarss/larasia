<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    //
    protected $fillable = [
        'pekerjaanable_id',
        'pekerjaanable_type',
        'tahun_awal',
        'tahun_akhir',
        'tempat',
        'jabatan',
        'status',
        'keterangan'
    ];

    public function pekerjaanable()
    {
        return $this->morphTo();
    }

}
