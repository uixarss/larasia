<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AbsensiGuru;
use App\User;
use Musonza\Chat\Traits\Messageable;

class Guru extends Model
{
  use Messageable;
    //
  protected $table = "gurus";

  protected $fillable = ['NIP','nama_lengkap','email','bagian_pegawai','jabatan_pegawai','status_pegawai','tanggal_masuk','alamat','agama'];


    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function roles(){
        return $this->belongsToMany('App\Role');
      }


      public function hasAnyRoles($roles){
        if($this->roles()->whereIn('name', $roles)->first()){
          return true;
        }
        return false;
      }


      public function hasRole($role){
        if($this->roles()->where('name', $role)->first()){
          return true;
        }
        return false;
      }


      public function absensi()
      {
        return $this->hasMany(AbsensiGuru::class);
      }

      public function absensis()
      {
          return $this->morphMany('App\Models\Absensi', 'absensiable');
      }

      public function gajis()
      {
        return $this->morphMany('App\Models\Gaji', 'gajiable');
      }

      public function sertifikats()
      {
        return $this->morphMany('App\Models\Sertifikat', 'sertifikatable');
      }

      public function pendidikans()
      {
        return $this->morphMany('App\Models\Pendidikan', 'pendidikanable');
      }

      public function pekerjaans()
      {
        return $this->morphMany('App\Models\Pekerjaan', 'pekerjaanable');
      }

      public function tahunajaran()
      {
        return $this->belongsToMany(TahunAjaran::class);
      }

      public function walikelas()
      {
          return $this->belongsToMany(Kelas::class,'tahun_ajaran_guru_kelas','guru_id','kelas_id');
      }

      public function quiz()
      {
          return $this->hasMany(Quiz::class);
      }

      public function jadwal()
      {
        return $this->hasMany(Jadwal::class,'jadwals');
      }

      public function bobot()
      {
        return $this->belongsTo(Bobot::class);
      }

      public function agendas()
      {
        return $this->hasMany(Agenda::class, 'guru_id');
      }

      public function user()
      {
        return $this->belongsTo(User::class);
      }

      public function penugasan()
      {
        return $this->belongsToMany(TahunAjaran::class, 'penugasan','guru_id','tahun_ajaran_id');
      }


}
