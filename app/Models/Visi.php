<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visi extends Model
{
    //

    protected $fillable = [
        'visiable_id',
        'visiable_type',
        'teks',
        'created_by',
        'updated_by'
    ];


    public function visiable()
    {
        return $this->morphTo();
    }
}
