<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitanteRequest extends FormRequest
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
        $rules = [
            'nome' => 'required',
            'telefone' => 'required|celular_com_ddd',
            'email' => ['required', 'email'],
        ];
        if ($this->method() == 'PATCH' || $this->method() == 'PUT'){
            array_push($rules['email'], 'unique:visitantes,email,'.$this->visitante->id);

        }
        else{
            array_push($rules['email'], 'unique:visitantes');
        }
        return $rules;
    }
}
