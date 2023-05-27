<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListKota extends Model
{
    protected $table = 'list_kota';

    protected $fillable = ['id', 'province_id', 'name'];
}
