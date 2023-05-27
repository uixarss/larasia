<?php

namespace App\Exports;

use App\Models\AbsensiDosen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiDosenExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;


    public function __construct($date)
    {
        $this->date = $date;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return AbsensiDosen::all();
    }
    public function query()
    {
        return AbsensiDosen::query()->where('tanggal_masuk', Carbon::parse($this->date)->toDateString());
    }

    public function map($absensi): array
    {
        return [
            
            $absensi->tanggal_masuk,
            $absensi->hari->hari,
            $absensi->dosen->nama_dosen,
            $absensi->jam_masuk,
            $absensi->jam_keluar,
            $absensi->kelas->nama_kelas,
            $absensi->mapel->nama_mapel,
            $absensi->status,
            $absensi->keterangan

        ];
    }
    
    public function headings(): array
    {
        return [
            'Tanggal Absen',
            'Hari',
            'Nama Guru',
            'Jam Masuk',
            'Jam Pulang',
            'Kelas',
            'Mata Kuliah',
            'Status',
            'Keterangan'
        ];
    }
}
