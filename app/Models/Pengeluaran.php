<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Biaya;
class Pengeluaran extends Model
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
    public function jenis()
    {
        return $this->belongsTo(Biaya::class,'biaya_id','id');
    }
}
