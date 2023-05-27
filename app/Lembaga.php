<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    protected $table ='lembaga';

    protected $fillable = ['id','nama_lembaga'];
}
