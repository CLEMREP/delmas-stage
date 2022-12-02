@extends('delmas.student.components.layout')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Créer une entreprise
    </h2>

    <form action="{{ route('student.companies.store') }}" method="POST">
        @csrf

        <div class="flex flex-col mt-4 sm:flex-row justify-between w-full">
            <label class="block text-sm mb-4 sm:mb-0 sm:w-1/2 sm:mr-3">
                <span class="text-gray-700 dark:text-gray-400">Nom</span>
                <input class="@error('name') border-red-500 @enderror block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ old('name') }}" name="name" placeholder="Web^ID">
                @error('name')
                <div class="mt-2 flex flex-row items-center justify-start font-medium text-red-500 mb-2">
                    <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </label>

            <label class="block text-sm sm:w-1/2">
                <span class="text-gray-700 dark:text-gray-400">Téléphone</span>
                <input class="@error('phone') border-red-500 @enderror block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ old('phone') }}" name="phone" placeholder="07 61 38 20 21">
                @error('phone')
                <div class="mt-2 flex flex-row items-center justify-start font-medium text-red-500 mb-2">
                    <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </label>
        </div>

        <div class="mt-4">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Adresse</span>
                <input class="@error('address') border-red-500 @enderror block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ old('address') }}" name="address" placeholder="569 Boulevard du Massacre">
                @error('address')
                <div class="mt-2 flex flex-row items-center justify-start font-medium text-red-500 mb-2">
                    <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </label>
        </div>

        <div class="mt-4 mb-6 w-full">
            <div class="flex flex-col sm:flex-row justify-between w-full ">
                <label class="block text-sm w-full mb-4 sm:mb-0 sm:w-1/2 sm:mr-3">
                    <span class="text-gray-700 dark:text-gray-400">Code Postal</span>
                    <input class="@error('zip') border-red-500 @enderror block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ old('zip') }}" name="zip" placeholder="44100">
                    @error('zip')
                    <div class="mt-2 flex flex-row items-center justify-start font-medium text-red-500 mb-2">
                        <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div>
                            {{ $message }}
                        </div>
                    </div>
                    @enderror
                </label>

                <label class="block text-sm w-full sm:w-1/2">
                    <span class="text-gray-700 dark:text-gray-400">Ville</span>
                    <input class="@error('city') border-red-500 @enderror block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ old('city') }}" name="city" placeholder="Nantes">
                    @error('city')
                    <div class="mt-2 flex flex-row items-center justify-start font-medium text-red-500 mb-2">
                        <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div>
                            {{ $message }}
                        </div>
                    </div>
                    @enderror
                </label>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Créer l'entreprise</span>
                <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"><path d="M5 21h14a2 2 0 0 0 2-2V8a1 1 0 0 0-.29-.71l-4-4A1 1 0 0 0 16 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zm10-2H9v-5h6zM13 7h-2V5h2zM5 5h2v4h8V5h.59L19 8.41V19h-2v-5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v5H5z"></path></svg>
            </button>
        </div>
    </form>
@endsection
