<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivroRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'Titulo'        => 'required|max:255',
            'Editora'       => 'required|max:255',
            'Edicao'        => 'required|integer',
            'AnoPublicacao' => 'required|integer',
            //'Valor' => ['required', 'string', 'regex:/^\s*R?\$?\s*\d{1,3}(\.\d{3})*(,\d{2})?\s*$/'],
            'Valor' => ['required', 'string', 'regex:/^\s*R?\$?\s*\d{1,3}(\.\d{3})*(\d{3})?(,\d{2})?\s*$/'],
            'Autores'       => 'required|array',
            'Autores.*'     => 'exists:Autor,CodAu',
            'Assuntos'      => 'required|array',
            'Assuntos.*'    => 'exists:Assunto,CodAs'
        ];
    }

    public function messages(): array
    {
        return [
            'Titulo.required'           => 'O título é obrigatório.',
            'Editora.required'          => 'A editora é obrigatória.',
            'Edicao.required'           => 'A edição é obrigatória.',
            'AnoPublicacao.required'    => 'O ano de publicação é obrigatório.',
            'Valor.regex'               => 'O valor deve estar no formato correto (ex: R$ 1.234,56).',
            'Autores.required'          => 'É necessário selecionar pelo menos um autor.',
            'Autores.*.exists'          => 'O autor selecionado não existe.',
            'Assuntos.required'         => 'É necessário selecionar pelo menos um assunto.',
            'Assuntos.*.exists'         => 'O assunto selecionado não existe.'
        ];
    }
}
