<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalUjian extends Model
{
    //
    protected $table = 'jadwal_ujians';
    protected $fillable = [
        'title',
        'year',
        'created_by'
    ];

    public function tahunajaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

}
