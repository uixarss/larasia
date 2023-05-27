<?php

namespace App\Model;

use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Database\Eloquent\Model;

class Pimpinan extends Model
{
    protected $fillable = [
        'fakultas_id', 'jurusan_id', 'prodi_id','dosen_id',
        'posisi_jabatan', 'mulai_menjabat','akhir_menjabat', 'status'
    ];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class,'fakultas_id','id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class,'jurusan_id','id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class,'prodi_id','id_prodi');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class,'dosen_id','id');
    }
}
