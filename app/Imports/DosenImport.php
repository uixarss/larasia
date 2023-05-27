<?php

namespace App\Imports;

use App\Models\Dosen;
use App\Role;
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class DosenImport implements ToCollection, WithStartRow, WithBatchInserts, WithChunkReading
{
    /**
     * @param array $row
     *
    * @return \Illuminate\Database\Eloquent\Model|null
     */ 
    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            
            $check = Dosen::where('nidn', $row[0] )->first();

            if ($row[20] == null) {
                $row[20] = $row[0].'@stikompoltek.ac.id';
            }

            if($check){
                $useremail = User::where('id', $check->user_id )->first();
                
                $useremail->update([
                    'name' => $row[1],
                    'email' => $row[20]
                ]);

                if($row[33]=="Ya"){
                    $mampu_handle_kebutuhan_khusus = 1;
                }else{
                    $mampu_handle_kebutuhan_khusus = 0;
                }
                if($row[34]=="Ya"){
                    $mampu_handle_braille = 1;
                }else{
                    $mampu_handle_braille = 0;
                }
                if($row[35]=="Ya"){
                    $mampu_handle_bahasa_isyarat = 1;
                }else{
                    $mampu_handle_bahasa_isyarat = 0;
                }

                $check->update([
                    'nidn' => $row[0],
                    'nama_dosen' => $row[1],
                    'jenis_kelamin' => $row[2],
                    'tempat_lahir' => $row[3],
                    'tanggal_lahir' => $row[4],
                    'nama_agama' => $row[5],
                    'nik' => $row[6],
                    'nip' => $row[7],
                    'npwp' => $row[8],
                    'kewarganegaraan' => $row[9],
                    'jalan' => $row[10],
                    'dusun' => $row[11],
                    'rt' => $row[12],
                    'rw' => $row[13],
                    'ds_kel' => $row[14],
                    'kode_pos' => $row[15],
                    'nama_kecamatan' => $row[16],
                    'nama_wilayah' => $row[17],
                    'telepon' => $row[18],
                    'handphone' => $row[19],
                    'email' => $row[20],
                    'nama_ibu' => $row[21],
                    'no_sk_cpns' => $row[22],
                    'tanggal_sk_cpns' => $row[23],
                    'no_sk_pengangkatan' => $row[24],
                    'mulai_sk_pengangkatan' => $row[25],
                    'nama_lembaga_pengangkatan' => $row[26],
                    'tanggal_mulai_pns' => $row[27],
                    'nama_pangkat_golongan' => $row[28],
                    'nama_sumber_gaji' => $row[29],
                    'nama_suami_istri' => $row[30],
                    'nip_suami_istri' => $row[31],
                    'nama_pekerjaan_suami_istri' => $row[32],
                    'mampu_handle_kebutuhan_khusus' => $mampu_handle_kebutuhan_khusus,
                    'mampu_handle_braille' => $mampu_handle_braille,
                    'mampu_handle_bahasa_isyarat' => $mampu_handle_bahasa_isyarat,
                    'nama_status_aktif' => $row[36]
                ]);

            }else{
                $password = $row[0].'@stikom2021';
                $user = User::create([
                    'name' => $row[1],
                    'email' => $row[20],
                    'password' => Hash::make($password)
                ]);
                
                $role = Role::select('id')->where('name', 'dosen')->first();
                
                $user->roles()->attach($role);

                if($row[33]=="Ya"){
                    $mampu_handle_kebutuhan_khusus = 1;
                }else{
                    $mampu_handle_kebutuhan_khusus = 0;
                }
                if($row[34]=="Ya"){
                    $mampu_handle_braille = 1;
                }else{
                    $mampu_handle_braille = 0;
                }
                if($row[35]=="Ya"){
                    $mampu_handle_bahasa_isyarat = 1;
                }else{
                    $mampu_handle_bahasa_isyarat = 0;
                }

                Dosen::create([

                    'nidn' => $row[0],
                    'user_id' => $user->id, 
                    'nama_dosen' => $row[1],
                    'jenis_kelamin' => $row[2],
                    'tempat_lahir' => $row[3],
                    'tanggal_lahir' => $row[4],
                    'nama_agama' => $row[5],
                    'nik' => $row[6],
                    'nip' => $row[7],
                    'npwp' => $row[8],
                    'kewarganegaraan' => $row[9],
                    'jalan' => $row[10],
                    'dusun' => $row[11],
                    'rt' => $row[12],
                    'rw' => $row[13],
                    'ds_kel' => $row[14],
                    'kode_pos' => $row[15],
                    'nama_kecamatan' => $row[16],
                    'nama_wilayah' => $row[17],
                    'telepon' => $row[18],
                    'handphone' => $row[19],
                    'email' => $row[20],
                    'nama_ibu' => $row[21],
                    'no_sk_cpns' => $row[22],
                    'tanggal_sk_cpns' => $row[23],
                    'no_sk_pengangkatan' => $row[24],
                    'mulai_sk_pengangkatan' => $row[25],
                    'nama_lembaga_pengangkatan' => $row[26],
                    'tanggal_mulai_pns' => $row[27],
                    'nama_pangkat_golongan' => $row[28],
                    'nama_sumber_gaji' => $row[29],
                    'nama_suami_istri' => $row[30],
                    'nip_suami_istri' => $row[31],
                    'nama_pekerjaan_suami_istri' => $row[32],
                    'mampu_handle_kebutuhan_khusus' => $mampu_handle_kebutuhan_khusus,
                    'mampu_handle_braille' => $mampu_handle_braille,
                    'mampu_handle_bahasa_isyarat' => $mampu_handle_bahasa_isyarat,
                    'nama_status_aktif' => $row[36]

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
