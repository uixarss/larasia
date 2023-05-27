<?php

namespace App\Exports;

use App\Models\AbsensiMahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiMahasiswaExport implements FromQuery, WithMapping, WithHeadings
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
        return AbsensiMahasiswa::all();
    }
    public function query()
    {
        return AbsensiMahasiswa::query()->where('tanggal_masuk', Carbon::parse($this->date)->toDateString());
    }

    public function map($absensi): array
    {
        return [
            
            $absensi->tanggal_masuk,
            $absensi->hari->hari,
            $absensi->mahasiswa->nim,
            $absensi->mahasiswa->nama_mahasiswa,
            $absensi->jam_masuk,
            $absensi->jam_keluar,
            $absensi->kelas->nama_kelas,
            $absensi->mapel->nama_mapel,
            $absensi->dosen->nama_dosen,
            $absensi->status,
            $absensi->keterangan

        ];
    }
    
    public function headings(): array
    {
        return [
            'Tanggal Absen',
            'Hari',
            'NRP',
            'Nama Mahasiswa',
            'Jam Masuk',
            'Jam Pulang',
            'Kelas',
            'Mata Kuliah',
            'Dosen',
            'Status',
            'Keterangan'
        ];
    }
}