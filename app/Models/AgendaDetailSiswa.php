<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaDetailSiswa extends Model
{
    //
    protected $table ='agendas_detail_siswa';

    protected $fillable = [
        'agendas_detail_id',
        'nama_siswa',
        'keterangan'
    ];

    public function agendaDetail()
    {
        return $this->belongsTo(AgendaDetail::class);
    }
}
