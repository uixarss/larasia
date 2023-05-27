<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DataBukuDistributorRequest extends FormRequest
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
            'jumlah_buku' => 'required|numeric|min:1',
            'tanggal_masuk' => 'required|date',
            'distributor_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'jumlah_buku.required' => 'Silahkan tulis jumlah buku',
            'jumlah_buku.numeric' => 'Hanya angka',
            'jumlah_buku.min' => 'Minimal jumlah stok 1',
            'tanggal_masuk.required' => 'Cantumkan tanggal masuk',
            'tanggal_masuk.date' => 'Pilih tanggal masuk',
            'distributor_id' => 'Pastikan distributor dipilih'
        ];
    }
}
