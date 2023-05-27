<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiRaporSiswa extends Model
{
  protected $table ='nilai_rapor_siswa';
  protected $fillable = ['nilai_rapor_id','nama_mapel','kkm','nilai_akhir','huruf_mutu','keterangan'];

  public function rapor()
  {
    return $this->belongsTo(NilaiRapor::class, 'nilai_rapor_siswa','id', 'nilai_rapor_id');
  }
}
