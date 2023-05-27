<?php

namespace App\Http\Requests;

use App\Models\Dosen;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class DosenStoreAgendaRequest extends FormRequest
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

        $guru= Dosen::where('user_id', Auth::id())->first();

        return [
            'tahun_ajaran' => 'required',
            'semester' => 'required',
            'mapel_id' => [Rule::unique('agendas')->where(function ($query) use ($request, $guru) {
                return $query->where('id_prodi', $request->id_prodi)
                    ->where('tahun_ajaran', $request->tahun_ajaran)
                    ->where('mapel_id', $request->mapel_id)
                    ->where('guru_id', $guru->id)
                    ->where('semester', $request->semester);
            }),'required']
        ];
    }

    public function messages()
    {
        return [

        ];
        
    }
}
