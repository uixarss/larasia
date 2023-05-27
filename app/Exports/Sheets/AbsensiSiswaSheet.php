<?php

namespace App\Exports\Sheets;

use App\Models\AbsensiSiswa;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Carbon;

class AbsensiSiswaSheet implements FromQuery, WithTitle, WithMapping, WithHeadings
{
    private $date;
    private $kelas_id;
    private $nama_kelas;

    public function __construct($date, $kelas_id, $nama_kelas)
    {
        $this->date = $date;
        $this->kelas_id = $kelas_id;
        $this->nama_kelas = $nama_kelas;
    }

    /**
     * Builder
     * 
     */
    public function query()
    {
        $siswa = Siswa::where('kelas_id', $this->kelas_id)->get();
        return AbsensiSiswa::where('tanggal_absen', Carbon::parse($this->date)->toDateString())
            ->join('siswa','absensi_siswas.siswa_id','=', 'siswa.id')
            ->where('siswa.kelas_id','=', $this->kelas_id );
    }

    public function map($absensi): array
    {
        return [

            $absensi->tanggal_absen,
            $absensi->siswa->nama_depan . ' ' . $absensi->siswa->nama_belakang,
            $absensi->jam_masuk,
            $absensi->jam_pulang,
            $absensi->keterangan

        ];
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

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->nama_kelas;
    }
}
