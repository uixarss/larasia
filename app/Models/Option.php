<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table ='options';
    protected $fillable = ['question_id','pilihan_jawaban','is_correct'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function answer()
    {
        return $this->hasMany(Answer::class);
    }

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class);
    }

}
