<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DistributorBukuRequest extends FormRequest
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
            'kode_distributor' => 'required|unique:distributor_buku',
            'nama_distributor' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'kode_distributor.required' => 'Tulis kode distributor',
            'kode_distributor.unique' => 'Tulis kode distributor yang berbeda',
            'nama_distributor.required' => 'Tulis nama distributor'
        ];
    }
}
