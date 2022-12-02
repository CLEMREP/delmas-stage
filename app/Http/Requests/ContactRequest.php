<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:128'],
            'firstname' => ['required', 'string', 'min:3', 'max:128'],
            'phone' => ['regex:/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'job_id' => ['required', 'integer'],
            'company_id' => ['required', 'integer'],
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
            '*.string' => 'Le champ doit être une chaîne de caractères.',
            'zip.regex' => 'Le code postale doit être au bon format (XXXXX).',
            'phone.regex' => 'Le téléphone doit être au bon format (XX XX XX XX XX XX).',
            'email.email' => 'L\'e-mail doit être dans un format valide (ex: test@test.com)',
        ];
    }
}
