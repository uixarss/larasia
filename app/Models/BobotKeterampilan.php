<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BobotKeterampilan extends Model
{
    protected $table ='bobot_keterampilan';

    protected $fillable = [
        'nilai_praktek',
        'nilai_project',
        'total_bobot',
    ];

    public function bobot()
    {
        return $this->hasMany(Bobot::class, 'bobot_keterampilan_id');
    }


}
