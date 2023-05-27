<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jadwal;

class Hari extends Model
{
    //
    protected $fillable = ['hari'];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
