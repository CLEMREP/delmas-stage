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
                    xl:text-bold">Sécurité, confirmer votre nouveau mot de passe</h2>
                <div class="mt-12">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="mt-6">
                            <x-label for="password" :value="__('Mot de passe')" />

                            <x-input id="password"
                                     type="password"
                                     name="password"
                                     required autocomplete="current-password" />
                        </div>
                        <div class="mt-10">
                            <x-button>
                                {{ __('Confirmer') }}
                            </x-button>
                        </div>
                    </form>
                    <div class="mt-12 text-sm font-display font-semibold text-gray-700 text-center">
                        Vous avez un compte ? <a href="{{ route('login') }}" class="cursor-pointer text-indigo-600 hover:text-indigo-800">Connexion</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden lg:flex items-center justify-center bg-right flex-1 h-screen">
            <div class="transform duration-200 cursor-pointer"><!-- hover:scale-105 -->
                <img src="images/undraw_forgot_password_re_hxwm.svg" class="mx-auto" alt="">
            </div>
        </div>
    </div>
</x-guest-layout>
