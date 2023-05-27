<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\User;

class MasterBiaya extends Model
{
    protected $fillable = [
        'nama', 'kode',
        'kode_jurusan', 'tahun_ajaran',
        'semester', 'created_by', 'updated_by'
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'kode_jurusan', 'kode_jurusan');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'kode_jurusan', 'kode_program_studi');
    }

    public function by()
    {
        return $this->belongsTo(User::class,'created_by', 'id');
    }

    public function up()
    {
        return $this->belongsTo(User::class,'updated_by', 'id');
    }
}
