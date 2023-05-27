<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPengganti;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Pengampu;
use App\Models\Ruangan;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Models\Waktu;
use App\Models\PengumumanDosen;
use Illuminate\Support\Facades\Auth;
use App\Models\Dosen;
use App\Models\Hari;
use App\Helpers\GlobalFunction;
use Illuminate\Support\Facades\DB;


class PengumumanController extends Controller
{
     public function __construct()
    {
      $this->middleware(['auth', 'role:dosen']);
    }

        public function index(Request $request)
    {
        return view('guru.pengumuman.index', [
            'id_jadwal' => $request->id_jadwal
        ]);

    }

      public function tambah(Request $request, $id)
    {
        return view('guru.pengumuman.tambah', [
            'id' => $request->id
        ]);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'isi' => 'required',
            'id_jadwal' => 'required',
        ]);

      

         try {
            DB::beginTransaction();

            $data = new PengumumanDosen();



            $data->id_jadwal = $request->input('id_jadwal');
            $data->judul = $request->input('judul');
            $data->isi = $request->input('isi');
            $data->save();

            DB::commit();

            $response = [
                'message'        => 'Simpan Data Berhasil',
            ];

            return redirect()->back()->with([
                'success' => 'Pengumuman Berhasil Disimpan!'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'message'        => 'Transaction DB Error',
                'data'      => $e->getMessage()
            ];
            return response()->json($response, 500);
        }

        $response = [
            'message'        => 'An Error Occured'
        ];

        return response()->json($response, 500);
    }


     public function get_kelas_id($id,Request $request)
    {

        //$id = $request->input('id');
        $search_filter = strtoupper($request->input('search_filter'));

        $lm =  GlobalFunction::instance()->defaultlimitpage; 
        $limit = ($request->input('limit') == null ? $lm : $request->input('limit'));
        $order = ($request->input('order') == null ? 'created_at desc' : $request->input('order'));
        

        $data = PengumumanDosen::where('id_jadwal', $id);

        if ($search_filter != null) {
            $data = $data->where(function ($where) use ($search_filter) {
                $where = $where->orWhere(DB::Raw('judul'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('isi'), 'like', '%' . $search_filter . '%');
            });
        }
        $data = $data->orderByRaw($order)->paginate($limit);
        
        //$data = $data->find($id);


        

        if ($data) {
            $response = [
                'message'        => 'List Pengumuman Detail',
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

    public function destroy(Request $request)
  {
    //  $this->validate($request, [
    //         'id'   => 'required',
    //     ]);
        
        try {

            $data = PengumumanDosen::find($request->input('id'));
            $data->delete();

            $response = [
                'message'        => 'Hapus Data Berhasil',
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response = [
                'message'        => 'Transaction DB Error',
                'data'      => $e->getMessage()
            ];
            return response()->json($response, 500);
        }

        $response = [
            'message'        => 'An Error Occured'
        ];

        return response()->json($response, 500);
    }

     public function update(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'isi' => 'required',
            'id_jadwal' => 'required',
        ]);

         try {
            DB::beginTransaction();

            $data = PengumumanDosen::find($request->input('id'));



            $data->id_jadwal = $request->input('id_jadwal');
            $data->judul = $request->input('judul');
            $data->isi = $request->input('isi');
            $data->save();

            DB::commit();

            $response = [
                'message'        => 'Simpan Data Berhasil',
            ];

            return view('guru.pengumuman.index', [
            'id_jadwal' => $request->input('id_jadwal')
        ]);

        } catch (\Exception $e) {
            DB::rollback();
            $response = [
                'message'        => 'Transaction DB Error',
                'data'      => $e->getMessage()
            ];
            return response()->json($response, 500);
        }

        $response = [
            'message'        => 'An Error Occured'
        ];

        return response()->json($response, 500);
    }
    
    public function get_pengumuman_id($id,Request $request)
    {

        //$id = $request->input('id');
        $search_filter = strtoupper($request->input('search_filter'));

        $lm =  GlobalFunction::instance()->defaultlimitpage; 
        $limit = ($request->input('limit') == null ? $lm : $request->input('limit'));
        $order = ($request->input('order') == null ? 'created_at desc' : $request->input('order'));
        

        $data = PengumumanDosen::where('id', $id);

        if ($search_filter != null) {
            $data = $data->where(function ($where) use ($search_filter) {
                $where = $where->orWhere(DB::Raw('judul'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('isi'), 'like', '%' . $search_filter . '%');
            });
        }
        $data = $data->orderByRaw($order)->paginate($limit);
        
        $data = $data->find($id);


        

        if ($data) {
            $response = [
                'message'        => 'List Pengumuman Detail',
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