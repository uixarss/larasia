<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KalenderAkademik extends Model
{
    protected $table ='kalender_akademiks';
    
    protected $fillable = ['title','start','end','color'];

}
