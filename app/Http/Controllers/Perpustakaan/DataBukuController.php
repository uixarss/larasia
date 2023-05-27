<?php

namespace App\Http\Controllers\Perpustakaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataBuku;
use App\Models\DataEBook;
use App\Models\KategoriBuku;
use App\Models\Mahasiswa;
use App\Models\DownloadEBook;
use App\Models\DistributorBuku;
use App\Models\DataBukuDistributor;
use App\Models\DataPeminjamanBuku;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Helpers\GlobalFunction;
use App\Http\Requests\DataBukuDistributorRequest;
use App\Http\Requests\DataBukuRequest;
use App\Http\Requests\DataEbookRequest;
use App\Http\Requests\DistributorBukuRequest;
use App\Http\Requests\KategoriBukuRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DataBukuController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {

    $data_buku = DataBuku::all();
    $data_ebook = DataEBook::all();
    $data_review = DataEBook::where('status',0)->get();
    $data_buku_distributor = DataBukuDistributor::all();
    $data_kategori = KategoriBuku::all();
    $data_distributor = DistributorBuku::all();


    return view('perpustakaan.databuku.index', [
      'data_buku' => $data_buku,
      'data_ebook' => $data_ebook,
      'data_review' => $data_review,
      'data_buku_distributor' => $data_buku_distributor,
      'data_kategori' => $data_kategori,
      'data_distributor' => $data_distributor
    ]);
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
  public function store(DataBukuRequest $request)
  {
    $data_buku = DataBuku::create([
      'ISBN' => $request->ISBN,
      'judul_buku' => Str::title($request->judul_buku),
      'kategori_buku_id' => $request->kategori_buku_id,
      'penulis' => $request->penulis,
      'penerbit' => $request->penerbit,
      'tanggal_terbit' => $request->tanggal_terbit,
      'deskripsi' => $request->deskripsi,
      'stok_buku' => $request->stok_buku
    ]);

    $buku_distributor = new DataBukuDistributor;
    $buku_distributor->data_buku_id = $data_buku->id;
    $buku_distributor->distributor_buku_id = $request->distributor_buku_id;
    $buku_distributor->jumlah_buku = $request->stok_buku;
    $buku_distributor->tanggal_masuk = $request->tanggal_masuk;

    $buku_distributor->save();




    return redirect()->route('perpustakaan.databuku.index');
  }

  public function storeEBook(DataEbookRequest $request)
  {

    // $this->validate($request, [

    //   'judul_buku' => 'required',
    //   'kategori_ebook_id' => 'required',
    //   'penulis' => 'required',
    //   'file_ebook' => 'required|file|max:6999|mimes:doc,pdf,docx'
    // ]);

    $filenameWithExt = $request->file('file_ebook')->getClientOriginalName();
    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    $filename = str_replace(' ', '_', $filename);
    $extension = $request->file('file_ebook')->getClientOriginalExtension();
    $filenameSimpan = $filename . '_' . time() . '.' . $extension;
    $file_location = Storage::putFileAs('public/ebook', $request->file('file_ebook'), $filenameSimpan);

    $data_buku = DataEBook::create([
      'ISBN' => $request->ISBN,
      'judul_ebook' => Str::title($request->judul_buku),
      'kategori_ebook_id' => $request->kategori_ebook_id,
      'penulis' => $request->penulis,
      'penerbit' => $request->penerbit,
      'tanggal_terbit' => $request->tanggal_terbit,
      'deskripsi' => $request->deskripsi_buku,
      'file_ebook' => $filenameSimpan,
      'status' => $request->status
    ]);

    return redirect()->route('perpustakaan.databuku.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $data_buku = DataBuku::all();
    $buku = DataBuku::where('ISBN', $id)->first();
    $data_buku_distributor = DataBukuDistributor::all();
    $data_distributor = DistributorBuku::all();

    $buku_detail = $buku->distributor; 

    // dd($data_distributor);

    return view('perpustakaan.databuku.show', [
      'buku' => $buku,
      'data_buku' => $data_buku,
      'buku_detail' => $buku_detail,
      'data_buku_distributor' => $data_buku_distributor,
      'data_distributor' => $data_distributor 

    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Request $request, $id)
  {

    return view('perpustakaan.databuku.editbuku', 
        ['id'=>  $id]
    );
  }

  public function editebook(Request $request, $id)
  {

    return view('perpustakaan.databuku.editebook', 
        ['id'=>  $id]
    );
  }
  public function editkategori(Request $request, $id)
  {

    return view('perpustakaan.databuku.editkategori', 
        ['id'=>  $id]
    );
  }

   public function editdistributor(Request $request, $id)
  {

    return view('perpustakaan.databuku.editdistributor', 
        ['id'=>  $id]
    );
  }

   public function tambah()
  {
    return view('perpustakaan.databuku.tambahbuku', [
    ]);
  }

  public function tambahebook()
  {
    return view('perpustakaan.databuku.tambahebook', [
    ]);
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
    $id = $request->input('id');
    
    $data_buku = DataBuku::find($id);

    $data_buku->update([
      'ISBN' => $request->ISBN,
      'judul_buku' => $request->judul_buku,
      'kategori_buku_id' => $request->kategori_buku_id,
      'judul_buku' => $request->judul_buku,
      'penulis' => $request->penulis,
      'penerbit' => $request->penerbit,
      'tanggal_terbit' => $request->tanggal_terbit,
      'deskripsi' => $request->deskripsi
    ]);

    return redirect()->route('perpustakaan.databuku.index');
  }

  public function updateEBook(Request $request)
  {
    $id = $request->input('id');
    $data_buku = DataEBook::find($id);

    $this->validate($request, [

      'judul_buku' => 'required',
      'kategori_ebook_id' => 'required',
      'penulis' => 'required'

    ]);

    if($request->hasFile('file_ebook')){

      $this->validate($request, [
        'file_ebook' => 'max:2000|mimes:doc,pdf,docx'
      ]);
      
      if ($data_buku->file_ebook != null) {
        Storage::delete('public/ebook/' . $data_buku->file_ebook);
      }
      
      $filenameWithExt = $request->file('file_ebook')->getClientOriginalName();
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      $filename = str_replace(' ', '_', $filename);
      $extension = $request->file('file_ebook')->getClientOriginalExtension();
      $filenameSimpan = $filename . '_' . time() . '.' . $extension;
      Storage::putFileAs('public/ebook', $request->file('file_ebook'), $filenameSimpan);

      $data_buku->update([
        'ISBN' => $request->ISBN,
        'judul_ebook' => $request->judul_buku,
        'kategori_ebook_id' => $request->kategori_ebook_id,
        'penulis' => $request->penulis,
        'penerbit' => $request->penerbit,
        'tanggal_terbit' => $request->tanggal_terbit,
        'deskripsi' => $request->deskripsi_buku,
        'file_ebook' => $filenameSimpan,
        'status' => $request->status
      ]);
    }else{
      $data_buku->update([
        'ISBN' => $request->ISBN,
        'judul_ebook' => $request->judul_buku,
        'kategori_ebook_id' => $request->kategori_ebook_id,
        'penulis' => $request->penulis,
        'penerbit' => $request->penerbit,
        'tanggal_terbit' => $request->tanggal_terbit,
        'deskripsi' => $request->deskripsi_buku,
        'status' => $request->status
      ]);
    }

    return redirect()->route('perpustakaan.databuku.index');
  }

  public function publish($id){

    $ebook = DataEBook::find($id);
    $ebook->update([
      'status' => 1
    ]);
    
    return redirect()->route('perpustakaan.databuku.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
     $this->validate($request, [
            'id'   => 'required',
        ]);
        
        try {
            DB::beginTransaction();

            $data = DataBuku::findOrFail($request->input('id'));
            $data->delete();


            DB::commit();

            $response = [
                'message'        => 'Hapus Data Berhasil',
            ];

            return response()->json($response, 201);
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
  

  public function destroyEBook($id)
  {
    $data_buku = DataEBook::find($id);

    $data_buku->delete($data_buku);

    return redirect()->route('perpustakaan.databuku.index');
  }




  /**
   * CRUD DATA KATEGORI
   *
   */
  public function tambahDistributorBuku(DataBukuDistributorRequest $request, $id)
  {
    $buku = DataBuku::find($id);


    // $buku_distributor_id = DataBukuDistributor::where('data_buku_id', $buku->id)->first();

    $buku_distributor = new DataBukuDistributor;

    $buku_distributor->data_buku_id = $buku->id;
    $buku_distributor->distributor_buku_id = $request->distributor_id;
    $buku_distributor->jumlah_buku = $request->jumlah_buku;
    $buku_distributor->tanggal_masuk = $request->tanggal_masuk;


    $buku_distributor->save();

    $update_stok = $buku->stok_buku + $request->jumlah_buku;
    $buku->update([
      'stok_buku' => $update_stok
    ]);

    return back();
  }

  public function updateDistributorBuku(Request $request, $id_buku, $id_distributor)
  {

    // update tabel data buku distributor
    $buku_distributor = DataBukuDistributor::find($id_distributor);

    // dd($buku_distributor);
    $buku_distributor->update([
      'distributor_buku_id' => $request->distributor_id,
      'jumlah_buku' =>  $request->jumlah_buku,
      'tanggal_masuk' => $request->tanggal_masuk
    ]);

    // update jumlah data buku dengan cara sum
    $stok_buku = DataBuku::find($id_buku);

    $jumlah_distributor = DataBukuDistributor::where('data_buku_id', $id_buku)
      ->sum('jumlah_buku');

    $stok_buku->update([
      'stok_buku' => $jumlah_distributor
    ]);

    return back();
  }

  public function deleteDistributorBuku($id_buku, $id_distributor)
  {

    $buku_distributor = DataBukuDistributor::find($id_distributor);
    $buku_distributor->delete($buku_distributor);

    $buku = DataBuku::find($id_buku);
    $jumlah_distributor = DataBukuDistributor::where('data_buku_id', $id_buku)
      ->sum('jumlah_buku');

    $buku->update([
      'stok_buku' => $jumlah_distributor
    ]);

    return back();
  }


  /**
   * CRUD DATA KATEGORI
   *
   */
  public function tambahKategori(KategoriBukuRequest $request)
  {
    KategoriBuku::create([
      'kode_kategori' => $request->kode_kategori,
      'nama_kategori' => $request->nama_kategori
    ]);

    return redirect()->route('perpustakaan.databuku.index');
  }

  public function updateKategori(Request $request)
  {
    $id = $request->input('id');
    $data_kategori = KategoriBuku::find($id);
    $data_kategori->update([
      'kode_kategori' => $request->kode_kategori,
      'nama_kategori' => $request->nama_kategori
    ]);

    return redirect()->route('perpustakaan.databuku.index');
  }

  public function deleteKategori(Request $request)
  {
    $this->validate($request, [
            'id'   => 'required',
        ]);
        
        try {
            DB::beginTransaction();

            $data = KategoriBuku::findOrFail($request->input('id'));
            $data->delete();


            DB::commit();

            $response = [
                'message'        => 'Hapus Data Berhasil',
            ];

            return response()->json($response, 201);
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



  /**
   * CRUD DATA DISTRIBOTOR
   *
   */
  public function tambahDistributor(DistributorBukuRequest $request)
  {
    DistributorBuku::create([
      'kode_distributor' => $request->kode_distributor,
      'nama_distributor' => $request->nama_distributor
    ]);

    return redirect()->route('perpustakaan.databuku.index');
  }

  public function updateDistributor(Request $request)
  {
    $id = $request->input('id');
    $data_distributor = DistributorBuku::find($id);
    $data_distributor->update([
      'kode_distributor' => $request->kode_distributor,
      'nama_distributor' => $request->nama_distributor
    ]);

    return redirect()->route('perpustakaan.databuku.index');
  }

  public function deleteDistributor(Request $request)
  {
     $this->validate($request, [
            'id'   => 'required',
        ]);
        
        try {
            DB::beginTransaction();

            $data = DistributorBuku::findOrFail($request->input('id'));
            $data->delete();


            DB::commit();

            $response = [
                'message'        => 'Hapus Data Berhasil',
            ];

            return response()->json($response, 201);
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

  public function download($id, Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id',$request->user_id)->first();
        if($mahasiswa){
          $download = DownloadEBook::create([
            'id_ebook' => $id,
            'id_mahasiswa' => $mahasiswa->id
          ]);
        }
        
        return redirect()->route('download.ebook', ['path_ebook' => $request->path_ebook]);
    }



     public function index2()
    {
        
  //  $data_buku_distributor = DataBukuDistributor::all();
   /// $data_kategori = KategoriBuku::all();
   // $data_distributor = DistributorBuku::all();
        return view('perpustakaan.databuku.index2');
    }

    public function get_databuku(Request $request)
    {
        $search_filter = strtoupper($request->input('search_filter'));

        $lm =  GlobalFunction::instance()->defaultlimitpage; 
        $limit = ($request->input('limit') == null ? $lm : $request->input('limit'));
        $order = ($request->input('order') == null ? 'ISBN asc' : $request->input('order'));

        // $data = DataBuku::leftjoin('kategori_buku','data_buku.kategori_buku_id','kategori_buku.id');
        

        // $data = $data->select('data_buku.*','kategori_buku.nama_kategori as nama_kategori');
        // $data = $data->leftjoin('data_peminjaman_buku', 'data_buku.id', 'data_peminjaman_buku.data_buku_id')->select(DB::Raw('CASE WHEN data_peminjaman_buku.status = 1 Then sum(data_peminjaman_buku.jumlah) as pinjam when data_peminjaman_buku.status = 0 then sum(data_peminjaman_buku.jumlah as kembali end 0' ));




        //$jmlh_peminjaman = DataPeminjamanBuku::where('data_buku_id','id')->where('status', 1)->sum('jumlah as peminjaman');
        
       // $jmlh_peminjaman= $data->leftjoin('data_peminjaman_buku', 'data_buku.id', 'data_peminjaman_buku.data_buku_id')->where('status',1)->sum('jumlah');
      //  dd($jmlh_peminjaman);
       // $data = $data->leftjoin('data_peminjaman_buku', 'data_buku.id', 'data_peminjaman_buku.data_buku_id');
       // $data = $data->select('data_buku.*','data_peminjaman_buku.status as peminjaman','kategori_buku.nama_kategori as nama_kategori');
        //$jmlh_peminjaman = $jmlh_peminjaman->select('data_buku.*', DB::raw(sum('data_peminjaman_buku.status) as peminjaman');
       // $jmlh_pengembalian = DataPeminjamanBuku::where('data_buku_id', $data->id)->where('status', 0)->sum('jumlah');
        //$jmlh_pengembalian= $data->leftjoin('data_peminjaman_buku', 'data_buku.id', 'data_peminjaman_buku.data_buku_id')->where('status',0)->sum('jumlah');
       // $stok_peminjaman = $data->stok_buku - $jmlh_peminjaman + $jmlh_pengembalian;
       // $jumlah_stok = $stok_peminjaman;

        





        $sub = DataBuku::leftjoin('kategori_buku','data_buku.kategori_buku_id','kategori_buku.id');
        $sub = $sub->select('data_buku.*','kategori_buku.nama_kategori as nama_kategori',
          DB::Raw('sum(CASE WHEN data_peminjaman_buku.status=\'1\' THEN data_peminjaman_buku.jumlah
                            ELSE 0
                        END)  AS jumlah_peminjaman,  
                        sum(CASE
                            WHEN data_peminjaman_buku.status=\'0\' THEN data_peminjaman_buku.jumlah
                            ELSE 0
                        END)  AS jumlah_pengembalian'))
              ->leftjoin('data_peminjaman_buku', 'data_buku.id', 'data_peminjaman_buku.data_buku_id')
              ->groupby('data_buku.id');

        if ($search_filter != null) {
            $sub = $sub->where(function ($where) use ($search_filter) {
                $where = $where->orWhere(DB::Raw('judul_buku'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('penulis'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('penerbit'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('ISBN'), 'like', '%' . $search_filter . '%');
            });
        }

        

        $data = DB::table( DB::raw("({$sub->toSql()}) as sub") )
            ->mergeBindings($sub->getQuery())
            ->select('sub.*',DB::raw('stok_buku-jumlah_peminjaman+jumlah_pengembalian as sisa_stok'))
            ->orderByRaw($order)->paginate($limit);





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

    public function get_dataebook(Request $request)
    {
        $search_filter = strtoupper($request->input('search_filter'));

        $lm =  GlobalFunction::instance()->defaultlimitpage; 
        $limit = ($request->input('limit') == null ? $lm : $request->input('limit'));
        $order = ($request->input('order') == null ? 'created_at desc' : $request->input('order'));

        $data = new DataEBook();
        $data = $data->leftjoin('data_download_ebook','data_ebook.id','data_download_ebook.id_ebook');

        if ($search_filter != null) {
            $data = $data->where(function ($where) use ($search_filter) {
                $where = $where->orWhere(DB::Raw('judul_ebook'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('penulis'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('penerbit'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('ISBN'), 'like', '%' . $search_filter . '%');
            });
        }

        $data = $data->select('data_ebook.*',DB::raw('count(data_download_ebook.id) as jml_download'));
        $data = $data->groupby('data_ebook.id');
        $data = $data->orderByRaw($order)->paginate($limit);

        if ($data) {
            $response = [
                'message'        => 'List E-Book',
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

    public function get_reviewebook(Request $request)
    {
        $search_filter = strtoupper($request->input('search_filter'));

        $lm =  GlobalFunction::instance()->defaultlimitpage; 
        $limit = ($request->input('limit') == null ? $lm : $request->input('limit'));
        $order = ($request->input('order') == null ? 'created_at desc' : $request->input('order'));

        $data = DataEBook::where('status',DB::raw(0));


        if ($search_filter != null) {
            $data = $data->where(function ($where) use ($search_filter) {
                $where = $where->orWhere(DB::Raw('judul_ebook'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('penulis'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('penerbit'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('ISBN'), 'like', '%' . $search_filter . '%');
            });
        }
        $data = $data->orderByRaw($order)->paginate($limit);

        if ($data) {
            $response = [
                'message'        => 'List E-Book',
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


    public function get_kategori(Request $request)
    {
        $search_filter = strtoupper($request->input('search_filter'));

        $lm =  GlobalFunction::instance()->defaultlimitpage; 
        $limit = ($request->input('limit') == null ? $lm : $request->input('limit'));
        $order = ($request->input('order') == null ? 'created_at asc' : $request->input('order'));

        $data = new KategoriBuku();


        if ($search_filter != null) {
            $data = $data->where(function ($where) use ($search_filter) {
                $where = $where->orWhere(DB::Raw('kode_kategori'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('nama_kategori'), 'like', '%' . $search_filter . '%');
            });
        }

        $data = $data->orderByRaw($order)->paginate($limit);

        if ($data) {
            $response = [
                'message'        => 'List Kategori',
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
     public function get_distributor(Request $request)
    {
        $search_filter = strtoupper($request->input('search_filter'));

        $lm =  GlobalFunction::instance()->defaultlimitpage; 
        $limit = ($request->input('limit') == null ? $lm : $request->input('limit'));
        $order = ($request->input('order') == null ? 'created_at desc' : $request->input('order'));

        $data = new DistributorBuku();


        if ($search_filter != null) {
            $data = $data->where(function ($where) use ($search_filter) {
                $where = $where->orWhere(DB::Raw('kode_distributor'), 'like', '%' . $search_filter . '%');
                $where = $where->orWhere(DB::Raw('nama_distributor'), 'like', '%' . $search_filter . '%');
            });
        }

        $data = $data->orderByRaw($order)->paginate($limit);

        if ($data) {
            $response = [
                'message'        => 'List Distributor',
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

     public function get_data_buku($id,Request $request)
    {
       $data = DataBuku::leftjoin('kategori_buku','data_buku.kategori_buku_id','kategori_buku.id');
       $data = $data->select('data_buku.*','kategori_buku.nama_kategori as nama_kategori');
        $data = $data->find($id);

       
        if ($data) {
            $response = [
                'message'   => 'Show data buku detail',
                'data'      => $data,
            ];

            return response()->json($response, 200);
        }else{
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

    public function get_data_ebook($id,Request $request)
    {
       $data = DataEBook::leftjoin('kategori_buku','data_ebook.kategori_ebook_id','kategori_buku.id');
       $data = $data->select('data_ebook.*','kategori_buku.nama_kategori as nama_kategori');
        $data = $data->find($id);

       
        if ($data) {
            $response = [
                'message'   => 'Show data buku detail',
                'data'      => $data,
            ];

            return response()->json($response, 200);
        }else{
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

     public function get_kategori_id($id,Request $request)
    {

        $data = new KategoriBuku();
        $data = $data->find($id);


        

        if ($data) {
            $response = [
                'message'        => 'List Kategori Detail',
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

     public function get_distributor_id($id,Request $request)
    {

        $data = new DistributorBuku();
        $data = $data->find($id);


        

        if ($data) {
            $response = [
                'message'        => 'List Distributor Detail',
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