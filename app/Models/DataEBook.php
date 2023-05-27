<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataEBook extends Model
{
    protected $table ='data_ebook';
    protected $fillable = ['kategori_ebook_id','ISBN','judul_ebook',
                          'penulis','penerbit','tanggal_terbit','deskripsi', 'file_ebook', 'status'];

    /**
    * Di model buku
    */
    public function kategori_ebook()
    {
      return $this->belongsTo(KategoriBuku::class);
    }
}
