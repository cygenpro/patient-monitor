<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'to_id' => 'required|integer',
            'temperature' => 'required|numeric',
            'has_cough' => 'required|integer',
            'has_hard_breath' => 'required|integer',
            'has_sore_throat' => 'required|integer',
            'has_diarrhea' => 'required|integer',
            'has_tiredness' => 'required|integer',
        ];
    }
}
