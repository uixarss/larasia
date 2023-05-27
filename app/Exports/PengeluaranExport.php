<?php

namespace App\Exports;

use App\Models\Pengeluaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengeluaranExport implements FromQuery, WithMapping, WithHeadings
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
        return Pengeluaran::all();
    }
    public function query()
    {
        return Pengeluaran::query()->where('tanggal', Carbon::parse($this->date)->toDateString());
    }

    public function map($pengeluaran): array
    {
        return [       
            $pengeluaran->tanggal,
            $pengeluaran->nomor_referensi,
            $pengeluaran->nama,
            $pengeluaran->deskripsi,
            $pengeluaran->biaya_id,
            $pengeluaran->amount,
            $pengeluaran->transfer_via
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
