<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $table = 'fakultas';
    protected $fillable = ['id', 'kode_fakultas', 'nama_fakultas'];

    public function visis()
    {
        return $this->morphMany('App\Models\Visi', 'visiable');
    }

    public function misis()
    {
        return $this->morphMany('App\Models\Misi', 'misiable');
    }
}
