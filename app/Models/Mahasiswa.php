<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table ='mahasiswa';
    protected $fillable = [
        'nim',
        'user_id',
        'photo',
        'id_prodi',
        'angkatan',
        'tahun_lulus_sma',
        'tahun_lulus',
        'nama_mahasiswa',
        'kelas_id',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'id_agama',
        'nama_agama',
        'nik',
        'nisn',
        'npwp',
        'id_negara',
        'kewarganegaraan',
        'jalan',
        'dusun',
        'rt',
        'rw',
        'kelurahan',
        'kode_pos',
        'id_wilayah',
        'nama_wilayah',
        'id_kecamatan',
        'nama_kecamatan',
        'id_jenis_tinggal',
        'nama_jenis_tinggal',
        'id_alat_transportasi',
        'nama_alat_transportasi',
        'telepon',
        'handphone',
        'email',
        'penerima_kps',
        'nomor_kps',
        'nik_ayah',
        'nama_ayah',
        'tanggal_lahir_ayah',
        'id_pendidikan_ayah',
        'nama_pendidikan_ayah',
        'id_pekerjaan_ayah',
        'nama_pekerjaan_ayah',
        'id_penghasilan_ayah',
        'nama_penghasilan_ayah',
        'nik_ibu',
        'nama_ibu',
        'tanggal_lahir_ibu',
        'id_pendidikan_ibu',
        'nama_pendidikan_ibu',
        'id_pekerjaan_ibu',
        'nama_pekerjaan_ibu',
        'id_penghasilan_ibu',
        'nama_penghasilan_ibu',
        'nama_wali',
        'tanggal_lahir_wali',
        'id_pendidikan_wali',
        'nama_pendidikan_wali',
        'id_pekerjaan_wali',
        'nama_pekerjaan_wali',
        'id_penghasilan_wali',
        'nama_penghasilan_wali',
        'id_kebutuhan_khusus_mahasiswa',
        'nama_kebutuhan_khusus_mahasiswa',
        'id_kebutuhan_khusus_ayah',
        'nama_kebutuhan_khusus_ayah',
        'id_kebutuhan_khusus_ibu',
        'nama_kebutuhan_khusus_ibu',
        'id_status_mahasiswa',
        'nama_status_mahasiswa'
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class,'id_prodi','id_prodi');
    }
    
    public function bimbingan()
    {
        return $this->belongsToMany(Dosen::class, 'dosen_pembimbings', 'id_dosen', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
    
    public function kelasmahasiswa()
    {
        return $this->belongsTo(KelasMahasiswa::class, 'user_id');
    }

}
