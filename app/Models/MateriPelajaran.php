<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MateriPelajaran extends Model
{
    //
    protected $table = 'materi_pelajarans';
    protected $fillable = [
        'id_prodi',
        'id_semester',
        'id_tahun_ajaran',
        'mapel_id',
        'bab_materi',
        'nama_materi',
        'deskripsi_materi',
        'file_materi',
        'jumlah_unduh',
        'created_by'
    ];

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester', 'id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(tahunAjaran::class, 'id_tahun_ajaran', 'id');
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'materi_kelas');
    }
}
