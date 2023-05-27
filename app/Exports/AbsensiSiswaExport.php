<?php

namespace App\Exports;

use App\Exports\Sheets\AbsensiSiswaSheet;
use App\Models\AbsensiSiswa;
use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AbsensiSiswaExport implements WithMultipleSheets
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
        return AbsensiSiswa::all();
    }

    public function query()
    {
        return AbsensiSiswa::where('tanggal_absen', Carbon::parse($this->date)->toDateString())
            ->join('siswa','absensi_siswas.siswa_id','=', 'siswa.id')
            ->where('siswa.kelas_id','=', $this->kelas_id );
    }


    public function map($absensi): array
    {
        return [

            $absensi->tanggal_absen,
            $absensi->siswa->nama_depan . ' ' .$absensi->siswa->nama_belakang,
            $absensi->jam_masuk,
            $absensi->jam_pulang,
            $absensi->keterangan

        ];
    }

    public function sheets(): array
    {
        $sheets = [];

        $data_kelas = Kelas::all();

        foreach ($data_kelas as $key_kelas => $kelas) {
            $sheets[] = new AbsensiSiswaSheet(Carbon::parse($this->date)->toDateString(), $kelas->id, $kelas->nama_kelas);
        }

        return $sheets;
    }



    public function headings(): array
    {
        return [
            'Tanggal Absen',
            'Nama Siswa',
            'Jam Masuk',
            'Jam Pulang',
            'Keterangan'
        ];
    }
}
