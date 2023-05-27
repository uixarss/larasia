<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarUlang extends Model
{
    protected $fillable = [
        'id_tahun_ajaran', 'id_semester',
        'id_prodi', 'id_mahasiswa', 'tingkat_semester',
        'konfirmasi', 'status_pembayaran'
    ];
    public function tahun()
    {
        return $this->belongsTo(TahunAjaran::class, 'id_tahun_ajaran', 'id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester', 'id');
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'id_fakultas', 'id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id');
    }
}
