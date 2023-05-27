<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KRS;
use App\Models\MataPelajaran;
class KRSDetail extends Model
{
    //
    protected $table = 'krs_details';

    protected $fillable = [
        'id_krs', 'mapel_id'
    ];

    public function krs()
    {
        return $this->belongsTo(KRS::class,'id_krs','id');
    }

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class,'mapel_id','id');
    }
}
