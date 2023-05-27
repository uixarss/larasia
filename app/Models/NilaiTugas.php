<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class NilaiTugas extends Model
{
    protected $table ='nilai_tugas';
    protected $fillable = ['mahasiswa_id','dosen_id','tugas_id', 'nilai_tugas', 'created_by'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
