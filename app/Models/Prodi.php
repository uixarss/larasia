<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Jurusan;

class Prodi extends Model
{
    //
    protected $table = 'prodi';
    protected $fillable = [
        'id_jurusan',
        'kode_program_studi',
        'nama_program_studi',
        'status',
        'id_jenjang_pendidikan',
        'nama_jenjang_pendidikan',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id');
    }

    public function fakultas()
    {
        return $this->hasOneThrough(
            Fakultas::class,
            Jurusan::class,
            'id_fakultas',
            'id_jurusan',
            'id',
            'id',
        );
    }

    public function visis()
    {
        return $this->morphMany('App\Models\Visi', 'visiable');
    }

    public function misis()
    {
        return $this->morphMany('App\Models\Misi', 'misiable');
    }

    public function materi()
    {
        return $this->hasMany(MateriPelajaran::class);
    }
}
