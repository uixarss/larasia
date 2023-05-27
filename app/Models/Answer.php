<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Answer extends Model
{
      protected $table ='answers';
      protected $fillable = ['quiz_id','question_id','option_id','siswa_id','jawaban'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

}
