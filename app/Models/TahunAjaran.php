<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table ='tahun_ajarans';
    protected $fillable = ['id','nama_tahun_ajaran','start_date','end_date','status'];

    public function semester()
    {
        return $this->hasMany(Semester::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function walikelas()
    {
        return $this->belongsToMany(Guru::class);
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class);
    }

    public function penugasan()
    {
        return $this->belongsToMany(Guru::class, 'penugasan','tahun_ajaran_id','id');
    }
    
    public function materi()
    {
        return $this->hasMany(MateriPelajaran::class);
    }
}
