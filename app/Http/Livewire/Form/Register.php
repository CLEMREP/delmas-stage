<?php

namespace App\Http\Livewire\Form;

use App\Models\Enums\Roles;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;

class Register extends Component
{
    public int $currentStep = 1;

    public bool $mobility = false;

    public string $firstname = '';

    public string $lastname = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public string $address = '';

    public string $city = '';

    public string $zip = '';

    public string $motivation = '';

    public string $desire = '';

    public function render(): View
    {
        return view('livewire.form.register');
    }

    public function firstStepSubmit(): void
    {
        $validatedData = $this->validate([
            'lastname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], $messages = [
            'firstname.required' => 'Le prénom est requis.',
            'lastname.required' => 'Le nom de famille est requis.',
            'email.required' => 'L\'e-mail est requise.',
            'password.required' => 'Le mot de passe est requis.',
            'email.unique' => 'L\'e-mail est déjà utilisée.',
            'email.email' => 'L\'e-mail doit être dans un format valide (ex: test@test.com)',
            'password.min' => 'Le mot de passe doit faire minimum :min charactères.',
            'password.confirmed' => 'Les mots de passe doivent être similaires.',
        ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit(): void
    {
        $validatedData = $this->validate([
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'zip' => 'nullable|regex:/^[0-9]{5}(?:-[0-9]{4})?$/',
        ]);

        $this->currentStep = 3;
    }

    public function submitForm(): Redirector|RedirectResponse
    {
        $validatedData = $this->validate([
            'motivation' => 'nullable|string',
            'desire' => 'nullable|string',
            'mobility' => 'nullable|boolean',
        ]);

        $user = User::create([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => Roles::Student,
            'address' => $this->address,
            'city' => $this->city,
            'zip' => $this->zip,
            'desire' => $this->desire,
            'motivation' => $this->motivation,
            'mobility' => $this->mobility,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
