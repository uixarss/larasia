<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    //
    protected $fillable = [
        'sertifikatable_id',
        'sertifikatable_type',
        'sertifikasi',
        'lembaga',
        'tahun',
        'status',
        'keterangan'
    ];

    public function sertifikatable()
    {
        return $this->morphTo();
    }

}
