<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => 'required|string|max:40',
            'publisher' => 'required|string|max:40',
            'edition' => 'required|integer',
            'publication_year' => 'required|digits:4',
            'price' => 'required|decimal:0,2',
            'author_id' => 'required|array',
            'subject_id' => 'nullable|array',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O campo "Titulo" é obrigatório.',
            'title.string' => 'Digite um titulo válido.',
            'title.max' => 'O titulo deve ter no máximo :max caracteres.',
            'publisher.required' => 'O campo "Editora" é obrigatório.',
            'publisher.string' => 'Digite uma editora válida.',
            'publisher.max' => 'A editora deve ter no máximo :max caracteres.',
            'edition.required' => 'O campo "Edição" é obrigatório.',
            'edition.integer' => 'A edição deve ser um número inteiro.',
            'publication_year.required' => 'O campo "Ano de Publicação" é obrigatório.',
            'publication_year.digits' => 'O ano de publicação deve conter apenas números.',
            'price.required' => 'O campo "Preço" é obrigatório.',
            'price.decimal' => 'O preço deve ser um número decimal.',
            'author_id.required' => 'O campo "Autor" é obrigatório.',
            'author_id.array' => 'Selecione pelo menos um autor.',
            'subject_id.required' => 'O campo "Assunto" é obrigatório.',
            'subject_id.array' => 'Selecione pelo menos um assunto.',
        ];
    }
}
