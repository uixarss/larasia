<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiswaDetail extends Model
{
    //
    protected $table ='siswa_details';

    protected $fillable = [
      'siswa_id','anak_ke','jumlah_saudara','kondisi_siswa','note','asal_sd','asal_smp',
      'nama_ayah','no_hp_ayah','pendidikan_ayah','pekerjaan_ayah','penghasilan_ayah','alamat_lengkap_ayah',
      'nama_ibu','no_hp_ibu','pendidikan_ibu','pekerjaan_ibu','penghasilan_ibu','alamat_lengkap_ibu'
    ];



    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
