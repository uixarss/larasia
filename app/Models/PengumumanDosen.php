<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengumumanDosen extends Model
{
    //
    protected $table = 'pengumuman_dosen';

    protected $fillable = [
        'id',
        'isi',
        'judul',
        'id_jadwal'
    ];
    public function absensiable()
    {
        return $this->morphTo();
    }


}
