<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KartuHasilStudi;
use App\Models\MataPelajaran;
use App\Models\Dosen;
class KartuHasilStudiDetail extends Model
{

    protected $fillable = [
        'kartu_hasil_studi_id','mapel_id', 'mutu',
        'nilai', 'id_dosen', 'disetujui_oleh', 'diubah_oleh', 'keterangan'
    ];

    public function kartu()
    {
        return $this->belongsTo(KartuHasilStudi::class);
    }

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class,'id_dosen','id');
    }
}
