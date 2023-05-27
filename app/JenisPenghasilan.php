<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPenghasilan extends Model
{
    protected $table ='jenis_penghasilan';

    protected $fillable = ['id','jenis_penghasilan'];
}
