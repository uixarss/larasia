<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DendaBuku extends Model
{
    protected $table ='denda_buku';
    protected $fillable = ['siswa_id','data_buku_id','jumlah_telat','jumlah_denda'];

    public function siswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function data_buku()
    {
        return $this->belongsTo(DataBuku::class);
    }

    // public function siswa()
    // {
    //   return $this->belongsToMany(Siswa::class,'data_peminjaman_buku','data_buku_id','siswa_id')
    //   ->withPivot('id','NIS','nama_depan','nama_belakang','kelas_id');
    // }

}
