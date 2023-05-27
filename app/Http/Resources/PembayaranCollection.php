<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class PembayaranCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $pembayarans = array();
        foreach ($this->resource as $pembayaran) {
            $pembayarans[] = array(
                'id' => $pembayaran->id,
                'tahun_ajaran' => $pembayaran->tahunAjaran->nama_tahun_ajaran,
                'semester' => $pembayaran->semester->nama_semester,
                'prodi' => $pembayaran->prodi->nama_program_studi,
                'nama_tagihan' => $pembayaran->nama_tagihan,
                'catatan' => $pembayaran->catatan,
                'deadline' => $pembayaran->deadline,
                'jumlah_tagihan' => $pembayaran->jumlah_tagihan,
                'status' => $pembayaran->status,
                'created_at' => $pembayaran->created_at,
            );
        }
        return $pembayarans;
    }
}
