<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\KalenderAkademik;
use Illuminate\Http\Request;
use App\ListRemainder;
use App\Event;

class KalenderAkademikController extends Controller
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
        $events = Event::all();
        $events = Event::paginate(3);
        $listRemainder = ListRemainder::all();
        return view('guru.kalenderakademik.index',['listRemainder' => $listRemainder, 'events' => $events]);
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
     * Display the specified resource.
     *
     * @param  \App\KalenderAkademik  $kalenderAkademik
     * @return \Illuminate\Http\Response
     */
    public function show(KalenderAkademik $kalenderAkademik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KalenderAkademik  $kalenderAkademik
     * @return \Illuminate\Http\Response
     */
    public function edit(KalenderAkademik $kalenderAkademik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KalenderAkademik  $kalenderAkademik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KalenderAkademik $kalenderAkademik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KalenderAkademik  $kalenderAkademik
     * @return \Illuminate\Http\Response
     */
    public function destroy(KalenderAkademik $kalenderAkademik)
    {
        //
    }
}
