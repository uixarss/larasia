<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{

    public function jenis()
    {
        return $this->belongsTo(JenisBiaya::class,'jenis_biaya_id','id');
    }
}
