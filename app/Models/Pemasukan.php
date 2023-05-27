<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    //
    protected $fillable = [
        'biaya_id',
        'nomor_referensi',
        'nama',
        'deskripsi',
        'tanggal',
        'amount',
        'transfer_via',
        'created_by',
        'updated_by'
    ];
}
