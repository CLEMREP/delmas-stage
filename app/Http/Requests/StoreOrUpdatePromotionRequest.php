<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdatePromotionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'serie_id' => ['required', 'integer'],
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
            'name.required' => 'Le nom de la promotion doit être renseigné.',
            'name.max' => 'Le nom de la promotion doit avoir maximum :max caractères.',
            'name.string' => 'Le nom de la promotion doit être un string.',
            'name.unique' => 'Le nom de la promotion est déjà utilisé.',
        ];
    }
}
