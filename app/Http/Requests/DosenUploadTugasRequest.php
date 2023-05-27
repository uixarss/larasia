<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DosenUploadTugasRequest extends FormRequest
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
            'kode_tugas' => 'required',
            'judul_tugas' => 'required',
            'deskripsi_tugas' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_akhir' => 'required',
            'id_kelas' => 'required',
            'file_tugas' => 'required|max:2000|mimes:doc,pdf,docx'
        ];
    }

    public function messages()
    {
        return [
            'kode_tugas.required' => 'Wajib cantumkan kode tugas Anda sendiri',
            'judul_tugas.required' => 'Wajib cantumkan judul tugas',
            'deskripsi_tugas.required' => 'Cantumkan deskripsi tugas Anda',
            'tanggal_mulai.required' => 'Jangan lupa pilih tanggal mulai',
            'tanggal_akhir.required' => 'Jangan lupa pilih tanggal deadline',
            'id_kelas.required' => 'Pilih salah satu kelas',
            'file_tugas.required' => 'File wajib dilampirkan. Rekomendasi format file: doc, pdf, docx',
            'file_tugas.max' => 'Ukuran file maksimal 2MB',
            'file_tugas.mimes' => 'Rekomendasi format file: doc, pdf, docx'
        ];
    }
}
