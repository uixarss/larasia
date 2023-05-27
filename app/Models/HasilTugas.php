<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilTugas extends Model
{
    //
    protected $table = 'tugas_upload_siswa';

    protected $fillable = [
        'tugas_id',
        'siswa_id',
        'nama_file_tugas',
        'lokasi_file_tugas'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'siswa_id', 'id');
    }

    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id', 'id');
    }


}
