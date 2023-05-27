<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class NilaiTugasRequest extends FormRequest
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
            'nilai_tugas' => 'required|numeric|min:0|max:100'
        ];
    }

    public function messages()
    {
        return[
            'nilai_tugas.required' => 'Wajib isi nilai',
            'nilai_tugas.numeric' => 'Input angka saja',
            'nilai_tugas.min' => 'Maaf. Isi angka lebih dari sama dengan 0',
            'nilai_tugas.max' => 'Maaf. Isi angka tidak lebih dari 100'
        ];
    }
}
