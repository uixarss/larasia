<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListRemainder extends Model
{
      use softDeletes;
      protected $fillable = ['title','start','end','color'];
}
