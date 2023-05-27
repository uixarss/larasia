<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModulMatkul extends Model
{
    protected $table ='modul_matkul';
    protected $fillable = ['id_jurusan','id_prodi','id_matkul','id_semester','id_tahun_ajaran'];

    public function jurusan() {
        return $this->belongsTo(Jurusan::class);
      }
}
