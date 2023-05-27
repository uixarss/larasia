<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BobotPengetahuan extends Model
{
    protected $table ='bobot_pengetahuan';

    protected $fillable = [
        'nilai_harian',
        'nilai_akhir',
        'total_bobot',
    ];

    public function bobot()
    {
        return $this->hasMany(Bobot::class, 'bobot_pengetahuan_id');
    }
}
