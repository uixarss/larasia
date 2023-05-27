<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DaftarUlang;
use App\Models\KRS;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\TahunAjaran;
use App\Models\Semester;
use App\Models\Prodi;
use App\Models\Pemasukan;
use App\Models\Biaya;
use App\Models\Mahasiswa;
use App\Models\VirtualAccount;
use App\Http\Controllers\Admin\BniEnc;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DaftarUlangController extends Controller
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
    public function index($id_tahun_ajaran, $id_semester, $id_prodi)
    {
        try {
        $tahun = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);
        $prodi = Prodi::where('id_prodi', $id_prodi)->first();

        $date = Carbon::now();
        $date = $date->toDateTimeString(); 

        $data_daftar_ulang = DaftarUlang::where('id_tahun_ajaran', $id_tahun_ajaran)
            ->where('id_semester', $id_semester)->where('id_prodi', $id_prodi)->get();
        $virtual_account = VirtualAccount::all();
    
        return view('admin.daftarulang.index', [
            'tahun' => $tahun,
            'semester' => $semester,
            'prodi' => $prodi,
            'data_daftar_ulang' => $data_daftar_ulang,
            'virtual_account' => $virtual_account
        ]);

        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'error' => 'Ada kesalahan.'
            ]);
        }
    }
    public function pilihTahun()
    {
        $data_tahun = TahunAjaran::all();
        $data_semester = Semester::all();

        return view('admin.daftarulang.tahun', [
            'data_tahun' => $data_tahun,
            'data_semester' => $data_semester
        ]);
    }

    public function pilihProdi($id_tahun_ajaran, $id_semester)
    {
        $tahun = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);
        $data_prodi = Prodi::all();
        return view('admin.daftarulang.prodi', [
            'tahun' => $tahun,
            'semester' => $semester,
            'data_prodi' => $data_prodi
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_tahun_ajaran, $id_semester, $id_prodi)
    {
        $tahun = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);
        $prodi = Prodi::where('id_prodi', $id_prodi)->first();
        $data_daftar_ulang = DaftarUlang::where('id_tahun_ajaran', $id_tahun_ajaran)->where('id_semester', $id_semester)
            ->where('id_prodi', $id_prodi)->select('id_mahasiswa')->get();

        $data_mahasiswa = DB::table('mahasiswa')->whereNotIn('id', $data_daftar_ulang)->where('id_prodi', $id_prodi)->get();

        return view('admin.daftarulang.create', [
            'tahun' => $tahun,
            'semester' => $semester,
            'prodi' => $prodi,
            'data_mahasiswa' => $data_mahasiswa
        ]);

    }

    public function create_va($id_tahun_ajaran, $id_semester, $id_prodi)
    {
        $tahun = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);
        $prodi = Prodi::where('id_prodi', $id_prodi)->first();
        $data_daftar_ulang = DaftarUlang::where('id_tahun_ajaran', $id_tahun_ajaran)->where('id_semester', $id_semester)
            ->where('id_prodi', $id_prodi)->select('id_mahasiswa')->get();

        $data_mahasiswa = DB::table('mahasiswa')->whereNotIn('id', $data_daftar_ulang)->where('id_prodi', $id_prodi)->get();

        return view('admin.daftarulang.create_va', [
            'tahun' => $tahun,
            'semester' => $semester,
            'prodi' => $prodi,
            'data_mahasiswa' => $data_mahasiswa
        ]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,  $id_tahun_ajaran, $id_semester, $id_prodi)
    {
        $prodi = Prodi::where('id_prodi', $id_prodi)->first();
        $DaftarUlang = DaftarUlang::create([
            'id_tahun_ajaran' => $id_tahun_ajaran,
            'id_semester' => $id_semester,
            'id_prodi' => $id_prodi,
            'id_mahasiswa' => $request->id_mahasiswa,
            'tingkat_semester' => $request->tingkat_semester,
            'konfirmasi' => false,
            'status_pembayaran' => false
        ]);

        
        return redirect()->back()->with([
            'success' => 'Berhasil membuat daftar ulang mahasiswa'
        ]);
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
    public function edit($id_tahun_ajaran, $id_semester, $id_prodi, $id)
    {
        $tahun = TahunAjaran::find($id_tahun_ajaran);
        $semester = Semester::find($id_semester);
        $prodi = Prodi::where('id_prodi', $id_prodi)->first();
        $daftar_ulang = DaftarUlang::find($id);
        $data_pembayaran = Pembayaran::where('tahun_ajaran_id', $id_tahun_ajaran)->where('semester_id', $id_semester)
            ->where('id_prodi', $id_prodi)->where('id_mahasiswa', $daftar_ulang->id_mahasiswa)->get();

        if ($tahun == null || $semester == null || $prodi == null || $daftar_ulang == null) {
            return abort(404, 'Data Not Found');
        }

        $cek = Pembayaran::where('tahun_ajaran_id', $id_tahun_ajaran)->where('semester_id', $id_semester)
            ->where('id_prodi', $id_prodi)->where('id_mahasiswa',$daftar_ulang->id_mahasiswa)
            ->where('status','BELUM LUNAS')
            ->get()->count();


        if($cek>0){ //jika ada status 0 berarti belum lunas
            $daftar_ulang = DaftarUlang::find($id);
            $daftar_ulang->update([
                // 'konfirmasi' => 0,
                'status_pembayaran' => 0
            ]);
        }else{
            $daftar_ulang = DaftarUlang::find($id);
            $daftar_ulang->update([
                // 'konfirmasi' => 0,
                'status_pembayaran' => 1
            ]);
        }

        return view('admin.daftarulang.edit', [
            'id' => $id,
            'tahun' => $tahun,
            'semester' => $semester,
            'prodi' => $prodi,
            'daftarulang' => $daftar_ulang,
            'data_pembayaran' => $data_pembayaran
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_tahun_ajaran, $id_semester, $id_prodi, $id)
    {
        $daftar_ulang = DaftarUlang::find($id);
        $daftar_ulang->update([
            'konfirmasi' => $request->konfirmasi,
            // 'status_pembayaran' => $request->status_pembayaran 
        ]);

        return redirect()->back()->with([
            'success' => 'Berhasil update daftar ulang'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_tahun_ajaran, $id_semester, $id_prodi, $id)
    {
        $daftar_ulang = DaftarUlang::find($id);
        $daftar_ulang->delete();

        return redirect()->back()->with([
            'success' => 'Berhasil menghapus Daftar Ulang'
        ]);
    }


    public function pembayaran(Request $request, $id_tahun_ajaran, $id_semester, $id_prodi, $id_mahasiswa)
    {
        $this->validate($request, [
            'tingkat_semester' => 'required',
            'nama_tagihan' => 'required',
            'jumlah_tagihan' => 'required',
            'deadline' => 'required',
        ]);
        Pembayaran::create([
            'tahun_ajaran_id' => $id_tahun_ajaran,
            'semester_id' => $id_semester,
            'id_prodi' => $id_prodi,
            'id_mahasiswa' => $id_mahasiswa,
            'tingkat_semester' => $request->tingkat_semester,
            'nama_tagihan' => $request->nama_tagihan,
            'jumlah_tagihan' => $request->jumlah_tagihan,
            'deadline' => $request->deadline,
            'status' => 'BELUM LUNAS'
        ]);


       // $dt = ['bambang','jatmiko'];

        $id = $request->id_daftar_ulang;

        $daftar_ulang = DaftarUlang::find($id);
        $daftar_ulang->update([
            'konfirmasi' => 0,
            'status_pembayaran' => 0
        ]);

        $dt = $id_mahasiswa;
        $tx = $request->jumlah_tagihan;

        $this->create_new_va($dt, $tx);

        return redirect()->back()->with([]);
    }

    public function ubahpembayaran(Request $request, $id_tahun_ajaran, $id_semester, $id_prodi, $id_mahasiswa)
    {


        $this->validate($request, [
            'edit_id' => 'required',
            'edit_status_pembayaran' => 'required',
        ]);
        $id = $request->edit_id_daftar_ulang; 
        $edit_id = $request->edit_id; 
        $edit_nama_tagihan = $request->edit_nama_tagihan;
        $edit_jumlah_tagihan = $request->edit_jumlah_tagihan;
        $edit_jml = $request->edit_jml;

       // dd($edit_nama_tagihan);
        //   var_dump($edit_jml);

        $status = $request->input('edit_status_pembayaran') ;
        
        

        
        $pembayaran = Pembayaran::find($edit_id);
        $pembayaran->nama_tagihan = $edit_nama_tagihan;
        $pembayaran->status = $status;
        $pembayaran->save();

        $cek = Pembayaran::where('tahun_ajaran_id', $id_tahun_ajaran)->where('semester_id', $id_semester)
            ->where('id_prodi', $id_prodi)->where('id_mahasiswa', $id_mahasiswa)
            ->where('status','BELUM LUNAS')
            ->get()->count();


        if($cek>0){ //jika ada status 0 berarti belum lunas
            $daftar_ulang = DaftarUlang::find($id);
            $daftar_ulang->update([
                // 'konfirmasi' => 0,
                'status_pembayaran' => 0
            ]);
        }else{
            $daftar_ulang = DaftarUlang::find($id);
            $daftar_ulang->update([
                // 'konfirmasi' => 0,
                'status_pembayaran' => 1
            ]);
        }
        
        if($status == 'LUNAS'){        
            $Pemasukan = Pemasukan::create([
            'nama' => $edit_nama_tagihan,
            'amount' => $edit_jml,
            'deskripsi' => 'tagihan mahasiswa',
            'tanggal' => Carbon::now(),
           // 'created_by' => Auth::id(),
        ]);
        }

        return redirect()->back()->with([]);
    }

    public function tingkatTerakhir($id_mahasiswa)
    {
        $krs = DaftarUlang::where('id_mahasiswa', $id_mahasiswa)->max('tingkat_semester');

        $data = [
            $krs+1 => $krs+1
        ];

        return json_encode($data, true);
    }


    public function get_tagihan(Request $request)
      {
      # code...
      $search_filter = strtoupper($request->input('searchingan'));

      $limit = 10;
      $order = ($request->input('order') == null ? 'nama asc' : $request->input('order'));

      $data = DB::table('biayas');
      $data = $data->select('id','nama');
      

      $data = $data->where(function ($where) use ($search_filter) {
          $where = $where->orWhere(DB::Raw('upper(nama)'), 'like', '%' . $search_filter . '%');
      });

      $data = $data->orderByRaw($order)->simplePaginate($limit);

      if ($data) {
          $response = [
              'message'        => 'List Reference Tagihan',
              'data'         => $data
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


    public function get_content($url, $post = '') {
        $usecookie = __DIR__ . "/cookie.txt";
        $header[] = 'Content-Type: application/json';
        $header[] = "Accept-Encoding: gzip, deflate";
        $header[] = "Cache-Control: max-age=0";
        $header[] = "Connection: keep-alive";
        $header[] = "Accept-Language: en-US,en;q=0.8,id;q=0.6";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        // curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_ENCODING, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);

        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.120 Safari/537.36");

        if ($post)
        {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $rs = curl_exec($ch);

        if(empty($rs)){
            var_dump($rs, curl_error($ch));
            curl_close($ch);
            return false;
        }
        curl_close($ch);
        return $rs;
        
    }

    public function create_new_va($dt, $tx){
        // FROM BNI
        $client_id = '03331';
        $secret_key = '7398aa35ac1e5f1f3814c92f26b81eff';
        $url = 'https://apibeta.bni-ecollection.com/';

        // local data
        $nama = Mahasiswa::select(DB::raw('nama_mahasiswa'))->where('id', $dt)->get()->first()->nama_mahasiswa;
        $email = Mahasiswa::select(DB::Raw('email'))->where('id', $dt)->get()->first()->email;
        $hp = Mahasiswa::select(DB::Raw('handphone'))->where('id', $dt)->get()->first()->handphone;
        $nim = Mahasiswa::select(DB::Raw('nim'))->where('id', $dt)->get()->first()->nim;
        $nim = substr($nim, -8);


        $data_asli = array(
            
            'client_id' => $client_id,
            'trx_id' => mt_rand(), // fill with Billing ID
            'trx_amount' => $tx,
            'billing_type' => 'c',
            //'datetime_expired' => date('c', time() + 2 * 3600), // billing will be expired in 2 hours
            'virtual_account' => '98803331'.$nim,
            'customer_name' => $nama,
            'customer_email' => $email,
            'customer_phone' => $hp,
            'type' => 'createBilling'
        );

    
        $hashed_string = BniEnc::encrypt(
            $data_asli,
            $client_id,
            $secret_key
        );

        $data = array(
            'client_id' => $client_id,
            'data' => $hashed_string,
        );

        $response = $this->get_content($url, json_encode($data));
        $response_json = json_decode($response, true);

        //dd($url);
        //dd($data_asli);
        //dd($hashed_string);

        if ($response_json['status'] !== '000') {
            // handling jika gagal
            dd($response);
        }
        else {
            $data_response = BniEnc::decrypt($response_json['data'], $client_id, $secret_key);
            // $data_response will contains something like this: 
            // array(
            //  'virtual_account' => 'xxxxx',
            //  'trx_id' => 'xxx',
            // );
        $strings = $hashed_string;
        
        $parsedata = BniEnc::decrypt($strings, $client_id, $secret_key);
        
            
            $data = VirtualAccount::create([
            'client_id' => $client_id,
            'trx_id' => $parsedata['trx_id'], // fill with Billing ID
            'trx_amount' => $tx,
            'billing_type' => 'c',
            'datetime_expired' => date('c', time() + 48 * 3600), // billing will be expired in 2 hours
            'virtual_account' => $parsedata['virtual_account'],
            'customer_name' => $nama,
            'customer_email' => $email,
            'customer_phone' => $hp,
            'type' => 'createBilling'
        ]);
       
        }
         


        
        // URL utk simulasi pembayaran: http://dev.bni-ecollection.com/
    }

    public function pembayaran_va(Request $request, $id_tahun_ajaran, $id_semester, $id_prodi)
    {
        $this->validate($request, [
            'tingkat_semester' => 'required',
            'nama_tagihan' => 'required',
            'jumlah_tagihan' => 'required',
            'deadline' => 'required',
        ]);

         $prodi = Prodi::where('id_prodi', $id_prodi)->first();
        
         $DaftarUlang = DaftarUlang::create([
            'id_tahun_ajaran' => $id_tahun_ajaran,
            'id_semester' => $id_semester,
            'id_prodi' => $id_prodi,
            'id_mahasiswa' => $request->id_mahasiswa,
            'tingkat_semester' => $request->tingkat_semester,
            'konfirmasi' => false,
            'status_pembayaran' => false
        ]);

        Pembayaran::create([
            'tahun_ajaran_id' => $id_tahun_ajaran,
            'semester_id' => $id_semester,
            'id_prodi' => $id_prodi,
            'id_mahasiswa' => $request->id_mahasiswa,
            'tingkat_semester' => $request->tingkat_semester,
            'nama_tagihan' => $request->nama_tagihan,
            'jumlah_tagihan' => $request->jumlah_tagihan,
            'deadline' => $request->deadline,
            'status' => 'BELUM LUNAS'
        ]);

       // $dt = ['bambang','jatmiko'];
        $dt = $request->id_mahasiswa;
        $tx = $request->jumlah_tagihan;

        $this->create_new_va($dt, $tx);

        return redirect()->back()->with([
            'success' => 'Berhasil membuat daftar ulang mahasiswa'
        ]);
    }


   public function detail_va(Request $request, $id_tahun_ajaran, $id_semester, $id_prodi, $tx)
    {
        $client_id = '03331';
        $secret_key = '7398aa35ac1e5f1f3814c92f26b81eff';
        $url = 'https://apibeta.bni-ecollection.com/';


        $data_asli = array(
            'client_id' => $client_id,
            'trx_id' => $tx, // fill with Billing ID927943604
            'type' => 'inquiryBilling'
        );

    
        $hashed_string = BniEnc::encrypt(
            $data_asli,
            $client_id,
            $secret_key
        );

        $data = array(
            'client_id' => $client_id,
            'data' => $hashed_string,
        );

        $response = $this->get_content($url, json_encode($data));
        $response_json = json_decode($response, true);

        //dd($url);
        //dd($data_asli);
        // dd($response);

        if ($response_json['status'] !== '000') {
            // handling jika gagal
            dd($response);
        }
        else {
            $data_response = BniEnc::decrypt($response_json['data'], $client_id, $secret_key);
            // $data_response will contains something like this: 
            // array(
            //  'virtual_account' => 'xxxxx',
            //  'trx_id' => 'xxx',
            // );
        }

       //dd($data_response);

        $mahasiswa = Mahasiswa::select('id')->where('nama_mahasiswa', '=', $data_response['customer_name'])->where('mahasiswa.email', '=', $data_response['customer_email'])->first();

        $id = $mahasiswa['id'];

        $data_pembayaran = Pembayaran::where('tahun_ajaran_id', $id_tahun_ajaran)->where('semester_id', $id_semester)
            ->where('id_prodi', $id_prodi)->where('id_mahasiswa', $id)->get();

        return view('admin.daftarulang.detail_va', [
           'data_pembayaran' => $data_pembayaran,
           'trx_amount' => $data_response['trx_amount'],
           'customer_name' => $data_response['customer_name'],
           'va_status' => $data_response['va_status'],
           'trx_id' => $data_response['trx_id'],
           'virtual_account' => $data_response['virtual_account'],
           'datetime_expired' => $data_response['datetime_expired'],
           'datetime_payment' => $data_response['datetime_payment']
        ]);
    }

     public function ubahpembayaran_va(Request $request)
    {


        $this->validate($request, [
            'edit_id' => 'required',
            'edit_status_pembayaran' => 'required',
        ]);
       // $id = $request->edit_id_daftar_ulang; 
        $edit_id = $request->edit_id; 
        $edit_nama_tagihan = $request->edit_nama_tagihan;
        $edit_jumlah_tagihan = $request->edit_jumlah_tagihan;
        $edit_jml = $request->edit_jml;

       // dd($edit_nama_tagihan);
        //   var_dump($edit_jml);

        $status = $request->input('edit_status_pembayaran') ;
        
        
        $pembayaran = Pembayaran::find($edit_id);
        $pembayaran->nama_tagihan = $edit_nama_tagihan;
        $pembayaran->status = $status;
        $pembayaran->save();

        
        
        if($status == 'LUNAS'){        
            $Pemasukan = Pemasukan::create([
            'nama' => $edit_nama_tagihan,
            'amount' => $edit_jml,
            'deskripsi' => 'tagihan mahasiswa',
            'tanggal' => Carbon::now(),
           // 'created_by' => Auth::id(),
        ]);
        }

        return redirect()->back()->with([]);
    }


    

}