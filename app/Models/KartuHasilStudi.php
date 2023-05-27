<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KartuHasilStudiDetail;
use App\Models\Mahasiswa;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Prodi;

class KartuHasilStudi extends Model
{

    protected $fillable = [
        'id_mahasiswa', 'id_prodi', 'tingkat_semester',
        'id_semester', 'id_tahun_ajaran'
    ];

    public function detail()
    {
        return $this->hasMany(KartuHasilStudiDetail::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id');
    }

    public function tahun()
    {
        return $this->belongsTo(TahunAjaran::class,'id_tahun_ajaran','id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester', 'id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class,'id_prodi','id_prodi');
    }
}
