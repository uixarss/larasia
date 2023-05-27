<?php

namespace App\Http\Controllers\Pegawai;

use App\DashboardPegawai;
use App\Http\Controllers\Controller;
use App\Models\Catatan;
use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use App\Event;

class DashboardPegawaiController extends Controller
{
    public function __construct()
    {
      $this ->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catatan = DB::table('catatans')->orderBy('tanggal_catatan', 'ASC')
            ->where('tanggal_catatan', '>', Date::now())
            ->paginate(5);

        $reminder = DB::table('reminders')->orderBy('tanggal_reminder', 'ASC')
            ->where('tanggal_reminder', '>', Date::now())
            ->paginate(3);

        $events = DB::table('events')->orderBy('start', 'ASC')
                    ->where('end','>', Date::now())
                    ->paginate(3);

        return view('pegawai.halamanutama.index', [
            'data_catatan' => $catatan,
            'data_reminder' => $reminder,
            'events' => $events
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Bikin Reminder Baru
     * 
     */

    public function buatReminder(Request $request)
    {
        Reminder::create([
            'judul_reminder' => $request->judul_reminder,
            'tanggal_reminder' => $request->tanggal_reminder
        ]);

        return redirect()->route('pegawai.halamanutama.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DashboardPegawai  $dashboardPegawai
     * @return \Illuminate\Http\Response
     */
    public function show(DashboardPegawai $dashboardPegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DashboardPegawai  $dashboardPegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(DashboardPegawai $dashboardPegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DashboardPegawai  $dashboardPegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DashboardPegawai $dashboardPegawai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DashboardPegawai  $dashboardPegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(DashboardPegawai $dashboardPegawai)
    {
        //
    }
}
