<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Guru;

class TahunAjaranGuruKelas extends Model
{
    //
    protected $table = 'tahun_ajaran_guru_kelas';

    protected $fillable = [
        'tahun_ajaran_id',
        'kelas_id',
        'guru_id'
    ];

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class,'tahun_ajaran_guru_kelas','id','kelas_id');
    }

    public function walikelas()
    {
        return $this->belongsToMany(Guru::class,'tahun_ajaran_guru_kelas','id','guru_id');
    }

    public function getNamaLengkap($id)
    {
        $guru = Guru::where('id', $id)->first();

        return $guru->nama_lengkap;
    }
}
