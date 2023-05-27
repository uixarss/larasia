<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\DataSekolah;
use App\Models\TahunAjaran;
use App\Models\Semester;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class PengaturanAdminController extends Controller
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
        $user = User::where('id', Auth::id())->first();
        $data_sekolah = DataSekolah::all()->first();

        $data_tahun_ajaran = TahunAjaran::all();
        $data_semester = Semester::all();

        return view('admin.pengaturan.index',[
            'user' => $user,
            'data_sekolah' => $data_sekolah,
            'data_tahun_ajaran' => $data_tahun_ajaran,
            'data_semester' => $data_semester,
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
    public function store(Request $request)
    {
        //
    }



    public function tambahTahunAjaran(Request $request)
    {
        TahunAjaran::create([
          'nama_tahun_ajaran' => $request->nama_tahun_ajaran,
          'start_date' => $request->start_date,
          'end_date' => $request->end_date,
          'status' => $request->status
        ]);

        return redirect()->route('admin.pengaturan.index')->with('sukses','Data Berhasil Ditambahkan');

    }


    public function updateTahunAjaran(Request $request, $id)
    {
        $data_tahun_ajaran = TahunAjaran::find($id);

        $data_tahun_ajaran->update([
          'nama_tahun_ajaran' => $request->nama_tahun_ajaran,
          'start_date' => $request->start_date,
          'end_date' => $request->end_date,
          'status' => $request->status
        ]);

        return redirect()->route('admin.pengaturan.index')->with('sukses','Data Berhasil Ditambahkan');

    }


    public function deleteTahunAjaran(Request $request, $id)
    {
        $data_tahun_ajaran = TahunAjaran::find($id);

        $data_tahun_ajaran->delete($data_tahun_ajaran);

        return redirect()->route('admin.pengaturan.index')->with('sukses','Data Berhasil Ditambahkan');

    }





    public function tambahSemester(Request $request)
    {
        Semester::create([
          'nama_semester' => $request->nama_semester
        ]);

        return redirect()->route('admin.pengaturan.index')->with('sukses','Data Berhasil Ditambahkan');

    }


    public function updateSemester(Request $request, $id)
    {
        $data_semester = Semester::find($id);

        $data_semester->update([
          'nama_semester' => $request->nama_semester,
          'status' => $request->status
        ]);

        return redirect()->route('admin.pengaturan.index')->with('sukses','Data Berhasil Diupdate');

    }


    public function deleteSemester(Request $request, $id)
    {
        $data_semester = Semester::find($id);

        $data_semester->delete($data_semester);

        return redirect()->route('admin.pengaturan.index')->with('sukses','Data Berhasil Dihapus');

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
    public function update(Request $request)
    {
        $this->validate($request,[
          'nama_sekolah' => 'required',
          'alamat_sekolah' => 'required',
          'no_phone' => 'required',
          'name' => 'required',
          'email' => 'required|email',
          'latitude' => 'required',
          'longitude' => 'required'
        ]);

        $user = User::find(Auth::id());
        $data_sekolah = DataSekolah::all()->first();

        $user->email = $request->email;
        if ($request->password == "") {
          $user->password = $user->password;
          $user->save();
        }else {
          $user->password = Hash::make($request->password);
          $user->save();
        }

        if($request->hasFile('photo_logo')){
            $this->validate($request,[
              'photo_logo' => 'max:1000|mimes:png,jpeg,jpg'
            ]);
            $photologo = $request->file('photo_logo');
            $extension = $photologo->getClientOriginalExtension();
            $filename =  'logo_Sekolah'. '.' .$extension;
            if (File::exists($photologo)) {
              $photologo->move('admin/assets/images/users/',$filename);
              File::delete($photologo);
            }

            if ($data_sekolah == null) {
              DataSekolah::create([
                  'nama_sekolah' => $request->nama_sekolah,
                  'alamat_sekolah' =>$request->alamat_sekolah,
                  'no_phone' => $request->no_phone,
                  'logo' => $filename,
                  'latitude' => $request->latitude,
                  'longitude' => $request->longitude
              ]);
            }else{
              $data_sekolah->nama_sekolah = $request->nama_sekolah;
              $data_sekolah->alamat_sekolah = $request->alamat_sekolah;
              $data_sekolah->no_phone = $request->no_phone;

              $data_sekolah->logo = $filename;
              $data_sekolah->latitude = $request->latitude;
              $data_sekolah->longitude = $request->longitude;
              $data_sekolah->save();
            }

          }else{
            if ($data_sekolah == null) {
              DataSekolah::create([
                  'nama_sekolah' => $request->nama_sekolah,
                  'alamat_sekolah' =>$request->alamat_sekolah,
                  'no_phone' => $request->no_phone,
                  'latitude' => $request->latitude,
                  'longitude' => $request->longitude
              ]);
            }else{
              $data_sekolah->nama_sekolah = $request->nama_sekolah;
              $data_sekolah->alamat_sekolah = $request->alamat_sekolah;
              $data_sekolah->no_phone = $request->no_phone;
              $data_sekolah->latitude = $request->latitude;
              $data_sekolah->longitude = $request->longitude;

              $data_sekolah->save();
            }

          }

          return redirect()->back();
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
