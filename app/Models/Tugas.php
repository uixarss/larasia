<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    //

    protected $fillable = [
        'id_prodi',
        'id_semester',
        'id_tahun_ajaran',
        'mapel_id',
        'kode_tugas',
        'judul_tugas',
        'deskripsi_tugas',
        'tanggal_mulai',
        'tanggal_akhir',
        'nama_file_tugas',
        'lokasi_file_tugas',
        'created_by'
    ];

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class,'tugas_kelas')->withTimestamps();
    }

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class,'tugas_upload_siswa','siswa_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'created_by');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester', 'id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(tahunAjaran::class, 'id_tahun_ajaran', 'id');
    }
    
}
