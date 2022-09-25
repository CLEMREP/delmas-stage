<x-guest-layout>
    <div class="lg:flex">
        <div class="lg:w-1/2 flex flex-col justify-center">
            <div class="py-4 bg-indigo-100 lg:bg-white flex justify-center lg:px-12">
                <div class="cursor-pointer flex items-center">
                    <div class="w-10 text-indigo-500 mr-4">
                        <i class='bx bxs-graduation bx-lg'></i>
                    </div>
                    <div class="text-4xl text-indigo-800 tracking-wide ml-2 font-semibold">Espace étudiant</div>
                </div>
            </div>
            <div class="mt-3 px-12 sm:px-24 md:px-48 lg:px-12 xl:px-24 2xl:px-64">
                <h2 class="text-center text-2xl text-black font-display font-semibold lg:text-center xl:text-3xl
                    xl:text-bold">Connexion à votre espace
                </h2>

                <div class="mt-12">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <x-label for="email" :value="__('Adresse électronique')" />

                            <x-input id="email" type="email" name="email" :value="old('email')" placeholder="etudiant.lycee@gmail.com" required autofocus />
                        </div>
                        <div class="mt-8">
                            <div class="flex justify-between items-center">
                                <x-label for="password" :value="__('Mot de passe')" />
                                <div>
                                    @if (Route::has('password.request'))
                                        <a class="text-xs font-display font-semibold text-indigo-600 hover:text-indigo-800
                                        cursor-pointer" href="{{ route('password.request') }}">
                                            {{ __('Mot de passe oublié ?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <x-input id="password" class="block mt-1 w-full"
                                     type="password"
                                     name="password"
                                     placeholder="Mot de passe"
                                     required autocomplete="current-password" />
                            <div>
                                <label class="block text-gray-500 font-bold mt-2" for="souvenir">
                                    <input class="mr-2 border-4 border-gray-300 rounded text-indigo-500" type="checkbox" id="remember_me" name="remember">
                                    <span class="text-sm text-blue-dark">
                                        {{ __('Se souvenir de moi') }}
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="mt-10">
                            <x-button>
                                {{ __('Connexion') }}
                            </x-button>
                        </div>
                    </form>
                    <div class="mt-12 text-sm font-display font-semibold text-gray-700 text-center">
                        Vous n'avez pas de compte ? <a href="{{ route('register') }}" class="cursor-pointer text-indigo-600 hover:text-indigo-800">Inscription</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden lg:flex items-center justify-center bg-right flex-1 h-screen">
            <div class="transform duration-200 cursor-pointer"><!-- hover:scale-105 -->
                <img src="images/undraw_access_account_re_8spm.svg" class="mx-auto" alt="">
            </div>
        </div>
    </div>
</x-guest-layout>
