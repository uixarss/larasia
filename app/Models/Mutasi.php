<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    //
    protected $fillable = [
        'mutasiable_id',
        'mutasiable_type',
        'id_fakultas',
        'id_jurusan',
        'id_prodi',
        'bagian',
        'jabatan',
        'tanggal_mutasi',
        'keterangan',
        'status'
    ];

    public function mutasiable()
    {
        return $this->morphTo();
    }

}
