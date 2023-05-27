<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\Siswa;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembayaran;
use App\Http\Resources\PembayaranCollection;
use App\Models\DataOrangTua;

class PembayaranController extends BaseController
{
    //
    
    public function getPembayaran()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        $pembayaran = Pembayaran::where('id_mahasiswa', $mahasiswa->id)
                            ->get();

        // return $this->sendResponse(new PembayaranCollection($pembayaran), 'Sukses ambil data pembayaran');
        return response()->json(new PembayaranCollection($pembayaran));
    }


    public function ortuGetPembayaran()
    {
        $ortu = DataOrangTua::where('user_id', Auth::id())->first();
        $pembayaran = Pembayaran::where('siswa_id', $ortu->siswa_id)->get();

        // return $this->sendResponse(new PembayaranCollection($pembayaran), 'Sukses ambil data pembayaran');
        return response()->json(new PembayaranCollection($pembayaran));

    }
}
