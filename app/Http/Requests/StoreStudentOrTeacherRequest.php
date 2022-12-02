<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentOrTeacherRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return
            [
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'regex:/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/', Rule::unique('users', 'phone')],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users', 'email'),
                ],
                'promotion_id' => ['required'],
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
            'email.unique' => 'L\'e-mail est déjà utilisée.',
            'email.email' => 'L\'e-mail doit être dans un format valide (ex: test@test.com)',
            'phone.regex' => 'Le téléphone doit être au bon format (XX XX XX XX XX XX).',
        ];
    }
}
