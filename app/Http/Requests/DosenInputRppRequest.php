<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DosenInputRppRequest extends FormRequest
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
            'id_rpp' => 'required',
            'bab' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id_rpp.required' => 'Cantumkan id rpp Anda sendiri',
            'bab.required' => 'Tulis Bab yang Anda rancang',
            'judul.required' => 'Cantumkan judul RPP yang ingin Anda rancang',
            'deskripsi.required' => 'Tuliskan deskripsi RPP yang ingin Anda rancang',
        ];
    }
}
