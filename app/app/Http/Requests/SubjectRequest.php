<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
            'description' => [
                'required',
                'string',
                'max:20'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'O campo "Assunto" é obrigatório.',
            'description.string' => 'Digite um assunto válida.',
            'description.max' => 'O assunto deve ter no máximo :max caracteres.',
        ];
    }
}
