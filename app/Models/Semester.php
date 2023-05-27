<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    //


  protected $table ='semesters';
  protected $fillable = ['nama_semester','status'];

    public function tahunajaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function materi()
    {
        return $this->hasMany(MateriPelajaran::class);
    }
}
