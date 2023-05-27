<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSkripsi extends Model
{
    protected $table ='data_skripsi';
    protected $fillable = ['judul','tahun_terbit','penulis','nrp','id_prodi','metode','rak','baris'];

    /**
    * Di model buku
    */
    public function data_skripsi()
    {
      return $this->belongsTo(DataSkripsi::class);
    }
     public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

}