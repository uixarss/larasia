<?php

namespace App\Models;
use App\Models\Quiz;

use Illuminate\Database\Eloquent\Model;

class JenisUjian extends Model
{
    protected $table ='jenis_ujians';
    protected $fillable =['kode_jenis_ujian','nama_jenis_ujian'];

    public function quiz()
    {
        return $this->hasMany(Quiz::class);
    }

}
