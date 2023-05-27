<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MataPelajaran;
use App\User;

class Dosen extends Model
{
  protected $table = 'dosen';
  protected $fillable = [
    'user_id',
    'photo',
    'matkul_id',
    'nama_dosen',
    'tempat_lahir',
    'tanggal_lahir',
    'jenis_kelamin',
    'id_agama',
    'nama_agama',
    'id_status_aktif',
    'nama_status_aktif',
    'nidn',
    'nama_ibu',
    'nik',
    'nip',

    'npwp',
    'id_jenis_sdm',
    'nama_jenis_sdm',
    'no_sk_cpns',
    'tanggal_sk_cpns',
    'no_sk_pengangkatan',
    'mulai_sk_pengangkatan',
    'id_lembaga_pengangkatan',
    'nama_lembaga_pengangkatan',
    'id_pangkat_golongan',
    'nama_pangkat_golongan',
    'id_sumber_gaji',
    'nama_sumber_gaji',
    'jalan',
    'dusun',
    'rt',
    'rw',
    'ds_kel',
    'kode_pos',
    'id_wilayah',
    'nama_wilayah',
    'id_kecamatan',
    'nama_kecamatan',
    'telepon',
    'handphone',
    'email',
    'status_pernikahan',
    'nama_suami_istri',
    'nip_suami_istri',
    'tanggal_mulai_pns',
    'id_pekerjaan_suami_istri',
    'nama_pekerjaan_suami_istri',
    'mampu_handle_kebutuhan_khusus',
    'mampu_handle_braille',
    'mampu_handle_bahasa_isyarat'
  ];

  public function agendas()
  {
    return $this->hasMany(Agenda::class, 'guru_id');
  }
  public function mapel()
  {
    return $this->belongsToMany(MataPelajaran::class, 'penugasan', 'mapel_id', 'id');
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function bimbingan()
  {
    return $this->belongsToMany(Mahasiswa::class, 'dosen_pembimbings', 'id_mahasiswa', 'id');
  }
}
