<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListKecamatan extends Model
{
    
    protected $table = 'list_kecamatan';

    protected $fillable = ['id', 'province_id', 'name'];
}
