<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\DataBuku;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Helpers\GlobalFunction;
use DB;

class DataBukuController extends Controller
{
    public function index()
    {

        $data_buku = DataBuku::all();


        return view('siswa.databuku.index', [
            'data_buku' => $data_buku,
        ]);
    }
    public function index2()
    {

        return view('siswa.databuku.index2');
    }

    public function get_databuku(Request $request)
    {
        $search_filter = strtoupper($request->input('search_filter'));

        $lm =  GlobalFunction::instance()->defaultlimitpage; 
        $limit = ($request->input('limit') == null ? $lm : $request->input('limit'));
        $order = ($request->input('order') == null ? 'created_at desc' : $request->input('order'));

        $data = new DataBuku();


        if ($search_filter != null) {
            $data = $data->where(function ($where) use ($search_filter) {
                $where = $where->orWhere(DB::Raw('judul_buku'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('penulis'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('penerbit'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('ISBN'), 'like', '%' . $search_filter . '%');
            });
        }

        $data = $data->orderByRaw($order)->paginate($limit);

        if ($data) {
            $response = [
                'message'        => 'List buku',
                'data'         => $data
            ];

            return response()->json($response, 200);
        } else {
            $response = [
                'message'        => 'Not Found'
            ];

            return response()->json($response, 404);
        }

        $response = [
            'message'        => 'An Error Occured'
        ];

        return response()->json($response, 500);
    }
}