<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bobot extends Model
{
    protected $table ='bobot';

    protected $fillable = [
        'mapel_id',
        'guru_id',
        'bobot_pengetahuan_id',
        'bobot_keterampilan_id'
    ];

    public function mapel()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function guru()
    {
        return $this->hasMany(Guru::class);
    }

    public function bobot_pengetahuan()
    {
        return $this->belongsTo(BobotPengetahuan::class, 'bobot_pengetahuan_id');
    }

    public function bobot_keterampilan()
    {
        return $this->belongsTo(BobotKeterampilan::class, 'bobot_keterampilan_id');
    }


}
