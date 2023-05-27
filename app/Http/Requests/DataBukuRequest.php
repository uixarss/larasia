<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DataBukuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ISBN' => 'required|unique:data_buku',
            'judul_buku' => 'required',
            'kategori_buku_id' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tanggal_terbit' => 'required',
            'deskripsi' => 'required',
            'stok_buku' => 'required|numeric|min:1',
            'distributor_buku_id' => 'required|numeric',
            'tanggal_masuk' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'ISBN.required' => 'Isi ISBN',
            'ISBN.unique' => 'Periksa ISBN. Tidak bisa duplikat.',
            'judul_buku.required' => 'Tulis judul buku',
            'kategori_buku_id.required' => 'Pilih kategori buku',
            'penulis.required' => 'Tulis nama penulis',
            'penerbit.required' => 'Tulis nama penerbit',
            'tanggal_terbit.required' => 'Pilih tanggal terbit',
            'deskripsi.required' => 'Tulis deskripsi buku',
            'stok_buku.required' => 'Tulis jumlah buku',
            'stok_buku.numeric' => 'Tulis angka',
            'stok_buku.min' => 'Minimal buku 1',
            'distributor_buku_id.required' => 'Pilih nama distributor',
            'tanggal_masuk.required' => 'Pilih tanggal masuk'
        ];
    }
}
