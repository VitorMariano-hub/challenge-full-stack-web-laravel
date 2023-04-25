<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        /**
         *  Método PUT/PATCH (atualização). SOMETIMES aplica somente se o parametro estiver presente na requisição,
         *  FILLED verifica se o valor esta presente e não é nulo
         * */
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return [
                'name' => 'sometimes|filled|max:100',
                'email' => 'sometimes|filled|max:100',
                'ra' => 'sometimes|filled|unique:students|max:10',
                'cpf' => 'sometimes|filled|unique:students|max:10',
            ];
        }
        // Método POST (criação)
        else {
            return [
                'name' => 'required|max:100',
                'email' => 'required|max:100',
                'ra' => 'required|unique:students|max:10',
                'cpf' => 'required|unique:students|max:10',
            ];
        }
    }
}
