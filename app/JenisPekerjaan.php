<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPekerjaan extends Model
{
    protected $table ='jenis_pekerjaan';

    protected $fillable = ['id','jenis_pekerjaan'];
}
