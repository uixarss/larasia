<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataSkripsi;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DataSkripsiController extends Controller
{
    public function index()
    {
    	
    	$data_skripsi = DataSkripsi::leftjoin('prodi', 'data_skripsi.id_prodi', 'prodi.id_prodi');
    	$data_skripsi = $data_skripsi->select('data_skripsi.*','prodi.nama_program_studi as nm_prodi');
        
        $data_skripsi = $data_skripsi->get();
        



        return view('siswa.dataskripsi.index', [
            'data_skripsi' => $data_skripsi,
        ]);
    }
    
}