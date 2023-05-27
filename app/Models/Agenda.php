<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    //
    protected $table = 'agendas';

    protected $fillable = [
        'id_prodi',
        'tahun_ajaran',
        'semester',
        'mapel_id',
        'guru_id'
    ];

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function agendaDetail()
    {
        return $this->hasMany(AgendaDetail::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
