<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\Prodi;
class KRS extends Model
{

    protected $table = 'krs';
    protected $fillable = [
        'id_tahun_ajaran', 'id_semester', 'id_fakultas', 'id_jurusan', 'id_prodi', 'id_mahasiswa','tingkat_semester'
    ];

    public function detail()
    {
        return $this->hasMany(KRSDetail::class,'id_krs');
    }

    public function tahun()
    {
        return $this->belongsTo(TahunAjaran::class,'id_tahun_ajaran','id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class,'id_semester','id');
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class,'id_fakultas','id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class,'id_jurusan','id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class,'id_prodi','id_prodi');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class,'id_mahasiswa','id');
    }
}
