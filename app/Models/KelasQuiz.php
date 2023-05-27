<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasQuiz extends Model
{
    
    protected $table ='quiz_kelas';
    protected $fillable = ['quiz_id','kelas_id'];
    
}
