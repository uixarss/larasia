<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusans';
    protected $fillable = [
        'id_fakultas',
        'kode_jurusan',
        'nama_jurusan'
    ];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas', 'id');
    }

    public function visis()
    {
        return $this->morphMany('App\Models\Visi', 'visiable');
    }
    public function misis()
    {
        return $this->morphMany('App\Models\Misi', 'misiable');
    }
}
