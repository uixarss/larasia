<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiRapor extends Model
{
  protected $table ='nilai_rapor';
  protected $fillable = ['tahun_ajaran','semester','wali_kelas','nis','nama_siswa','kelas_siswa'];

  public function raporSiswa()
  {
    return $this->hasMany(NilaiRaporSiswa::class);
  }
}
