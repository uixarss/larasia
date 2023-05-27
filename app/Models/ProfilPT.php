<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPT extends Model
{
    //
    protected $table ='profil_pt';
    protected $fillable = [
        'id_perguruan_tinggi',
        'kode_perguruan_tinggi',
        'nama_perguruan_tinggi',
        'telepon',
        'faximile',
        'email',
        'jalan',
        'website',
        'dusun',
        'rt_rw',
        'kelurahan',
        'kode_pos',
        'id_wilayah',
        'nama_wilayah',
        'lintang_bujur',
        'bank',
        'unit_cabang',
        'nomor_rekening',
        'mbs',
        'luas_tanah_milik',
        'luas_tanah_bukan_milik',
        'sk_pendirian',
        'tanggal_sk_pendirian',
        'id_status_milik',
        'nama_status_milik',
        'status_perguruan_tinggi',
        'sk_izin_operasional',
        'tanggal_izin_operasional'
    ];

}
