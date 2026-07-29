<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adminProfessorCreateRequest extends FormRequest
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
        $createUser = $this->boolean('create_user');

        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email'],
            'bio' => ['nullable', 'string', 'max:255'],
        ];

        if ($createUser) {
            $rules['password'] = ['required', 'min:5', 'max:12', 'confirmed'];
        }

        return $rules;
    }
}
