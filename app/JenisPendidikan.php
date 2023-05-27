<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPendidikan extends Model
{
    protected $table ='jenis_pendidikan';

    protected $fillable = ['id','jenis_pendidikan'];
}
