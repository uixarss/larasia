<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KartuHasilStudi;
use App\Models\KartuHasilStudiDetail;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KHSController extends Controller
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
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        $data_khs = KartuHasilStudi::where('id_mahasiswa', $mahasiswa->id)
            // ->with(['semester','tahun','mahasiswa','prodi','detail.mapel','detail.dosen'])
            ->with('semester')
            ->get();

        return response()->json($data_khs);
    }

    public function getKHS(Request $request)
    {
        
        $data = [];
        $data_nilai = KartuHasilStudiDetail::where('kartu_hasil_studi_id', $request->khs_id)->with('mapel')->get();
        
        $jumlah = 0;
        foreach($data_nilai as $nilai){
            
            $nilai = $jumlah + $nilai->mapel->jumlah_sks * $nilai->nilai;

            $jumlah = $nilai; 
        }

        $jumlah_sks = 0;
        foreach($data_nilai as $mapel_id){
            $sks = $jumlah_sks + $mapel_id->mapel->jumlah_sks;
            $jumlah_sks = $sks;
        }

        $ips =  $jumlah/$jumlah_sks;

        foreach($data_nilai as $datas)
        {
            $data2 = [
                'nama_mapel' => $datas->mapel->nama_mapel,
                'jumlah_sks' => $datas->mapel->jumlah_sks,
                'mutu' => $datas->mutu,
                'ips' => $ips
                ];
            array_push($data, $data2);
            
        }

        return response()->json($data);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
