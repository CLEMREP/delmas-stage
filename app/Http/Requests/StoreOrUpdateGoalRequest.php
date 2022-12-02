<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdateGoalRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'content' => ['required', 'string', 'max:255'],
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
            'content.required' => 'L\'objectif doit être renseigné.',
            'content.max' => 'L\'objectif doit avoir maximum :max caractères.',
            'content.string' => 'L\'objectif doit être une chaine de caractères.',
            'promotion_id.required' => 'La promotion doit être renseignée.',
        ];
    }
}
