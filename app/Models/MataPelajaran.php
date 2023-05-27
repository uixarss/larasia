<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    //
    protected $table ='mapel';
    protected $fillable = ['kode_mapel','type','nama_mapel','jumlah_sks','jumlah_jam', 'keterangan'];


    public function quiz()
    {
        return $this->hasMany(Quiz::class);
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class);
    }

    public function guru()
    {
        return $this->hasMany(Guru::class);
    }


    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    public function materi()
    {
        return $this->hasMany(MateriPelajaran::class);
    }

    public function kkms()
    {
        return $this->hasMany(Kkm::class, 'mapel_id');
    }

    public function nilai_harian()
    {
        return $this->hasMany(NilaiHarian::class, 'mapel_id');
    }

    public function nilai_akhir()
    {
        return $this->hasMany(NilaiAkhir::class, 'mapel_id');
    }

    public function agenda()
    {
        return $this->hasMany(Agenda::class);
    }

    public function hari()
    {
        return $this->belongsTo(Hari::class);
    }

}
