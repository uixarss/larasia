<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataBukuDistributor extends Model
{
    protected $table ='data_buku_distributor';
    protected $fillable = ['data_buku_id','distributor_buku_id','jumlah_buku','tanggal_masuk'];


    // Model distributor
    public function data_buku()
    {
      return $this->belongsToMany(DataBuku::class,'data_buku_distributor','distributor_buku_id', 'data_buku_id');
    }

    public function distributor_buku()
    {
      return $this->belongsTo(DistributorBuku::class);
    }

}
