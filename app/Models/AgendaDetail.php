<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaDetail extends Model
{
    //
    protected $table ='agendas_detail';

    protected $fillable = [
        'agenda_id',
        'tanggal_kbm',
        'jam_kbm',
        'nama_kelas',
        'kegiatan',
        'penugasan'
    ];

    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }

    public function agendaDetailSiswa()
    {
        return $this->hasMany(AgendaDetailSiswa::class,'agendas_detail_id');
    }
    
}
