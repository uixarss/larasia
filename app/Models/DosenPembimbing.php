<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DosenPembimbing extends Model
{
    //
    protected $fillable = [
        'id_prodi', 'id_mahasiswa', 'id_dosen'
    ];
}
