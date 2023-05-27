<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProfilPT;
use App\StatusMilik;

class ProfilPTController extends Controller
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
        
        $profil_pt = ProfilPT::all()->first();
        $status_milik = StatusMilik::all();

        if(!$profil_pt){
            return view('admin.profilpt.add',[
                'status_milik' => $status_milik]);
        }
        return view('admin.profilpt.index',[
            'profil_pt' => $profil_pt,
            'status_milik' => $status_milik]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $this->validate($request,[
            'kode_perguruan_tinggi' => 'required',
            'nama_perguruan_tinggi' => 'required',
            'email' => 'required|email',
            'kelurahan' => 'required',
            'kode_pos'=> 'required',
            'nama_wilayah'=> 'required',
            'mbs'=> 'required',
            'luas_tanah_milik'=> 'required',
            'luas_tanah_bukan_milik'=> 'required'
            
        ]);

        
        $status_milik = $request->nama_status_milik;
        
        $str_arr = explode (",", $status_milik); 
        $int = (int)$str_arr[1];
        $id_status_milik = $int;
        $nama_status_milik= $str_arr[0];

        $profil_pt = ProfilPT::create([
            'id_perguruan_tinggi' => '4gf4fcd5-69e0-4eca-b381-db314acdfdsw',
            'kode_perguruan_tinggi' => $request->kode_perguruan_tinggi,
            'nama_perguruan_tinggi' => $request->nama_perguruan_tinggi,
            'telepon' => $request->telepon,
            'faximile' => $request->faximile,
            'email' => $request->email,
            'jalan'=> $request->jalan,
            'website' => $request->website,
            'dusun' => $request->dusun,
            'rt_rw'=> $request->rt_rw,
            'kelurahan' => $request->kelurahan,
            'kode_pos'=> $request->kode_pos,
            'id_wilayah' => 24,
            'nama_wilayah' => $request->nama_wilayah,
            'lintang_bujur'=> $request->lintang_bujur,
            'bank' => $request->bank,
            'unit_cabang' => $request->unit_cabang,
            'nomor_rekening' => $request->nomor_rekening,
            'mbs' => $request->mbs,
            'luas_tanah_milik' => $request->luas_tanah_milik,
            'luas_tanah_bukan_milik' => $request->luas_tanah_bukan_milik,
            'sk_pendirian' => $request->sk_pendirian,
            'tanggal_sk_pendirian' => $request->tanggal_sk_pendirian,
            'id_status_milik' => $id_status_milik,
            'nama_status_milik' => $nama_status_milik,
            'status_perguruan_tinggi' => $request->status_perguruan_tinggi,
            'sk_izin_operasional' => $request->sk_izin_operasional,
            'tanggal_izin_operasional' => $request->tanggal_izin_operasional
        ]);

        
        return redirect()->route('admin.profilpt.index')->with('sukses','Data Berhasil Ditambahkan');
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
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'kode_perguruan_tinggi' => 'required',
            'nama_perguruan_tinggi' => 'required',
            'email' => 'required|email',
            
        ]);


        $status_milik = $request->nama_status_milik;
        
        $str_arr = explode (",", $status_milik); 
        $int = (int)$str_arr[1];
        $id_status_milik = $int;
        $nama_status_milik= $str_arr[0];

        $profil_pt = ProfilPT::find($id);
        $profil_pt->update([
            'id_perguruan_tinggi' => '4gf4fcd5-69e0-4eca-b381-db314acdfdsw',
            'kode_perguruan_tinggi' => $request->kode_perguruan_tinggi,
            'nama_perguruan_tinggi' => $request->nama_perguruan_tinggi,
            'telepon' => $request->telepon,
            'faximile' => $request->faximile,
            'email' => $request->email,
            'jalan'=> $request->jalan,
            'website' => $request->website,
            'dusun' => $request->dusun,
            'rt_rw'=> $request->rt_rw,
            'kelurahan' => $request->kelurahan,
            'kode_pos'=> $request->kode_pos,
            // 'id_wilayah' => $request->id_wilayah,
            'nama_wilayah' => $request->nama_wilayah,
            'lintang_bujur'=> $request->lintang_bujur,
            'bank' => $request->bank,
            'unit_cabang' => $request->unit_cabang,
            'nomor_rekening' => $request->nomor_rekening,
            'mbs' => $request->mbs,
            'luas_tanah_milik' => $request->luas_tanah_milik,
            'luas_tanah_bukan_milik' => $request->luas_tanah_bukan_milik,
            'sk_pendirian' => $request->sk_pendirian,
            'tanggal_sk_pendirian' => $request->tanggal_sk_pendirian,
            'id_status_milik' => $id_status_milik,
            'nama_status_milik' => $nama_status_milik,
            'status_perguruan_tinggi' => $request->status_perguruan_tinggi,
            'sk_izin_operasional' => $request->sk_izin_operasional,
            'tanggal_izin_operasional' => $request->tanggal_izin_operasional
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
