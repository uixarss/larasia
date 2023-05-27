<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MataPelajaran;

class KRSSP extends Model
{
    //
    protected $table = 'krs_sp';

    protected $fillable = [
        'id_fakultas', 'id_jurusan', 'id_prodi', 'mapel_id', 'tingkat_semester'
    ];

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class,'mapel_id','id');
    }
     public function detail()
    {
        return $this->hasMany(KRSDetail::class,'id_krs');
    }

    public function tahun()
    {
        return $this->belongsTo(TahunAjaran::class,'tingkat_semester','id');
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
