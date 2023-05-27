<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UploadTugasRequest extends FormRequest
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
            'file_tugas' => 'required|max:2000|mimes:doc,pdf,docx'
        ];
    }

    public function messages()
    {
        return [
            'file_tugas.required' => 'File wajib dilampirkan',
            'file_tugas.max' => 'Ukuran file maksimal 2MB',
            'file_tugas.mimes' => 'Rekomendasi format file: doc, pdf, docx'
        ];
    }
}
