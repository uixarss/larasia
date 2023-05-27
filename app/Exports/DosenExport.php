<?php

namespace App\Exports;

use App\Models\Dosen;
use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Concerns\FromView as FromView;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DosenExport implements FromCollection, WithMapping, WithHeadings
{
    public function __construct()
    {

    }

    public function collection()
    {
        return Dosen::all();
    }

    public function map($dosen): array
    {
        if($dosen->mampu_handle_kebutuhan_khusus==1){
            $mampu_handle_kebutuhan_khusus = "Ya";
        }else{
            $mampu_handle_kebutuhan_khusus = "Tidak";
        }
        if($dosen->mampu_handle_braille==1){
            $mampu_handle_braille = "Ya";
        }else{
            $mampu_handle_braille = "Tidak";
        }
        if($dosen->mampu_handle_bahasa_isyarat==1){
            $mampu_handle_bahasa_isyarat = "Ya";
        }else{
            $mampu_handle_bahasa_isyarat = "Tidak";
        }
        return [

            $dosen->nidn,
            $dosen->nama_dosen,
            $dosen->jenis_kelamin,
            $dosen->tempat_lahir,
            $dosen->tanggal_lahir,
            $dosen->nama_agama,
            $dosen->nik,
            $dosen->nip,
            $dosen->npwp,
            $dosen->kewarganegaraan,
            $dosen->jalan,
            $dosen->dusun,
            $dosen->rt,
            $dosen->rw,
            $dosen->ds_kel,
            $dosen->kode_pos,
            $dosen->nama_kecamatan,
            $dosen->nama_wilayah,
            $dosen->telepon,
            $dosen->handphone,
            $dosen->email,
            $dosen->nama_ibu,
            $dosen->no_sk_cpns,
            $dosen->tanggal_sk_cpns,
            $dosen->no_sk_pengangkatan,
            $dosen->mulai_sk_pengangkatan,
            $dosen->nama_lembaga_pengangkatan,
            $dosen->tanggal_mulai_pns,
            $dosen->nama_pangkat_golongan,
            $dosen->nama_sumber_gaji,
            $dosen->nama_suami_istri,
            $dosen->nip_suami_istri,
            $dosen->nama_pekerjaan_suami_istri,
            $mampu_handle_kebutuhan_khusus,
            $mampu_handle_braille,
            $mampu_handle_bahasa_isyarat,
            $dosen->nama_status_aktif

        ];
    }



    public function headings(): array
    {
        return [
            'NIDN',
            'Nama Dosen',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Agama',
            'NIK',
            'NIP',
            'NPWP',
            'Kewarganegaraan',
            'Jalan',
            'Dusun',
            'RT',
            'RW',
            'Kelurahan',
            'Kode Pos',
            'Kecamatan',
            'Kota',
            'Telepon',
            'Handphone',
            'Email',
            'Nama Ibu',
            'No SK CPNS',
            'Tanggal SK CPNS',
            'No SK Pengangkatan',
            'Mulai SK Pengangkatan',
            'Nama Lembaga Pengangkatan',
            'Tanggal Mulai PNS',
            'Pangkat / Golongan',
            'Sumber Gaji',
            'Nama Suami Istri',
            'NIP Suami Istri',
            'Pekerjaan Suami Istri',
            'Mampu Handle Kebutuhan Khusus',
            'Mampu Handle Braille',
            'Mampu Handle Bahasa Isyarat',
            'Status Dosen'
        ];
    }
}
