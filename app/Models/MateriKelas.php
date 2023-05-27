<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MateriKelas extends Model
{
    protected $table = 'materi_kelas';
    protected $fillable = [
        'materi_pelajaran_id',
        'kelas_id',
    ];
}
