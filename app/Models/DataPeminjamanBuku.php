<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class DataPeminjamanBuku extends Model
{
    protected $table ='data_peminjaman_buku';
    protected $fillable = ['siswa_id','data_buku_id','list_kondisi_id','jumlah','tanggal_mulai','tanggal_selesai','tanggal_kembali','penerima','status'];

    public function user()
    {
        return $this->belongsTo(User::class,'penerima');
    }

    public function siswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function data_buku()
    {
        return $this->belongsTo(DataBuku::class);
    }

    public function list_kondisi()
    {
        return $this->belongsTo(ListKondisi::class);
    }

}
