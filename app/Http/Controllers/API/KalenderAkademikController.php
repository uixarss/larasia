<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KalenderAkademik;
use App\Models\Pengumuman;
use App\ListRemainder;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class KalenderAkademikController extends Controller
{
    /**
     * List Kalender Akademik
     */
    public function list()
    {
     
        $events = Event::where('deleted_at',null)->get();
        return response()->json($events);
    
    }

    /**
     * List Pengumuman Semuanya
     * 
     */
    public function listPengumuman()
    {
        $data_pengumuman = Pengumuman::orderBy('tanggal_pengumuman','ASC')->get();

        return response()->json($data_pengumuman);

    }
    
}
