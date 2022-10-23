<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProcedureRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'company_id' => ['required', 'integer'],
            'format_id' => ['required', 'integer'],
            'status_id' => ['required', 'integer'],
            'date' => ['required', 'date'],
            'resend' => ['nullable', 'boolean'],
            'date_resend' => ['nullable', 'date', Rule::requiredIf($this->request->get('resend') == 1)],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            '*.required' => 'Veuillez remplir le champ.',
            '*.integer' => 'Le champ doit être un entier.',
            '*.date' => 'Le champ doit être une date.',
        ];
    }
}
