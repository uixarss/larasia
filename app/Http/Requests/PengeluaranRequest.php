<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PengeluaranRequest extends FormRequest
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
            'nama' => 'required|string',
            'biaya_id' => 'required|numeric|min:1',
            'amount' => 'required|min:1|numeric',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'transfer_via' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Tulis nama pengeluaran.',
            'nama.string' => 'Tulis nama pengeluaran.',
            'amount.required' => 'Masukkan jumlah nominal biaya tersebut.',
            'amount.min' => 'Masukkan jumlah nominal minimal Rp 1.',
            'amount.numeric' => 'Masukkan jumlah nominal dengan angka saja.',
            'biaya_id.required' => 'Pilih jenis biaya.',
            'biaya_id.min' => 'Pilih jenis biaya.',
            'biaya_id.numeric' => 'Pilih jenis biaya.',
            'tanggal.required' => 'Pilih tanggal.',
            'tanggal.date' => 'Pilih tanggal.',
            'deskripsi.required' => 'Tulis deskripsi pengeluaran.',
            'deskripsi.string' => 'Tulis deskripsi pengeluaran.',
            'transfer_via.required' => 'Pilih metode pembayaran.',
            'transfer_via.string' => 'Pilih metode pembayaran.',
        ];
    }
}
