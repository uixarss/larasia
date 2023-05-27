<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeNilai extends Model
{
    protected $table ='grade_nilais';

    protected $fillable = [
        'kode_grade_nilai',
        'nama_grade',
        'nilai_rendah',
        'nilai_tinggi'
    ];
}
