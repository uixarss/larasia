<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangans';
    protected $fillable = [
        'kode_ruangan',
        'nama_ruangan',
        'kondisi_ruangan'
    ];

}
