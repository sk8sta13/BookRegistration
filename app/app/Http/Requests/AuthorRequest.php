<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->route('id'); 

        return [
            'name' => "required|string|max:255|unique:authors,name,$id"
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo "Nome do Autor" é obrigatório.',
            'name.string' => 'Digite um nome válido para o Autor.',
            'name.max' => 'O Nome do Autor deve ter no máximo :max caracteres.',
            'name.unique' => 'O Nome do Autor já existe.',
        ];
    }
}
