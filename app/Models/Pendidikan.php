<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    //
    protected $fillable = [
        'pendidikanable_id',
        'pendidikanable_type',
        'tingkat',
        'nama_pendidikan',
        'tahun_lulus',
        'status',
        'surat_keputusan',
        'keterangan'
    ];

    public function pendidikanable()
    {
        return $this->morphTo();
    }

}
