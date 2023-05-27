<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AbsensiPegawai;

class Pegawai extends Model
{
  protected $table = "pegawai";

  protected $fillable = ['NIP', 'user_id', 'tanggal_lahir', 'jenis_kelamin', 'phone_no', 'tanggal_masuk', 'nama_pegawai', 'email', 'bagian_pegawai', 'jabatan_pegawai', 'status_pegawai','tanggal_masuk','alamat','agama',
                        'mulai_tugas', 'akhir_tugas'];

  public function getAvatar()
  {
    if (!$this->avatar) {
      return asset('admin/assets/images/users/no-image.jpg');
    }
    return asset('admin/assets/images/users/' . $this->avatar);
  }

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function roles()
  {
    return $this->belongsToMany('App\Role');
  }

  public function hasAnyRoles($roles)
  {
    if ($this->roles()->whereIn('name', $roles)->first()) {
      return true;
    }
    return false;
  }

  public function hasRole($role)
  {
    if ($this->roles()->where('name', $role)->first()) {
      return true;
    }
    return false;
  }

  public function absensi()
  {
    return $this->hasMany(AbsensiPegawai::class);
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

  public function mutasis()
  {
    return $this->morphMany('App\Models\Mutasi', 'mutasiable');
  }


}
