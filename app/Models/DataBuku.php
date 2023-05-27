<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataBuku extends Model
{
    protected $table ='data_buku';
    protected $fillable = ['kategori_buku_id','ISBN','judul_buku',
                          'penulis','penerbit','tanggal_terbit','deskripsi','gambar','stok_buku'];

    /**
    * Di model buku
    */
    public function kategori_buku()
    {
      return $this->belongsTo(KategoriBuku::class);
    }


    public function distributor()
    {
      return $this->belongsToMany(DistributorBuku::class,'data_buku_distributor','data_buku_id', 'distributor_buku_id')
      ->withPivot('id','jumlah_buku', 'tanggal_masuk');
    }

    public function kondisi()
    {
      return $this->belongsToMany(ListKondisi::class,'data_kondisi_buku','data_buku_id','list_kondisi_id')
      ->withPivot('jumlah');
    }


    public function peminjaman()
    {
      return $this->belongsToMany(Siswa::class,'data_peminjaman_buku','data_buku_id','siswa_id')
      ->withPivot('id','NIS','nama_depan','nama_belakang','kelas_id')
      ->withTimestamps();
    }

    public function dendabuku()
    {
      return $this->belongsToMany(Siswa::class,'denda_buku','data_buku_id','siswa_id')
      ->withPivot('id','NIS','nama_depan','nama_belakang','kelas_id')
      ->withTimestamps();
    }

}
