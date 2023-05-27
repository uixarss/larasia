<?php

namespace App\Imports;

use App\Models\MataPelajaran;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class MatkulImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading
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
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {

            $check = MataPelajaran::where('kode_mapel', $row['kdmatkul'] )->first();

            if ($check != null) {
                $check->nama_mapel = $row['nama_matkul'];
                $check->jumlah_sks = $row['sks'];
                $check->jumlah_jam = $row['sks'];
                $check->type = $row['jenis'];
                $check->save();
            } else {
                $new_matkul = new MataPelajaran;
                $new_matkul->kode_mapel = $row['kdmatkul'];
                $new_matkul->nama_mapel = $row['nama_matkul'];
                $new_matkul->jumlah_sks = $row['sks'];
                $new_matkul->jumlah_jam = $row['sks'];
                $new_matkul->type = $row['jenis'];
                $new_matkul->save();
            }
        }
    }
    
    public function chunkSize(): int
    {
        return 1000;
    }
}