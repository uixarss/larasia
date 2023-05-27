<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MahasiswaEkstensiRequest extends FormRequest
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
            'tahun_ajaran_id' => 'required|numeric',
            'semester_id' => 'required|numeric',
            'prodi_id' => 'required|numeric',
            'mapel_id' => 'required|numeric',
            'dosen_id' => 'required|numeric',
            'kelas_id' => 'required|numeric',
            'tingkat_semester' => 'required|integer|min:1|max:14'
        ];
    }

    public function messages()
    {
        return [
            'tahun_ajaran_id.required' => 'Piilh tahun ajaran.',
            'tahun_ajaran_id.numeric' => 'Pilih tahun ajaran.',
            'semester_id.required' => 'Piilh semester.',
            'semester_id.numeric' => 'Pilih semester.',
            'prodi_id.required' => 'Piilh program studi',
            'prodi_id.numeric' => 'Pilih program studi',
            'mapel_id.required' => 'Piilh mata kuliah.',
            'mapel_id.numeric' => 'Pilih mata kuliah.',
            'dosen_id.required' => 'Piilh dosen.',
            'dosen_id.numeric' => 'Pilih dosen.',
            'kelas_id.required' => 'Piilh kelas.',
            'kelas_id.numeric' => 'Pilih kelas.',
            'tingkat_semester.required' => 'Piilh tingkat semester',
            'tingkat_semester.integer' => 'Hanya angka bulat',
            'tingkat_semester.min' => 'Minimal 1.',
            'tingkat_semester.max' => 'Maksimal 14.',
        ];
    }
}
