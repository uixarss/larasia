<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MasterBiayaRequest extends FormRequest
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
            'kode' => 'required|unique:master_biayas',
            'nama' => 'required|unique:master_biayas',
            'kode_jurusan' => 'required',
            'tahun_ajaran' => 'required',
            'semester' => 'required|min:1|max:10|integer'
        ];
    }

    public function messages()
    {
        return [
            'kode.required' => 'Kode wajib diisi.',
            'kode.unique' => 'Kode sudah ada.',
            'nama.required' => 'Nama Master Biaya wajib diisi.',
            'nama.unique' => 'Nama Master Biaya sudah ada.',
            'kode_jurusan.required' => 'Jurusan wajib dipilih.',
            'tahun_ajaran.required' => 'Tahun Ajaran wajib diisi.',
            'semester.required' => 'Semester wajib diisi.',
            'semester.integer' => 'Semester wajib angka.',
            'semester.min' => 'Semester minimal 1.',
            'semester.max' => 'Semester maksimal 10.'
        ];
    }
}
