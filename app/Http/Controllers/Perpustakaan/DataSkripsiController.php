<?php

namespace App\Http\Controllers\Perpustakaan;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataSkripsiRequest;
use Illuminate\Http\Request;
use App\Models\DataSkripsi;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class DataSkripsiController extends Controller
{
    public function __construct()
  {
    $this->middleware('auth');
  }
    public function index()
    {

        //$data_skripsi = DataSkripsi::leftjoin('mahasiswa','data_skripsi.nrp','mahasiswa.nim');
        $data_skripsi = DataSkripsi::leftjoin('prodi', 'data_skripsi.id_prodi', 'prodi.id_prodi');
        $data_skripsi = $data_skripsi->select('data_skripsi.*', 'prodi.nama_program_studi as nm_prodi');
        $data_skripsi = $data_skripsi->get();


        return view('perpustakaan.dataskripsi.index', [
            'data_skripsi' => $data_skripsi,
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        var_dump($id);
        $data_skripsi = DataSkripsi::find($id);
        $data_skripsi->delete();

        return redirect()->back()->with([
            'success' => 'Berhasil menghapus Data Skripsi'
        ]);
    }

    public function ubahdataskripsi(Request $request)
    {
        $this->validate($request, [
            'edit_id' => 'required',
        ]);
        $edit_id = $request->edit_id;
        $edit_judul = $request->edit_judul;
        $edit_metode = $request->edit_metode;
        $edit_penulis = $request->edit_penulis;
        $edit_tahun = $request->edit_tahun;
        $edit_prodi = $request->edit_prodi;
        $edit_rak = $request->edit_rak;
        $edit_baris = $request->edit_baris;
        $edit_nrp = $request->edit_nrp;
        //   var_dump($edit_jml);


        $data_skripsi = DataSkripsi::find($edit_id);
        $penulis = Mahasiswa::where('nim', $request->edit_nrp)->get()->first();
        $data_skripsi->update([
            'judul' => $edit_judul,
            'metode' => $edit_metode,
            'penulis' => $penulis->nama_mahasiswa,
            'tahun_terbit' => $edit_tahun,
            'id_prodi' => $edit_prodi,
            'nrp' => $edit_nrp,
            'rak' => $edit_rak,
            'baris' => $edit_baris
        ]);

        return redirect()->back()->with([
            'success' => 'Berhasil ubah data skripsi'
        ]);
    }

    public function store(DataSkripsiRequest $request)
    {

        try {
            DB::beginTransaction();
            $penulis = Mahasiswa::where('nim', $request->nrp)->get()->first();
            $data_skripsi = DataSkripsi::create([
                'judul' => $request->judul,
                'metode' => $request->metode,
                'penulis' => $penulis->nama_mahasiswa,
                'tahun_terbit' => $request->tahun,
                'id_prodi' => $request->prodi,
                'nrp' => $request->nrp,
                'rak' => $request->rak,
                'baris' => $request->baris
            ]);


            DB::commit();
            return redirect()->back()->with(
                [
                    'success' => 'Berhasil membuat data skripsi mahasiswa atas nama ' . $data_skripsi->penulis
                ]
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with(
                [
                    'error' => $th->getMessage()
                ]
            );
        }
    }

    public function get_penulis(Request $request)
    {
        # code...
        $search_filter = strtoupper($request->input('searchingan'));

        $limit = 10;
        $order = ($request->input('order') == null ? 'nama_mahasiswa asc' : $request->input('order'));

        $data = DB::table('mahasiswa');
        $data = $data->select('id', 'nama_mahasiswa', 'nim');
        $data = $data->where('id_status_mahasiswa', DB::raw(1));


        $data = $data->where(function ($where) use ($search_filter) {
            $where = $where->orWhere(DB::Raw('upper(nama_mahasiswa)'), 'like', '%' . $search_filter . '%');
            $where = $where->orWhere(DB::Raw('nim'), 'like', '%' . $search_filter . '%');
        });

        $data = $data->orderByRaw($order)->simplePaginate($limit);

        if ($data) {
            $response = [
                'message'        => 'List Reference Mahasiswa',
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

    public function get_prodi(Request $request)
    {
        # code...
        $search_filter = strtoupper($request->input('searchingan'));

        $limit = 10;
        $order = ($request->input('order') == null ? 'nama_program_studi asc' : $request->input('order'));

        $data = DB::table('prodi');
        $data = $data->select('id_prodi', 'nama_program_studi');


        $data = $data->where(function ($where) use ($search_filter) {
            $where = $where->orWhere(DB::Raw('upper(nama_program_studi)'), 'like', '%' . $search_filter . '%');
        });

        $data = $data->orderByRaw($order)->simplePaginate($limit);

        if ($data) {
            $response = [
                'message'        => 'List Reference Prodi',
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
