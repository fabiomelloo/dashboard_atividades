<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtividadeRequest extends FormRequest
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
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_atividade' => 'required|date',
            'data_conclusao' => 'nullable|date',
            'status' => 'required|string',
            'prioridade' => 'required|string',
            'responsavel' => 'nullable|string|max:255',
            'solicitante' => 'nullable|string|max:255',
        ];
    }
}
