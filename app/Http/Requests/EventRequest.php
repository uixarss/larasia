<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EventRequest extends FormRequest
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
            'start' => 'date_format:Y-m-d H:i:s|before:end',
            'end' => 'date_format:Y-m-d H:i:s|after:start',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Masukan Judul Remainder Akademik !',
            'title.min' => 'Judul Remainder Harus Lebih Dari 3 Huruf !',
            'start.date_format' => 'Masukan Tanggal Mulai dengan benar !',
            'start.before' => 'Tanggal/Waktu Selesai Harus Kurang dari Tanggal Selesai !',
            'end.date_format' => 'Masukan Tanggal Selesai dengan benar !',
            'end.after' => 'Tanggal/Waktu Selesai Harus Lebih dari Tanggal Selesai !',
        ];
    }
}
