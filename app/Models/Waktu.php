<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Waktu extends Model
{
  protected $fillable = ['id','hari','jam_masuk','jam_keluar'];
}
