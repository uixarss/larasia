<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dosen;
use App\Models\MataPelajaran;

class Pengampu extends Model
{
    protected $table ='pengampu';
    protected $fillable = ['id_dosen','mapel_id','id_fakultas','id_jurusan','id_prodi','id_semester','id_tahun_ajaran','jumlah_tatap_muka'];

    public function agendas()
    {
        return $this->hasMany(Agenda::class, 'guru_id');
    }  
    
    public function dosen()
    {
        return $this->belongsTo(Dosen::class,'id_dosen','id');
    }

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class,'mapel_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class,'id_prodi','id_prodi');
    }
    
    public function semester()
    {
        return $this->belongsTo(Semester::class,'id_semester','id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class,'id_tahun_ajaran','id');
    }

}

