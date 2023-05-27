<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipeMataPelajaran extends Model
{
    //
    protected $table ='tipe_mapel';
    protected $fillable = ['tipe_pelajaran'];

    public function mapel()
    {
        return $this->hasMany(MataPelajaran::class);
    }

}
