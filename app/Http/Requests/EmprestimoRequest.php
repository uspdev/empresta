<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmprestimoRequest extends FormRequest
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
            'codpes' => ['integer','required_without:visitante_id','nullable'],
            'visitante_id' => ['integer','required_without:codpes','nullable'],
            'material_id' => 'integer|required',
        ];
    }
}
