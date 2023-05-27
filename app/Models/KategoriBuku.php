<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{
    protected $table ='kategori_buku';
    protected $fillable = ['kode_kategori','nama_kategori'];


    public function data_buku()
    {
      return $this->hasMany(DataBuku::class);
    }

}
