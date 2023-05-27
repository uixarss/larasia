<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\DataOrangTua as Authenticatable;
use Musonza\Chat\Traits\Messageable;

class DataOrangTua extends model
{
    use Notifiable;
    use Messageable;

    protected $table ='orangtua';
    protected $fillable = ['user_id','nama_orangtua','siswa_id','email_orangtua','nohp_orangtua','alamat'];

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

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
