<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use App\Models\KelasMahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Concerns\FromView as FromView;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MahasiswaExport implements FromQuery, WithMapping, WithHeadings
{
    public function __construct()
    {
        // $this->id = $id;
    }

    public function collection()
    {
        return Mahasiswa::all();
    }

    public function query()
    {
        // return KelasMahasiswa::where('id_kelas', $this->id)
        // ->join('mahasiswa','kelas_mahasiswa.user_id','=', 'mahasiswa.user_id')
        // ->join('kelas', 'kelas_mahasiswa.id_kelas', '=', 'kelas.id')
        // ->join('fakultas', 'kelas_mahasiswa.id_fakultas', '=', 'fakultas.id')
        // ->join('jurusans', 'kelas_mahasiswa.id_jurusan', '=', 'jurusans.id')
        // ->join('prodi', 'kelas_mahasiswa.id_prodi', '=', 'prodi.id_prodi')
        // ->join('semesters', 'kelas_mahasiswa.id_semester', '=', 'semesters.id')
        // ->join('tahun_ajarans', 'kelas_mahasiswa.id_tahun_ajaran', '=', 'tahun_ajarans.id');
        return Mahasiswa::orderBy('nim', 'ASC')
        ->join('kelas', 'kelas.id', '=', 'mahasiswa.kelas_id')
        ->join('prodi', 'prodi.id_prodi', '=', 'mahasiswa.id_prodi');
    }

    public function map($kelas_mahasiswa): array
    {

        return [

            $kelas_mahasiswa->nim,
            $kelas_mahasiswa->nama_mahasiswa,
            $kelas_mahasiswa->jenis_kelamin,
            $kelas_mahasiswa->tempat_lahir,
            $kelas_mahasiswa->tanggal_lahir,
            $kelas_mahasiswa->nama_agama,
            $kelas_mahasiswa->kelas->kode_kelas,
            $kelas_mahasiswa->prodi->jurusan->fakultas->kode_fakultas ?? '',
            $kelas_mahasiswa->prodi->jurusan->kode_jurusan ?? '',
            $kelas_mahasiswa->prodi->kode_program_studi,
            $kelas_mahasiswa->nama_semester ?? '',
            $kelas_mahasiswa->nama_tahun_ajaran ?? '',
            $kelas_mahasiswa->nik,
            $kelas_mahasiswa->nisn,
            $kelas_mahasiswa->npwp,
            $kelas_mahasiswa->kewarganegaraan,
            $kelas_mahasiswa->jalan,
            $kelas_mahasiswa->dusun,
            $kelas_mahasiswa->rt,
            $kelas_mahasiswa->rw,
            $kelas_mahasiswa->kelurahan,
            $kelas_mahasiswa->kode_pos,
            $kelas_mahasiswa->nama_kecamatan,
            $kelas_mahasiswa->nama_wilayah,
            $kelas_mahasiswa->telepon,
            $kelas_mahasiswa->handphone,
            $kelas_mahasiswa->email,
            $kelas_mahasiswa->nama_jenis_tinggal,
            $kelas_mahasiswa->nama_alat_transportasi,
            $kelas_mahasiswa->nomor_kps,
            $kelas_mahasiswa->nik_ayah,
            $kelas_mahasiswa->nama_ayah,
            $kelas_mahasiswa->tanggal_lahir_ayah,
            $kelas_mahasiswa->nama_pendidikan_ayah,
            $kelas_mahasiswa->nama_pekerjaan_ayah,
            $kelas_mahasiswa->nama_penghasilan_ayah,
            $kelas_mahasiswa->nik_ibu,
            $kelas_mahasiswa->nama_ibu,
            $kelas_mahasiswa->tanggal_lahir_ibu,
            $kelas_mahasiswa->nama_pendidikan_ibu,
            $kelas_mahasiswa->nama_pekerjaan_ibu,
            $kelas_mahasiswa->nama_penghasilan_ibu,
            $kelas_mahasiswa->nama_wali,
            $kelas_mahasiswa->tanggal_lahir_wali,
            $kelas_mahasiswa->nama_pendidikan_wali,
            $kelas_mahasiswa->nama_pekerjaan_wali,
            $kelas_mahasiswa->nama_penghasilan_wali,
            $kelas_mahasiswa->nama_kebutuhan_khusus_mahasiswa,
            $kelas_mahasiswa->nama_kebutuhan_khusus_ayah,
            $kelas_mahasiswa->nama_kebutuhan_khusus_ibu,
            $kelas_mahasiswa->nama_status_mahasiswa

        ];
    }



    public function headings(): array
    {
        return [
            'NIM',
            'Nama Mahasiswa',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Agama',
            'Kode Kelas',
            'Kode Fakultas',
            'Kode Jurusan',
            'Kode Prodi',
            'Semester',
            'Tahun Ajaran',
            'NIK',
            'NISN',
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
            'Jenis Tinggal',
            'Alat Transportasi',
            'Nomor KPS',
            'NIK Ayah',
            'Nama Ayah',
            'Tanggal Lahir Ayah',
            'Pendidikan Ayah',
            'Pekerjaan Ayah',
            'Penghasilan Ayah',
            'NIK Ibu',
            'Nama Ibu',
            'Tanggal Lahir Ibu',
            'Pendidikan Ibu',
            'Pekerjaan Ibu',
            'Penghasilan Ibu',
            'Nama Wali',
            'Tanggal Lahir Wali',
            'Pendidikan Wali',
            'Pekerjaan Wali',
            'Penghasilan Wali',
            'Kebutuhan Mahasiswa',
            'Kebutuhan Ayah',
            'Kebutuhan Ibu',
            'Status Mahasiswa',
        ];
    }
}
