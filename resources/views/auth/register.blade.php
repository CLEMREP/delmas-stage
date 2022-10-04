<x-guest-layout>
    <div class="lg:flex">
        <div class="lg:w-1/2 flex flex-col justify-center lg:relative lg:overflow-y-scroll">
            <div class="lg:h-screen lg:absolute lg:w-full flex flex-col justify-center">
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
                    xl:text-bold">Création de votre compte</h2>
                    <div class="mt-5">
                        <livewire:form.register />
                        <div class="mt-6 lg:pb-6 text-sm font-display font-semibold text-gray-700 text-center">
                            Vous avez un compte ? <a href="{{ route('login') }}" class="cursor-pointer text-indigo-600 hover:text-indigo-800">Connexion</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="h-screen hidden lg:flex items-center justify-center bg-right flex-1 h-screen">
            <div class="transform duration-200"><!-- hover:scale-105 -->
                <img src="images/undraw_programming_re_kg9v.svg" class="mx-auto" alt="">
            </div>
        </div>
    </div>
</x-guest-layout>
