<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\DataEBook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DataEBookController extends Controller
{
    public function index()
    {

        $data_ebook = DataEBook::where('status', 1)->get();


        return view('siswa.dataebook.index', [
            'data_ebook' => $data_ebook,
        ]);
    }
}
