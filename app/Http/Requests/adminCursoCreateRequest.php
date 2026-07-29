<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adminCursoCreateRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'professor_id' => ['required', 'integer', 'min:1'],
            'workload' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string']
        ];
    }
}
