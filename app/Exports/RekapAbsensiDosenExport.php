<?php

namespace App\Exports;

use App\Models\AbsensiDosen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class RekapAbsensiDosenExport implements FromView
{
    use Exportable;


    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function view(): View
    {
        $data_absensi = AbsensiDosen::whereBetween('tanggal_masuk',[
            Carbon::parse($this->start)->toDateString(),
            Carbon::parse($this->end)->toDateString()
        ])
        ->select(DB::raw('count(*) as total, id_dosen, mapel_id, kelas_id'))
        ->groupBy(['id_dosen', 'mapel_id', 'kelas_id'])
        ->with(['dosen','mapel', 'kelas'])
        ->get();

        return view('admin.exports.absensidosen',[
            'data_absensi' => $data_absensi
        ]);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return AbsensiDosen::all();
    // }
    // public function query()
    // {
    //     return AbsensiDosen::query()->whereBetween('tanggal_masuk', [
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
