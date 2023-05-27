<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MataPelajaran;

class PaketKrs extends Model
{
    //
    protected $table = 'paket_krs';

    protected $fillable = [
        'id_fakultas', 'id_jurusan', 'id_prodi', 'mapel_id', 'tingkat_semester'
    ];

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class,'mapel_id','id');
    }
}
