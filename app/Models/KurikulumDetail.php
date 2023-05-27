<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kurikulum;
use App\Models\Dosen;
use App\Models\MataPelajaran;

class KurikulumDetail extends Model
{
    //
    protected $table = 'kurikulum_details';
    protected $fillable = [
        'kurikulum_id', 'dosen_id', 'mapel_id'
    ];

    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class,'kurikulum_id','id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class,'dosen_id','id');
    }

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class,'mapel_id','id');
    }
}
