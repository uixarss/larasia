<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Mahasiswa;
use App\Models\Prodi;
class Pembayaran extends Model
{
    //

    protected $fillable = [
        'tahun_ajaran_id', 'semester_id', 'tingkat_semester', 'id_mahasiswa', 'id_prodi', 
        'nama_tagihan', 'catatan', 'deadline', 'jumlah_tagihan', 'status'
    ];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function mahasiwa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi','id_prodi');
    }
}
