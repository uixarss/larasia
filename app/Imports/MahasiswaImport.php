<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use App\Role;
use App\User;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\Prodi;
use App\Models\Semester;
use App\Models\TahunAjaran;
use App\Models\KelasMahasiswa;
use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class MahasiswaImport implements ToCollection, WithStartRow, WithBatchInserts, WithChunkReading, ShouldQueue
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function batchSize(): int
    {
        return 2000;
    }

    public function chunkSize(): int
    {
        return 2000;
    }
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $check = Mahasiswa::where('nim', $row[0])->first();
            $check_email = User::where('email', $row[26])->first();
            if ($row[26] == null) {
                $row[26] = $row[0] . '@stikompoltek.ac.id';
            }
            $check_kelas = Kelas::where('kode_kelas', $row[6])->first();
            $check_fakultas = Fakultas::where('kode_fakultas', $row[7])->first();
            $check_jurusan = Jurusan::where('kode_jurusan', $row[8])->first();
            $check_prodi = Prodi::where('kode_program_studi', $row[9])->first();
            $check_semester = Semester::where('nama_semester', $row[10])->first();
            $check_tahun_ajaran = TahunAjaran::where('nama_tahun_ajaran', $row[11])->first();

            // if($row[50] =="Ya"){
            //     $row[50] = "Aktif";
            // }else{
            //     $row[50] = "Tidak";
            // }

            if ($check_prodi == null) {
                $prodi_id = '';
            } else {
                $prodi_id = $check_prodi->id_prodi;
            }

            if ($check_fakultas == null || $check_jurusan == null || $check_semester == null || $check_tahun_ajaran == null) {
                $check_fakultas = '';
                $check_jurusan = '';
                $check_semester = '';
                $check_tahun_ajaran = '';
            }
            if ($check ) {

                $useremail = User::where('id', $check->user_id)->first();
                $useremail->update([
                    'name' => $row[1],
                    'email' => $row[26]
                ]);
                // $kelas_mahasiswa = KelasMahasiswa::where('user_id', $check->user_id)->first();
                // // dd($check_tahun_ajaran->id);
                // $kelas_mahasiswa->update([
                //     'id_kelas' => $check_kelas->id,
                //     'id_fakultas' => $check_fakultas->id,
                //     'id_jurusan' => $check_jurusan->id,
                //     'id_program_studi' => $check_prodi->id_prodi,
                //     'id_semester' => $check_semester->id,
                //     'id_tahun_ajaran' => $check_tahun_ajaran->id
                // ]);

                $check->update([
                    'nim' => $row[0],
                    // 'user_id' => $user->id, 
                    // 'photo' => null, 
                    'nama_mahasiswa' => $row[1],
                    'jenis_kelamin' => $row[2],
                    'tempat_lahir' => $row[3],
                    'tanggal_lahir' => $row[4],
                    // 'id_agama' => $id_agama,
                    'nama_agama' => $row[5],
                    'nik' => $row[12],
                    'nisn' => $row[13],
                    'npwp' => $row[14],
                    // 'id_negara' => 'ID',
                    'id_prodi' => $prodi_id,
                    'kelas_id'=> $check_kelas->id,
                    'kewarganegaraan' => $row[15],
                    'jalan' => $row[16],
                    'dusun' => $row[17],
                    'rt' => $row[18],
                    'rw' => $row[19],
                    'kelurahan' => $row[20],
                    'kode_pos' => $row[21],
                    // 'id_wilayah' => null,
                    'nama_kecamatan' => $row[22],
                    'nama_wilayah' => $row[23],
                    // 'id_jenis_tinggal' => null,
                    'nama_jenis_tinggal' => $row[27],
                    // 'id_alat_transportasi' => null,
                    'nama_alat_transportasi' => $row[28],
                    'telepon' => $row[24],
                    'handphone' => $row[25],
                    'email' => $row[26],
                    // 'penerima_kps' => null,
                    'nomor_kps' => $row[29],
                    'nik_ayah' => $row[30],
                    'nama_ayah' => $row[31],
                    'tanggal_lahir_ayah' => $row[32],
                    // 'id_pendidikan_ayah' => null,
                    'nama_pendidikan_ayah' => $row[33],
                    // 'id_pekerjaan_ayah' => null,
                    'nama_pekerjaan_ayah' => $row[34],
                    // 'id_penghasilan_ayah' => null,
                    'nama_penghasilan_ayah' => $row[35],
                    'nik_ibu' => $row[36],
                    'nama_ibu' => $row[37],
                    'tanggal_lahir_ibu' => $row[38],
                    // 'id_pendidikan_ibu' => null,
                    'nama_pendidikan_ibu' => $row[39],
                    // 'id_pekerjaan_ibu' => null,
                    'nama_pekerjaan_ibu' => $row[40],
                    // 'id_penghasilan_ibu' => null,
                    'nama_penghasilan_ibu' => $row[41],
                    'nama_wali' => $row[42],
                    'tanggal_lahir_wali' => $row[43],
                    // 'id_pendidikan_wali'=> null,
                    'nama_pendidikan_wali' => $row[44],
                    // 'id_pekerjaan_wali'=> null,
                    'nama_pekerjaan_wali' => $row[45],
                    // 'id_penghasilan_wali'=> null,
                    'nama_penghasilan_wali' => $row[46],
                    // 'id_kebutuhan_khusus_mahasiswa' => null,
                    'nama_kebutuhan_khusus_mahasiswa' => $row[47],
                    // 'id_kebutuhan_khusus_ayah' => null,
                    'nama_kebutuhan_khusus_ayah' => $row[48],
                    // 'id_kebutuhan_khusus_ibu' => null,
                    'nama_kebutuhan_khusus_ibu' => $row[49],
                    // 'id_status_mahasiswa' => $id_status_mahasiswa,
                    'nama_status_mahasiswa' => $row[50]
                ]);
            } else {
                $password = $row[0] . '@stikom2021';
                $user = User::create([
                    'name' => $row[1],
                    'email' => $row[26],
                    'password' => Hash::make($password)
                ]);

                // $kelas_mahasiswa = KelasMahasiswa::create([
                //     'user_id' => $user->id, 
                //     'id_kelas' => $check_kelas->id,
                //     'id_fakultas' => $check_fakultas->id,
                //     'id_jurusan' => $check_jurusan->id,
                //     'id_program_studi' => $check_prodi->id_prodi,
                //     'id_semester' => $check_semester->id,
                //     'id_tahun_ajaran' => $check_tahun_ajaran->id
                // ]);

                $siswaRole = Role::select('id')->where('name', 'mahasiswa')->first();

                $user->roles()->attach($siswaRole);

                Mahasiswa::create([
                    'nim' => $row[0],
                    'user_id' => $user->id,
                    // 'photo' => null, 
                    'nama_mahasiswa' => $row[1],
                    'jenis_kelamin' => $row[2],
                    'tempat_lahir' => $row[3],
                    'tanggal_lahir' => $row[4],
                    // 'id_agama' => $id_agama,
                    'nama_agama' => $row[5],
                    'id_prodi' => $prodi_id,
                    'kelas_id'=> $check_kelas->id,
                    'nik' => $row[12],
                    'nisn' => $row[13],
                    'npwp' => $row[14],
                    // 'id_negara' => 'ID',
                    'kewarganegaraan' => $row[15],
                    'jalan' => $row[16],
                    'dusun' => $row[17],
                    'rt' => $row[18],
                    'rw' => $row[19],
                    'kelurahan' => $row[20],
                    'kode_pos' => $row[21],
                    // 'id_wilayah' => null,
                    'nama_kecamatan' => $row[22],
                    'nama_wilayah' => $row[23],
                    // 'id_jenis_tinggal' => null,
                    'nama_jenis_tinggal' => $row[27],
                    // 'id_alat_transportasi' => null,
                    'nama_alat_transportasi' => $row[28],
                    'telepon' => $row[24],
                    'handphone' => $row[25],
                    'email' => $row[26],
                    // 'penerima_kps' => null,
                    'nomor_kps' => $row[29],
                    'nik_ayah' => $row[30],
                    'nama_ayah' => $row[31],
                    'tanggal_lahir_ayah' => $row[32],
                    // 'id_pendidikan_ayah' => null,
                    'nama_pendidikan_ayah' => $row[33],
                    // 'id_pekerjaan_ayah' => null,
                    'nama_pekerjaan_ayah' => $row[34],
                    // 'id_penghasilan_ayah' => null,
                    'nama_penghasilan_ayah' => $row[35],
                    'nik_ibu' => $row[36],
                    'nama_ibu' => $row[37],
                    'tanggal_lahir_ibu' => $row[38],
                    // 'id_pendidikan_ibu' => null,
                    'nama_pendidikan_ibu' => $row[39],
                    // 'id_pekerjaan_ibu' => null,
                    'nama_pekerjaan_ibu' => $row[40],
                    // 'id_penghasilan_ibu' => null,
                    'nama_penghasilan_ibu' => $row[41],
                    'nama_wali' => $row[42],
                    'tanggal_lahir_wali' => $row[43],
                    // 'id_pendidikan_wali'=> null,
                    'nama_pendidikan_wali' => $row[44],
                    // 'id_pekerjaan_wali'=> null,
                    'nama_pekerjaan_wali' => $row[45],
                    // 'id_penghasilan_wali'=> null,
                    'nama_penghasilan_wali' => $row[46],
                    // 'id_kebutuhan_khusus_mahasiswa' => null,
                    'nama_kebutuhan_khusus_mahasiswa' => $row[47],
                    // 'id_kebutuhan_khusus_ayah' => null,
                    'nama_kebutuhan_khusus_ayah' => $row[48],
                    // 'id_kebutuhan_khusus_ibu' => null,
                    'nama_kebutuhan_khusus_ibu' => $row[49],
                    // 'id_status_mahasiswa' => $id_status_mahasiswa,
                    'nama_status_mahasiswa' => $row[50]
                ]);
            }
        }
    }


    public function headingRow(): int
    {
        return 2;
    }

    public function startRow(): int
    {
        return 2;
    }
}
