<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    
    protected $table ='kurikulum';
    protected $fillable = ['nama_kurikulum', 'id_fakultas', 'id_jurusan','id_prodi', 'id_semester', 'id_tahun_ajaran', 'jumlah_sks_lulus', 'jumlah_sks_wajib', 'jumlah_sks_pilihan'];

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
    
    public function semester()
    {
        return $this->belongsTo(Semester::class,'id_semester','id');
    }

    public function tahun()
    {
        return $this->belongsTo(TahunAjaran::class,'id_tahun_ajaran','id');
    }

}
