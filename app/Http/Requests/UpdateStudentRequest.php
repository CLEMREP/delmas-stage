<?php

namespace App\Http\Requests;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $student = $this->getRequestStudent();

        return
            [
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'regex:/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/', Rule::unique('students', 'phone')->ignore($student->getKey())],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users', 'email')->ignore($student->user?->getKey()),
                ],
                'promotion_id' => 'required',
                'address' => 'nullable|string',
                'city' => 'nullable|string',
                'zip' => 'nullable|regex:/^[0-9]{5}(?:-[0-9]{4})?$/',
                'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
                'motivation' => 'nullable|string',
                'desire' => 'nullable|string',
                'mobility' => 'nullable|boolean',
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
            'zip.regex' => 'Le code postale doit être au bon format (XXXXX).',
            'phone.regex' => 'Le téléphone doit être au bon format (XX XX XX XX XX XX).',
            'password.confirmed' => 'Les mots de passe doivent correspondre.',
        ];
    }

    protected function getRequestStudent(): Student
    {
        /** @var Student $student */
        $student = $this->student;

        return $student;
    }
}
