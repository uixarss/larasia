<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasMahasiswa extends Model
{
    protected $table ='kelas_mahasiswa';
    protected $fillable = ['user_id','id_kelas', 'id_fakultas','id_jurusan','id_prodi','id_semester','id_tahun_ajaran'];
    
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'user_id', 'user_id');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }
}
