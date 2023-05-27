<?php

namespace App\Exports;

use App\Models\Pemasukan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PemasukanExport implements FromQuery, WithMapping, WithHeadings
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
        return Pemasukan::all();
    }
    public function query()
    {
        return Pemasukan::query()->where('tanggal', Carbon::parse($this->date)->toDateString());
    }

    public function map($pemasukan): array
    {
        return [
            
            $pemasukan->tanggal,
            $pemasukan->nomor_referensi,
            $pemasukan->nama,
            $pemasukan->deskripsi,
            $pemasukan->biaya_id,
            $pemasukan->amount,
            $pemasukan->transfer_via

        ];
    }
    
    public function headings(): array
    {
        return [
            'Tanggal Keluar',
            'Nomor Referensi',
            'Nama',
            'Deskripsi',
            'Jenis Biaya',
            'Jumlah',
            'Transfer Via'
        ];
    }
}
