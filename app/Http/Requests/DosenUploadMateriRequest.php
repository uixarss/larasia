<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DosenUploadMateriRequest extends FormRequest
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
            'bab_materi' => 'required',
            'nama_materi' => 'required',
            'deskripsi_materi' => 'required',
            'file_materi' => 'required|max:2000|mimes:doc,pdf,docx'
        ];
    }

    public function messages()
    {
        return [
            'bab_materi.required' => 'Cantumkan BAB Materi Anda',
            'nama_materi.required' => 'Cantumkan Nama Materi Anda',
            'deskripsi_materi.required' => 'Tuliskan Deskripsi Materi Anda',
            'file_materi.required' => 'Wajib lampirkan file materi Anda. Rekomendasi format file: doc, docx, pdf',
            'file_materi.max' => 'Ukuran maksimal file 2MB',
            'file_materi.mimes' => 'Rekomedasi format file: doc, docx, pdf'
        ];
    }
}
