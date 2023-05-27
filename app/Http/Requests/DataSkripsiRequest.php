<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DataSkripsiRequest extends FormRequest
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
            'judul' => 'required',
            'metode' => 'required',
            'tahun' => 'required|numeric',
            'prodi' => 'required|numeric',
            'nrp' => 'required|numeric|unique:data_skripsi',
            'rak' => 'required|numeric',
            'baris' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'judul.required' => 'Tulis judul skripsi',
            'metode.required' => 'Tulis metode skripsi',
            'tahun.required' => 'Tulis tahun terbit skripsi',
            'tahun.numeric' => 'Tahun terbit gunakan angka.',
            'prodi.required' => 'Pilih program studi',
            'prodi.numeric' => 'Pilih program studi',
            'nrp.required' => 'Pilih mahasiswa berdasarkan nrp/nim mahasiswa',
            'nrp.numeric' => 'Pilih mahasiswa berdasarkan nrp/nim mahasiswa',
            'nrp.unique' => 'NRP tersebut sudah ada di data skripsi, periksa kembali',
            'rak.required' => 'Isi kolom rak.',
            'rak.numeric' => 'Rak rukup tulis angka.',
            'baris.required' => 'Isi kolom baris.',
            'baris.numeric' => 'Baris cukup tulis angka.',
        ];
    }
}
