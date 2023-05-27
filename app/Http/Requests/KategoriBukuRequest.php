<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class KategoriBukuRequest extends FormRequest
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
            'kode_kategori' => 'required|unique:kategori_buku',
            'nama_kategori' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'kode_kategori.required' => 'Tulis kode kategori',
            'kode_kategori.unique' => 'Tulis kode kategori yang berbeda',
            'nama_kategori.required' => 'Tulis nama kategori'
        ];
    }
}
