<div>
    <div class="mb-6 flex justify-center">
        <div class="w-full">
            <div>
                <ol class="grid grid-cols-1 overflow-hidden text-sm text-gray-500 border border-gray-100 divide-x divide-gray-100 rounded-lg sm:grid-cols-3">
                    <li class="flex items-center justify-center p-4 {{ $currentStep == 1 ? 'bg-indigo-50' : '' }}">
                        <svg class="flex-shrink-0 mr-2 w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                        </svg>

                        <p class="leading-none">
                            <strong class="block font-medium"> Informations du compte </strong>
                            <small class="mt-1"> L'essentiel. </small>
                        </p>
                    </li>

                    <li class="relative flex items-center justify-center p-4 {{ $currentStep == 2 ? 'bg-indigo-50' : '' }}">
                        <span class="absolute hidden w-4 h-4 rotate-45 -translate-y-1/2 bg-white border border-b-0 border-l-0 border-gray-100 sm:block -left-2 top-1/2">
                        </span>

                        <span class="absolute hidden w-4 h-4 rotate-45 -translate-y-1/2 border border-b-0 border-l-0 border-gray-100 sm:block bg-gray-50 -right-2 top-1/2">
                        </span>

                        <svg class="flex-shrink-0 mr-2 w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>

                        <p class="leading-none">
                            <strong class="block font-medium"> Informations personnelles </strong>
                            <small class="mt-1"> Où vous trouver ? </small>
                        </p>
                    </li>

                    <li class="flex items-center justify-center p-4 {{ $currentStep == 3 ? 'bg-indigo-50' : '' }}">
                        <svg class="flex-shrink-0 mr-2 w-7 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>

                        <p class="leading-none">
                            <strong class="block font-medium"> Fiche de renseignement </strong>
                            <small class="mt-1"> Connaître vos attentes. </small>
                        </p>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <div class="row setup-content {{ $currentStep != 1 ? 'display-none' : '' }}" id="step-1">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <x-label for="firstname" :value="__('Prénom')" />

                <x-input id="firstname" wire:model="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" placeholder="Olivier" required autofocus />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <x-label for="lastname" :value="__('Nom')" />

                <x-input id="lastname" wire:model="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('name')" placeholder="Durant" required autofocus />
            </div>
        </div>

        <div>
            <x-label for="email" :value="__('Adresse électronique')" />

            <x-input id="email" wire:model="email" class="block mt-1 w-full" type="email" placeholder="olivier.durant@test.com" name="email" :value="old('email')" required />
        </div>

        <div class="mt-6">
            <div class="flex justify-between items-center">
                <x-label for="password" :value="__('Mot de passe')" />
            </div>
            <x-input id="password"
                     type="password"
                     name="password"
                     placeholder="Mot de passe"
                     wire:model="password"
                     required autocomplete="new-password" />
        </div>

        <div class="mt-6">
            <div class="flex justify-between items-center">
                <x-label for="password_confirmation" :value="__('Confirmation du mot de passe')" />
            </div>
            <x-input id="password_confirmation"
                     type="password"
                     name="password_confirmation"
                     wire:model="password_confirmation"
                     placeholder="Confirmation du mot de passe" required />
        </div>

        <div class="mt-10">
            <x-button wire:click="firstStepSubmit">
                {{ __('Suivant') }}
            </x-button>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 2 ? 'display-none' : '' }}" id="step-2">
        <div class="w-full mb-6">
            <x-label for="address" :value="__('Adresse')" />

            <x-input id="address" wire:model="address" class="block mt-1 w-full" type="address" placeholder="5 Bd du Massacre" name="address" :value="old('address')" required />
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <x-label for="city" :value="__('Ville')" />

                <x-input id="city" wire:model="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" placeholder="Nantes" required autofocus />
            </div>
            <div class="w-full md:w-1/2 px-3">
                <x-label for="zip" :value="__('Code Postal')" />

                <x-input id="zip" wire:model="zip" class="block mt-1 w-full" type="text" name="zip" :value="old('zip')" placeholder="44100" required autofocus />
            </div>
        </div>

        <div class="w-full mb-6">
            <x-label for="phone" :value="__('Téléphone')" />

            <x-input id="phone" wire:model="phone" class="block mt-1 w-full" type="phone" placeholder="06 81 62 54 42" name="phone" :value="old('phone')" required />
        </div>

        <div class="mt-10">
            <x-button wire:click="secondStepSubmit">
                {{ __('Suivant') }}
            </x-button>
        </div>
    </div>

    <div class="row setup-content {{ $currentStep != 3 ? 'display-none' : '' }}" id="step-2">
        <div class="w-full mb-6">
            <x-label for="mobility" :value="__('Mobilité')" />


            <select id="mobility" wire:model="mobility" class="w-full text-base py-2 border-4 rounded p-2 border-gray-300 focus:outline-none focus:border-indigo-500" name="mobility">
                <option value="1">Véhiculé</option>
                <option value="0" {{ $mobility == 0 ? 'selected' : '' }}>Non véhiculé</option>
            </select>
        </div>

        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <x-label for="motivation" :value="__('Motivation')" />

                <textarea id="motivation" wire:model="motivation"  name="motivation" :value="{{ old('motivation') }}"  placeholder="Écrivez vos motivations ..." class="w-full text-base py-2 border-4 rounded p-2 border-gray-300 focus:outline-none focus:border-indigo-500">

                </textarea>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <x-label for="desire" :value="__('Critères d\'offres')" />

                <textarea id="desire" wire:model="desire" name="desire" :value="{{ old('desire') }}"  placeholder="Écrivez vos critères concernant les offres d'emplois, faites pas les difficiles ..." class="w-full text-base py-2 border-4 rounded p-2 border-gray-300 focus:outline-none focus:border-indigo-500">

                </textarea>
            </div>
        </div>

        <div class="mt-10">
            <x-button wire:click="submitForm">
                {{ __('Terminé') }}
            </x-button>
        </div>
    </div>
</div>