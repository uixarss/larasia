<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistributorBuku extends Model
{
    protected $table ='distributor_buku';
    protected $fillable = ['kode_distributor','nama_distributor'];


    public function buku()
    {
      return $this->belongsToMany(DataBuku::class,'data_buku_distributor','distributor_buku_id','data_buku_id');
    }

    // public function data_distributor_buku()
    // {
    //   return $this->hasMany(DataBukuDistributor::class, 'nama_distributor');
    // }
}
