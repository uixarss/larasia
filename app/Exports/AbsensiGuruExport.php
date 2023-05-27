<?php

namespace App\Exports;

use App\Models\AbsensiGuru;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiGuruExport implements FromQuery, WithMapping, WithHeadings
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
        return AbsensiGuru::all();
    }
    public function query()
    {
        return AbsensiGuru::query()->where('tanggal_absen', Carbon::parse($this->date)->toDateString());
    }

    public function map($absensi): array
    {
        return [
            
            $absensi->tanggal_absen,
            $absensi->guru->nama_lengkap,
            $absensi->jam_masuk,
            $absensi->jam_pulang,
            $absensi->keterangan

        ];
    }



    public function headings(): array
    {
        return [
            'Tanggal Absen',
            'Nama Guru',
            'Jam Masuk',
            'Jam Pulang',
            'Keterangan'
        ];
    }
}
