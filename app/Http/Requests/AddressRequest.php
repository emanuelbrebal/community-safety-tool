<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'community_id'     => 'required|numeric',
            'zip_code' => ['required', 'string', 'regex:/^\d{5}-\d{3}$/'],
            'state'            => 'required|string|max:255',
            'municipality'      => 'required|string|max:255',
            'public_place'          => 'required|string|max:255',
            'street'  => 'required|string|max:255',
            'number'      => 'required|numeric|max:10',
            'complement'    => 'nullable|string|max:255',
            'user_id'     => 'required|numeric',
            'housing_profile'     => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'community_id.required'     => 'O campo comunidade é obrigatório.',
            'community_id.numeric'      => 'A comunidade deve ser um número válido.',

            'zip_code.required'         => 'O CEP é obrigatório.',
            'zip_code.string'           => 'O CEP deve ser uma string.',
            'zip_code.regex'            => 'O CEP deve estar no formato 00000-000.',

            'state.required'            => 'O estado é obrigatório.',
            'state.string'              => 'O estado deve ser uma string.',
            'state.max'                 => 'O estado deve ter no máximo 255 caracteres.',

            'municipality.required'     => 'O município é obrigatório.',
            'municipality.string'       => 'O município deve ser uma string.',
            'municipality.max'          => 'O município deve ter no máximo 255 caracteres.',

            'public_place.required'     => 'O local público é obrigatório.',
            'public_place.string'       => 'O local público deve ser uma string.',
            'public_place.max'          => 'O local público deve ter no máximo 255 caracteres.',

            'street.required'           => 'A rua é obrigatória.',
            'street.string'             => 'A rua deve ser uma string.',
            'street.max'                => 'A rua deve ter no máximo 255 caracteres.',

            'number.required'           => 'O número é obrigatório.',
            'number.numeric'            => 'O número deve ser um valor numérico.',
            'number.max'                => 'O número deve ter no máximo 10 caracteres.',

            'complement.nullable'       => 'O complemento pode ser vazio.',
            'complement.string'         => 'O complemento deve ser uma string.',
            'complement.max'            => 'O complemento deve ter no máximo 255 caracteres.',

            'user_id.required'          => 'O ID do usuário é obrigatório.',
            'user_id.numeric'           => 'O ID do usuário deve ser um número válido.',

            'housing_profile.required'  => 'O perfil habitacional é obrigatório.',
            'housing_profile.numeric'   => 'O perfil habitacional deve ser um número válido.',
        ];
    }
}
