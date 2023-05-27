<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateNilaiKhsRequest extends FormRequest
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
            'id' => 'required',
            'mutu' => 'required|string|min:1|max:2',
            'nilai' => 'required|numeric|min:1|max|4',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Tidak ada data. Pilih mata kuliah.',
            // 'id.numeric' => 'Pilih mata kuliah.',
            'mutu.required' => 'Cantumkan mutu. Contoh : A / B / C / D atau mutunya sesuai dengan aturan.',
            'mutu.string' => 'Contoh : A / B / C / D atau mutunya sesuai dengan aturan.',
            'mutu.min' => 'Mutu : Minimal 1 karakter.',
            'mutu.max' => 'Mutu : Maksimal 2 karakter',
            'nilai.required' => 'Nilai : Cantumkan nilai.',
            'nilai.numeric' => 'Nilai : Hanya menerima angka.',
            'nilai.min' => 'Nilai: Minimal 1.0',
            'nilai.max' => 'Nilai: Maksimal 4.0'
        ];
    }
}
