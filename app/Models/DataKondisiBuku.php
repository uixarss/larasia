<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataKondisiBuku extends Model
{
    protected $table ='data_kondisi_buku';
    protected $fillable = ['data_buku_id','list_kondisi_id','jumlah'];


    public function data_buku()
    {
      return $this->belongsTo(DataBuku::class);
    }

    public function list_kondisi()
    {
      return $this->belongsTo(ListKondisi::class);
    }

    
}
