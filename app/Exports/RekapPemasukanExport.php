<?php

namespace App\Exports;

use App\Models\Pemasukan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class RekapPemasukanExport implements FromView
{
    use Exportable;


    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function view(): View
    {
        $data_pemasukan = Pemasukan::whereBetween('tanggal',[
            Carbon::parse($this->start)->toDateString(),
            Carbon::parse($this->end)->toDateString()
        ])->get();

        return view('admin.exports.pemasukan',[
            'data_pemasukan' => $data_pemasukan
        ]);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Pemasukan::all();
    // }
    // public function query()
    // {
    //     return Pemasukan::query()->whereBetween('tanggal_masuk', [
    //         Carbon::parse($this->start)->toDateString(),
    //         Carbon::parse($this->end)->toDateString()
    //     ])
    //     ->select(DB::raw('count(*) as total'), 'id_dosen')
    //     ->groupBy('id_dosen')
    //     ->with('dosen')
    //     ->get();
    // }

    // public function map($absensi): array
    // {

    //     return [
            
    //         // $absensi->tanggal_masuk,
    //         // $absensi->hari->hari,
    //         // $absensi->dosen->nama_dosen,
    //         // $absensi->jam_masuk,
    //         // $absensi->jam_keluar,
    //         // $absensi->kelas->nama_kelas,
    //         // $absensi->mapel->nama_mapel,
    //         // $absensi->status,
    //         // $absensi->keterangan,
    //         // $absensi->pertemuan_ke,
    //         // $absensi->dosen->nama_dosen,
    //         $absensi->id_dosen,
    //         $absensi->total

    //     ];
    // }
    
    // public function headings(): array
    // {
    //     return [
    //         // 'Tanggal Absen',
    //         // 'Hari',
    //         // 'Nama Guru',
    //         // 'Jam Masuk',
    //         // 'Jam Pulang',
    //         // 'Kelas',
    //         // 'Mata Kuliah',
    //         // 'Status',
    //         // 'Keterangan',
    //         // 'Pertemuan Ke'
    //         'Nama Dosen',
    //         'Total'
    //     ];
    // }

}
