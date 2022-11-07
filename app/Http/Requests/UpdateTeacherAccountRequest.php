<?php

namespace App\Http\Requests;

use App\Models\Teacher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UpdateTeacherAccountRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $teacher = $this->getRequestTeacher();

        return
            [
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'regex:/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/', Rule::unique('teachers', 'phone')->ignore($teacher->getKey())],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users', 'email')->ignore($teacher->user?->getKey()),
                ],
                'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
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
            'password.min' => 'Le mot de passe doit faire minimum :min charactères.',
            'phone.regex' => 'Le téléphone doit être au bon format (XX XX XX XX XX XX).',
            'password.confirmed' => 'Les mots de passe doivent correspondre.',
        ];
    }

    protected function getRequestTeacher(): Teacher
    {
        /** @var Teacher $teacher */
        $teacher = Auth::user()?->userable;

        return $teacher;
    }
}
