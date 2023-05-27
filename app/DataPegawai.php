<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\DataPegawai as Authenticatable;

class DataPegawai extends Model
{
  use Notifiable;

  protected $table = "pegawai";

  protected $fillable = ['NIP','nama_pegawai'];

  public function getAvatar(){
    if(!$this->avatar){
      return asset('admin/assets/images/users/no-image.jpg');
    }
    return asset('admin/assets/images/users/'.$this->avatar);
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
}
