<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenjang extends Model
{
    protected $table ='jenjang';

    protected $fillable = ['id','nama_jenjang', 'keterangan'];
}
