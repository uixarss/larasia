<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListKondisi extends Model
{
    protected $table ='list_kondisi';
    protected $fillable = ['kode_kondisi','nama_kondisi'];

    public function data_kondisi_buku()
    {
      return $this->hasMany(DataKondisiBuku::class);
    }

    public function buku()
    {
      return $this->belongsToMany(DataBuku::class,'data_kondisi_buku','list_kondisi_id','data_buku_id')
      ->withPivot('jumlah');
    }
}
