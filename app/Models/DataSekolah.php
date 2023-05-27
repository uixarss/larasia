<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSekolah extends Model
{
    protected $table ='data_sekolah';
    protected $fillable = ['nama_sekolah','alamat_sekolah','no_phone','logo','latitude','longitude'];
}
