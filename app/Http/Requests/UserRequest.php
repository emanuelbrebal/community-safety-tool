<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name'     => 'required|string|min:3|max:30',
            'surname'        => 'required|string|min:3|max:120',
            'cpf'            => ['required', 'string', 'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/'],
            'gender_id'      => 'required|numeric',
            'email'          => 'required|email|max:255',
            'mobile_number'  => ['required', 'string', 'regex:/^\(\d{2}\) \d{5}-\d{4}$/'],
            'born_date'      => 'required|date_format:d/m/Y',
            'address_id'     => 'required|numeric',
        ];
    }
    public function messages(): array
    {
        return [
            'first_name.required'     => 'O primeiro nome é obrigatório.',
            'first_name.string'       => 'O primeiro nome deve ser um texto.',
            'first_name.min'          => 'O primeiro nome deve ter no mínimo 3 caracteres.',
            'first_name.max'          => 'O primeiro nome deve ter no máximo 30 caracteres.',
    
            'surname.required'        => 'O sobrenome é obrigatório.',
            'surname.string'          => 'O sobrenome deve ser um texto.',
            'surname.min'             => 'O sobrenome deve ter no mínimo 3 caracteres.',
            'surname.max'             => 'O sobrenome deve ter no máximo 120 caracteres.',
    
            'cpf.required'            => 'O CPF é obrigatório.',
            'cpf.string'              => 'O CPF deve ser uma string.',
            'cpf.regex'               => 'O CPF deve estar no formato 000.000.000-00.',
    
            'gender_id.required'      => 'O campo gênero é obrigatório.',
            'gender_id.numeric'       => 'O gênero deve ser um número válido.',
    
            'email.required'          => 'O e-mail é obrigatório.',
            'email.email'             => 'O e-mail deve ser um endereço válido.',
            'email.max'               => 'O e-mail deve ter no máximo 255 caracteres.',
    
            'mobile_number.required'  => 'O número de celular é obrigatório.',
            'mobile_number.string'    => 'O número de celular deve ser uma string.',
            'mobile_number.regex'     => 'O número de celular deve estar no formato (00) 00000-0000.',
    
            'born_date.required'      => 'A data de nascimento é obrigatória.',
            'born_date.date_format'   => 'A data de nascimento deve estar no formato dd/mm/aaaa.',
    
            'address_id.required'     => 'O endereço é obrigatório.',
            'address_id.numeric'      => 'O endereço deve ser um número válido.',
        ];
    }
}
