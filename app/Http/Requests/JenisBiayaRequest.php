<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class JenisBiayaRequest extends FormRequest
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
            'nama' => 'required|unique:jenis_biayas'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama jenis biaya wajib diisi.',
            'nama.unique' => 'Nama jenis biaya sudah ada.'
        ];
    }
}
