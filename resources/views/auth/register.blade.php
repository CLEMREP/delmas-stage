<x-guest-layout>
    <main class="lg:flex h-screen lg:overflow-hidden">

        <section class="w-full lg:w-1/2 bg-white lg:p-4 overflow-y-scroll">
            <div class="flex flex-col min-h-full justify-center">

                <div class="py-4 bg-indigo-100 lg:bg-white flex justify-center lg:px-12">
                    <div class="cursor-pointer flex items-center">
                        <div class="w-10 text-indigo-500 mr-4">
                            <i class='bx bxs-graduation bx-lg'></i>
                        </div>
                        <div class="text-3xl sm:text-4xl text-indigo-800 tracking-wide ml-2 font-semibold">Espace étudiant</div>
                    </div>
                </div>

                <div class="mt-3 px-12 sm:px-24 md:px-32 lg:px-12 xl:px-24 2xl:px-42">
                    <h2 class="text-center text-2xl text-black font-display font-semibold lg:text-center xl:text-3xl
                    xl:text-bold">Création de votre compte</h2>
                    <div class="mt-5">
                        <livewire:form.register />
                        <div class="mt-6 lg:pb-6 text-sm font-display font-semibold text-gray-700 text-center">
                            Vous avez un compte ? <a href="{{ route('login') }}" class="cursor-pointer text-indigo-600 hover:text-indigo-800">Connexion</a>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="hidden lg:flex lg:w-1/2 p-16 flex-col justify-center bg-[#1F2071]">
             <img src="images/undraw_programming_re_kg9v.svg" class="max-w-xl self-center" alt="">
        </section>
    </main>
</x-guest-layout>
