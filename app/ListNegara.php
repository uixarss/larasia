<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListNegara extends Model
{
    protected $table = 'list_negara';

    protected $fillable = ['id', 'kode_negara', 'nama_negara'];
}

