<?php

namespace App\Http\Requests;

use App\Models\Professor;
use Illuminate\Foundation\Http\FormRequest;

class adminProfessorEditRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email'],
            'bio' => ['nullable', 'string', 'max:255'],
        ];

        $professor = Professor::findOrFail($this->route('id'));

        if ($professor->user) {
            $rules['password'] = ['nullable', 'min:5', 'max:12', 'confirmed'];
            $rules['user_name'] = ['required', 'string', 'min:3', 'max:100'];
            $rules['user_email'] = ['required', 'email'];
        }
        return $rules;
    }
}
