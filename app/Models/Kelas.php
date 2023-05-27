<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    //

    protected $table ='kelas';
    protected $fillable = ['kode_kelas','nama_kelas','kapasitas','jurusan','tingkat','kondisi'];


    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function quiz()
    {
        return $this->belongsToMany(Quiz::class,'quiz_kelas');
    }

    public function mapel()
    {
        return $this->belongsToMany(MataPelajaran::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function absensisiswa()
    {
        return $this->belongsTo(AbsensiSiswa::class);
    }

    public function tahunajaran()
    {
        return $this->belongsToMany(TahunAjaran::class,'tahun_ajaran_guru_kelas','kelas_id');
    }

    public function walikelas()
    {
        return $this->belongsToMany(Guru::class,'tahun_ajaran_guru_kelas','kelas_id','guru_id');
    }

    public function tugas()
    {
        return $this->belongsToMany(Tugas::class, 'tugas_kelas');
    }

    public function materi()
    {
        return $this->belongsToMany(MateriPelajaran::class, 'materi_kelas');
    }

    public function kelasmahasiswa()
    {
        return $this->hasMany(kelasmahasiswa::class, 'id_kelas');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class,'kelas_id');
    }


    
}
