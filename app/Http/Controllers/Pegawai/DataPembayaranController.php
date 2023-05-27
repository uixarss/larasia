<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DataPembayaranController extends Controller
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
        $data_pembayaran_belum_lunas = Pembayaran::where('status', 'BELUM LUNAS')->take(10)->get();
        $data_pembayaran_lunas = Pembayaran::where('status', 'LUNAS')->take(10)->get();
        $data_siswa = Mahasiswa::all();
        $data_kelas = Kelas::all();
        return view('pegawai.datapembayaran.index', [
            'data_siswa' => $data_siswa,
            'data_kelas' => $data_kelas,
            'data_pembayaran' => $data_pembayaran_belum_lunas,
            'data_lunas' => $data_pembayaran_lunas
        ]);
    }

    public function getNonLunas($tanggal_deadline)
    {
        $data_pembayaran_non_lunas = Pembayaran::
            // where('deadline', Carbon::parse($tanggal_deadline)->toDateString())
            where('status', 'BELUM LUNAS')
            ->get();

        return DataTables::of($data_pembayaran_non_lunas)
            ->addColumn('nama', function ($data_pembayaran_non_lunas) {
                if ($data_pembayaran_non_lunas) {
                    return $data_pembayaran_non_lunas->siswa->nama_depan . ' ' . $data_pembayaran_non_lunas->siswa->nama_belakang;
                } else {
                    return 'No data';
                }
            })
            ->addColumn('kelas', function ($data_pembayaran_non_lunas) {
                if ($data_pembayaran_non_lunas) {
                    return $data_pembayaran_non_lunas->kelas->nama_kelas;
                } else {
                    return 'No data';
                }
            })
            ->addColumn('pembayaran', function ($data_pembayaran_non_lunas) {
                if ($data_pembayaran_non_lunas) {
                    return $data_pembayaran_non_lunas->nama_tagihan;
                } else {
                    return 'No data';
                }
            })
            ->addColumn('jumlah', function ($data_pembayaran_non_lunas) {
                if ($data_pembayaran_non_lunas) {
                    return 'Rp ' . number_format($data_pembayaran_non_lunas->jumlah_tagihan, 2);
                } else {
                    return 'No data';
                }
            })
            ->addColumn('batas', function ($data_pembayaran_non_lunas) {
                if ($data_pembayaran_non_lunas) {
                    return $data_pembayaran_non_lunas->deadline;
                } else {
                    return 'No data';
                }
            })
            ->addColumn('status', function ($data_pembayaran_non_lunas) {
                if ($data_pembayaran_non_lunas) {
                    return $data_pembayaran_non_lunas->status;
                } else {
                    return 'No data';
                }
            })
            ->addColumn('action', function ($data_pembayaran_non_lunas) {
                if ($data_pembayaran_non_lunas) {
                    return 'ada';
                } else {
                    return 'No data';
                }
            })
            ->make(true);
    }

    public function getLunas($tanggal_deadline)
    {
        $data_pembayaran_lunas = Pembayaran::
            // where('deadline', $tanggal_deadline)
            where('status', 'LUNAS')
            ->get();

        return DataTables::of($data_pembayaran_lunas)
            ->addColumn('nama', function ($data_pembayaran_lunas) {
                if ($data_pembayaran_lunas) {
                    return $data_pembayaran_lunas->siswa->nama_depan . ' ' . $data_pembayaran_lunas->siswa->nama_belakang;
                } else {
                    return 'No data';
                }
            })
            ->addColumn('kelas', function ($data_pembayaran_lunas) {
                if ($data_pembayaran_lunas) {
                    return $data_pembayaran_lunas->kelas->nama_kelas;
                } else {
                    return 'No data';
                }
            })
            ->addColumn('pembayaran', function ($data_pembayaran_lunas) {
                if ($data_pembayaran_lunas) {
                    return $data_pembayaran_lunas->nama_tagihan;
                } else {
                    return 'No data';
                }
            })
            ->addColumn('jumlah', function ($data_pembayaran_lunas) {
                if ($data_pembayaran_lunas) {
                    return 'Rp ' . number_format($data_pembayaran_lunas->jumlah_tagihan, 2);
                } else {
                    return 'No data';
                }
            })
            ->addColumn('batas', function ($data_pembayaran_lunas) {
                if ($data_pembayaran_lunas) {
                    return $data_pembayaran_lunas->deadline;
                } else {
                    return 'No data';
                }
            })
            ->addColumn('status', function ($data_pembayaran_lunas) {
                if ($data_pembayaran_lunas) {
                    return $data_pembayaran_lunas->status;
                } else {
                    return 'No data';
                }
            })
            ->addColumn('action', function ($data_pembayaran_lunas) {
                if ($data_pembayaran_lunas) {
                    return 'ada';
                } else {
                    return 'No data';
                }
            })
            ->make(true);
    }
}
