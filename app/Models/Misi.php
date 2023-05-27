<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Misi extends Model
{
    //

    protected $fillable = [
        'misiable_id',
        'misiable_type',
        'teks',
        'created_by',
        'updated_by'
    ];

    public function misiable()
    {
        return $this->morphTo();
    }
}
