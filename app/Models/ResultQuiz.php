<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultQuiz extends Model
{
    protected $table ='result_quizzes';
    protected $fillable = ['siswa_id','quiz_id','nilai_akhir'];


    public function quizzes()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id')->withDefault(['nilai_akhir' => '0']);
    }


    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'quiz_kelas')->withTimestamps();
    }

}
