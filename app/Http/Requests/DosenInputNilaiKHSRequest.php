<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DosenInputNilaiKHSRequest extends FormRequest
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
            'mutu' => 'required',
            'nilai' => 'required|numeric|min:0|max:4'
        ];
    }

    public function messages()
    {
        return [
            'mutu.required' => 'Input Huruf Mutu. Contoh : A/B/C/D',
            'nilai.required' => 'Input nilai. Contoh : 4.00',
            'nilai.numeric' => 'Hanya menerima input angka 0.00 - 4.00',
            'nilai.min' => 'Input tidak dibawah 0',
            'nilai.max' => 'Input maksimal 4.00'
        ];
    }
}
