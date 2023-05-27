<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadEBook extends Model
{
    protected $table = 'data_download_ebook';
    protected $fillable = [
        'id_ebook',
        'id_mahasiswa'
    ];
}
