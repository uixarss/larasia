<?php

namespace App\Http\Controllers;

use App\ListRemainder;
use App\Http\Requests\ListRemainderRequest;
use Illuminate\Http\Request;

class ListRemainderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(ListRemainderRequest $request)
    {
          $ListRemainder = ListRemainder::create($request->all());

          return response()->json(['created' => $ListRemainder->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(ListRemainderRequest $request)
    {
        $event = ListRemainder::where('id', $request->id)->first();

        $event->fill($request->all());

        $event->save();

        return response()->json(['updated' => $event->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        ListRemainder::where('id',$request->id)->delete();

        return response()->json(true);
    }
}
