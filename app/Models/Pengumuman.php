<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    //
    protected $fillable = [
        'judul_pengumuman',
        'isi_pengumuman',
        'tanggal_pengumuman'
    ];
}
