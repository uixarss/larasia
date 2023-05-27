<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Pegawai;
use App\Models\DataOrangTua;
use App\Models\Quiz;
use App\Models\Rpp;
use App\Models\Tugas;
use Musonza\Chat\Traits\Messageable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, Messageable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

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

    // public function hasAnyRoles($roles){
    //   if($this->roles()->whereIn('name', $roles)->first()){
    //     return true;
    //   }
    //   return false;
    // }

    // public function hasRole($role){
    //   if($this->roles()->where('name', $role)->first()){
    //     return true;
    //   }
    //   return false;
    // }

    /**
     * method one to one siswa
     */
    public function siswa()
    {
      return $this->hasOne(Siswa::class);
    }


    /**
     * method one to one pegawai
     */
    public function pegawai()
    {
      return $this->hasOne(Pegawai::class);
    }


    /**
     * method one to one orangtua
     */
    public function orangtua()
    {
      return $this->hasOne(DataOrangTua::class);
    }

    /**
     * method one to one guru
     *
     */

     public function guru()
     {
       return $this->hasOne(Guru::class);
     }

     public function tugas()
     {
       return $this->hasMany(Tugas::class);
     }
     public function kuis()
     {
       return $this->hasMany(Quiz::class);
     }

     public function quiz()
     {
         return $this->hasMany(Quiz::class);
     }

     public function rpp()
     {
       return $this->hasMany(Rpp::class,'created_by');
     }

}
