<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kkm extends Model
{
    protected $table ='kkms';

    protected $fillable = [
        'mapel_id',
        'nilai'
    ];

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class,'mapel_id');
    }

}
