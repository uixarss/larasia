<?php

namespace App\Exports;

use App\Models\AbsensiPegawai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Concerns\FromView as FromView;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiPegawaiExport implements FromQuery, WithMapping, WithHeadings
{



    public function __construct($date)
    {
        $this->date = $date;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return AbsensiPegawai::all();
    }

    // public function forDate(Date $date)
    // {
    //     $this->date = $date;
    //     return $this;
    // }


    public function query()
    {
        return AbsensiPegawai::query()->where('tanggal_absen', Carbon::parse($this->date)->toDateString());
    }

    public function map($absensi): array
    {
        return [

            $absensi->tanggal_absen,
            $absensi->pegawai->nama_pegawai,
            $absensi->jam_masuk,
            $absensi->jam_pulang,
            $absensi->keterangan

        ];
    }



    public function headings(): array
    {
        return [
            'Tanggal Absen',
            'Nama Pegawai',
            'Jam Masuk',
            'Jam Pulang',
            'Keterangan'
        ];
    }
}
