<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\AbsensiSiswa;
use App\Models\Absensi;
use Musonza\Chat\Traits\Messageable;
class Siswa extends Model
{
    use Messageable;

    protected $table ='siswa';
    protected $fillable = [
      'NISN','NIS','nama_depan','nama_belakang','tahun_masuk','user_id',
      'kelas_id','tempat_lahir','tanggal_lahir','golongan_darah',
      'jenis_kelamin','agama','kebangsaan','email_siswa','no_phone',
      'alamat_sekarang','photo','status'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function siswadetail()
    {
        return $this->hasOne(SiswaDetail::class);
    }

    public function absensi()
    {
        return $this->hasMany(AbsensiSiswa::class);
    }

    public function absensis()
    {
        return $this->morphMany('App\Models\Absensi', 'absensiable');
    }

    public function options()
    {
        return $this->belongsToMany(Option::class,'answers');
    }

    public function tugas()
    {
        return $this->belongsToMany(Tugas::class,'tugas_upload_siswa','tugas_id');
    }

    public function result_quizzes()
    {
        return $this->belongsTo(ResultQuiz::class);
    }

    public function nilai_harian()
    {
      return $this->hasMany(NilaiHarian::class);
    }

    public function nilai_akhir()
    {
      return $this->hasMany(NilaiAkhir::class);
    }



}
