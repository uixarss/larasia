<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DataPeminjamanBuku;
use App\Models\DistributorBuku;
use App\Models\KategoriBuku;
use App\Models\DataBuku;
use App\Models\DataBukuDistributor;
use App\Models\Denda;
use App\Models\DataKondisiBuku;
use App\Models\ListKondisi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Auth;

class PerpustakaanController extends Controller
{
    //

    // list buku yang dipinjam oleh siswa
    // role : siswa
    public function listBuku()
    {
        $siswa = Siswa::where('user_id', Auth::id())->first();
        $data_buku = DataPeminjamanBuku::where('siswa_id', $siswa->id)
            ->with('data_buku', 'siswa', 'data_buku.kategori_buku')->get();
        return response()->json($data_buku);
    }

    // List Kategori
    public function listKategori()
    {
        $data_kategori = KategoriBuku::all();
        return response()->json($data_kategori);
    }

    //List Distributor
    public function listDistributor()
    {
        $data_distributor = DistributorBuku::all();

        return response()->json($data_distributor);
    }

    // List Kondisi
    public function listKondisi()
    {
        $data_kondisi = ListKondisi::all();

        return response()->json($data_kondisi);
    }

    //List Buku
    public function listBukuPerpus()
    {
        $data_buku = DataBuku::with('kategori_buku')->get();

        return response()->json($data_buku);
    }

    //List buku detail
    public function listBukuDetail($buku_id)
    {
        $data_buku = DataBuku::where('id', $buku_id)->with('kategori_buku')->first();
        $data_buku = $data_buku->distributor;

        return response()->json($data_buku);
    }

    //create data buku
    public function createBuku(Request $request)
    {
        $data_buku = DataBuku::create([
            'ISBN' => $request->ISBN,
            'judul_buku' => $request->judul_buku,
            'kategori_buku_id' => $request->kategori_id,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tanggal_terbit' => $request->tanggal_terbit,
            'deskripsi' => $request->deskripsi_buku,
            'stok_buku' => $request->jumlah_buku
        ]);

        $distributor = DistributorBuku::find($request->distributor_id);

        $distributor->buku()->attach($data_buku, [
            'jumlah_buku' => $request->jumlah_buku,
            'tanggal_masuk' => $request->tanggal_masuk
        ]);

        return response()->json($data_buku);
    }

    // add buku
    public function addBuku(Request $request, $buku_id)
    {
        $data_buku = DataBuku::find($buku_id);

        $distributor = DistributorBuku::find($request->distributor_id);

        $distributor->buku()->attach($data_buku, [
            'jumlah_buku' => $request->jumlah_buku,
            'tanggal_masuk' => $request->tanggal_masuk
        ]);

        $new_stock = $data_buku->stok_buku + $request->jumlah_buku;

        $data_buku->update([
            'stok_buku' => $new_stock
        ]);

        return response()->json($data_buku);
    }

    // List Peminjaman

    public function listPeminjaman()
    {
        $data_buku_peminjaman = DataPeminjamanBuku::where('status', '1')->with('data_buku', 'siswa', 'user', 'list_kondisi', 'siswa.kelas')->get();

        return response()->json($data_buku_peminjaman);
    }

    // List Siswa
    public function listSiswa()
    {
        $data_siswa = Siswa::all();

        return response()->json($data_siswa);
    }

    // Pinjam buku
    public function pinjamBuku(Request $request)
    {
        for ($i = 0; $i < count($request->ISBN); $i++) {

            $buku = DataBuku::where('ISBN', $request->ISBN[$i])->first();


            $buku->peminjaman()->attach($request->siswa_id, [
                'jumlah' => $request->jumlah[$i],
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'penerima' => Auth::id()
            ]);
        }
    }

    // List Pengembalian
    public function listPengembalian()
    {
        $data_buku_pengembalian = DataPeminjamanBuku::where('status', '0')->with('data_buku', 'siswa', 'user', 'list_kondisi', 'siswa.kelas')->get();

        return response()->json($data_buku_pengembalian);
    }

    // Pengembalian buku
    public function kembaliBuku(Request $request, $id)
    {
        $data_peminjaman = DataPeminjamanBuku::find($id);

        $data_kondisi_buku = DataKondisiBuku::where('data_buku_id', $request->data_buku_id)
            ->where('list_kondisi_id', $request->kondisi_id)->first();


        $denda = Denda::all()->first();


        // //update kondisi buku
        // if ($data_kondisi_buku != null) {
        //     $jmlh_kondisi = $data_kondisi_buku->jumlah;
        //     $update_kondisi_buku = $jmlh_kondisi + $request->jumlah;

        //     $data_kondisi_buku->update([
        //         'jumlah' => $update_kondisi_buku
        //     ]);
        // }else{
        //   DataKondisiBuku::create([
        //     'data_buku_id' => $request->data_buku_id,
        //     'list_kondisi_id' => $request->kondisi_id,
        //     'jumlah' => $request->jumlah
        //   ]);
        // }

        //untuk update denda sama kembali buku
        if ($request->tanggal_kembali > $data_peminjaman->tanggal_selesai) {
            $start = strtotime($data_peminjaman->tanggal_selesai);
            $end   = strtotime($request->tanggal_kembali);
            $diff  = $end - $start;

            $hours = number_format($diff / (60 * 60 / 0.0416667));

            $hasil = $hours * $denda->uang_denda;

            $data_peminjaman->update([
                'list_kondisi_id' => $request->kondisi_id,
                'jumlah' => $request->jumlah,
                'tanggal_kembali' => $request->tanggal_kembali,
                'status' => '0'
            ]);

            $buku = DataBuku::find($request->data_buku_id);
            $buku->dendabuku()->attach($request->siswa_id, [
                'jumlah_telat' => $hours,
                'jumlah_denda' => $hasil
            ]);

            //update kondisi buku
            if ($data_kondisi_buku != null) {
                $jmlh_kondisi = $data_kondisi_buku->jumlah;
                $update_kondisi_buku = $jmlh_kondisi + $request->jumlah;

                $data_kondisi_buku->update([
                    'jumlah' => $update_kondisi_buku
                ]);
            } else {
                DataKondisiBuku::create([
                    'data_buku_id' => $request->data_buku_id,
                    'list_kondisi_id' => $request->kondisi_id,
                    'jumlah' => $request->jumlah
                ]);
            }
        } else {
            $data_peminjaman->update([
                'list_kondisi_id' => $request->kondisi_id,
                'jumlah' => $request->jumlah,
                'tanggal_kembali' => $request->tanggal_kembali,
                'status' => '0'
            ]);

            //update kondisi buku
            if ($data_kondisi_buku != null) {
                $jmlh_kondisi = $data_kondisi_buku->jumlah;
                $update_kondisi_buku = $jmlh_kondisi + $request->jumlah;

                $data_kondisi_buku->update([
                    'jumlah' => $update_kondisi_buku
                ]);
            } else {
                DataKondisiBuku::create([
                    'data_buku_id' => $request->data_buku_id,
                    'list_kondisi_id' => $request->kondisi_id,
                    'jumlah' => $request->jumlah
                ]);
            }
        }
    }

    // List Kondisi buku

    public function listKondisiBuku()
    {
        $data_kondisi_buku = DataKondisiBuku::with('data_buku', 'list_kondisi', 'data_buku.kategori_buku')->get();

        return response()->json($data_kondisi_buku);
    }

    // Add Kondisi Buku
    public function addKondisiBuku(Request $request)
    {
        $buku = DataBuku::where('ISBN', $request->ISBN)->first();

        $buku->kondisi()->attach($request->kondisi_id, ['jumlah' => $request->jumlah]);

        return response()->json($buku->kondisi);
    }

    public function dashboardPerpus()
    {
        $jumlah_data_buku = DataBuku::sum('stok_buku');
        $jumlah_kondisi_buku = DataKondisiBuku::sum('jumlah');

        $dt =  Date::today();
        $today = $dt->year . '-' . $dt->month . '-' . $dt->day;

        $jumlah_peminjaman = DataPeminjamanBuku::where('status', '1')
            ->where('tanggal_mulai', $today)
            ->sum('jumlah');

        $jumlah_pengembalian = DataPeminjamanBuku::where('status', '0')
            ->where('tanggal_kembali', $today)
            ->sum('jumlah');

        $data['id'] = 1;
        $data['jumlah_buku'] = $jumlah_data_buku;
        $data['jumlah_kondisi_buku'] = $jumlah_kondisi_buku;
        $data['jumlah_pinjam'] = $jumlah_peminjaman;
        $data['jumlah_kembali'] = $jumlah_pengembalian;

        return response()->json($data);
    }
}
