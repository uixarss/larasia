<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catatan extends Model
{
    //

    protected $fillable = ['judul_catatan','tanggal_catatan','isi_catatan','created_by'];
}
