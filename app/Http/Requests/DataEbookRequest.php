<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DataEbookRequest extends FormRequest
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
            'penerbit' => 'required',
            'tanggal_terbit' => 'required',
            'ISBN' => 'required|unique:data_ebook',
            'judul_buku' => 'required',
            'kategori_ebook_id' => 'required',
            'penulis' => 'required',
            'file_ebook' => 'required|max:2048|mimes:pdf',
            'deskripsi_buku' => 'required'
        ];
    } 

    public function messages()
    {
        return [
            'ISBN.required' => 'Isi ISBN',
            'ISBN.unique' => 'Periksa ISBN. Tidak bisa duplikat.',
            'judul_buku.required' => 'Tulis judul buku',
            'kategori_ebook_id.required' => 'Pilih kategori buku',
            'penulis.required' => 'Tulis nama penulis',
            'penerbit.required' => 'Tulis nama penerbit',
            'tanggal_terbit.required' => 'Pilih tanggal terbit',
            'deskripsi_buku.required' => 'Tulis deskripsi buku',
            'file_ebook.required' => 'Lampirkan file ebook format PDF',
            'file_ebook.max' => 'Ukuran file maksimal 2MB',
            'file_ebook.mimes' => 'Hanya menerima file ebook format PDF',
        ];
    }
}
