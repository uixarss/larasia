<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiHarian extends Model
{
    protected $table ='nilai_harian';
    protected $fillable = ['siswa_id','guru_id','mapel_id', 'tahun_ajaran_id', 'semester_id', 'nilai_harian'];


    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

}
