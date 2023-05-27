<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KalenderAkademik;
use Illuminate\Http\Request;
use App\Event;
use App\ListRemainder;

class KalenderAkademikController extends Controller
{
    public function __construct()
    {
      $this ->middleware('auth');
    }

    public function loadEvents()
    {
        $events = KalenderAkademik::all();

        return response()->json($events);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $listRemainder = ListRemainder::all();

        $kalender = KalenderAkademik::all();


        return view('admin.kalenderakademik.index',['kalender' => $kalender, 'listRemainder' => $listRemainder]);
    }

    public function loadKalender(){

      $kalender = KalenderAkademik::all();
      return response()->json($kalender);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        // $kalender = KalenderAkademik::all();

        $kalender = KalenderAkademik::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'color' => $request->color,
            'deskripsi' => $request->deskripsi
        ]);


        return redirect()->route('admin.kalenderakademik.index',['kalender' => $kalender]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $kalender = KalenderAkademik::all();
        return view('admin.kalenderakademik.addevent',['kalender' => $kalender]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

    }
}
