<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Material;

class MaterialRequest extends FormRequest
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
            'ativo' => 'required|integer',
            'codigo' => ['required', 'min:3'],
            'categoria_id' => 'required',
            'descricao' => 'required',
            'devolucao' => 'required'
        ];

        if($this->input('devolucao') == 1)
            $rules['prazo'] = 'required|integer|min:2';

        if ($this->method() == 'PATCH' || $this->method() == 'PUT'){
            array_push($rules['codigo'], 'unique:materials,codigo,'.$this->material->id);

        }
        else{
            array_push($rules['codigo'], 'unique:materials');
        }
        return $rules;
    }
}
