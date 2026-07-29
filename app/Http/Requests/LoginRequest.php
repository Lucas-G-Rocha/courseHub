<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        return [
            'email' => ['required', 'email'],
            'password' => ['min:5', 'max:15', 'required']
        ];
    }

    public function attributes(){
        return [
            'password' => 'senha'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email não pode estar vazio',
            'email.email' => 'Formato do email deve ser válido',
            'password.required' => 'Senha não pode estar vazia',
            'password.min' => 'Senha deve ter mais que 5 caracteres',
            'password.max' => 'Senha deve ter menos que 15 caracteres'

        ];
    }
}
