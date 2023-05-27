<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ListRemainderRequest extends FormRequest
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
            'title' => 'required|min:3',
            'start' => 'date_format:H:i:s|before:end',
            'end' => 'date_format:H:i:s|after:start',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Masukan Judul List Remainder !',
            'title.min' => 'Judul List Remainder Harus Lebih Dari 3 Huruf !',
            'start.date_format' => 'Masukan Jam Mulai dengan benar !',
            'start.before' => 'Jam Selesai Harus Kurang dari Tanggal Selesai !',
            'end.date_format' => 'Masukan Jam Selesai dengan benar !',
            'end.after' => 'Jam Selesai Harus Lebih dari Tanggal Selesai !',
        ];
    }
}
