@extends('delmas.teacher.components.layout')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Création d'un objectif
    </h2>

    <form action="{{ route('teacher.goals.store') }}" method="POST">
        @csrf
        <div class="flex flex-col sm:flex-row justify-between w-full mb-4">
            <label class="block text-sm w-full mb-4 sm:mb-0 sm:w-2/3 sm:mr-3">
                <span class="text-gray-700 dark:text-gray-400">Contenu de l'objectif</span>
                <input class="@error('content') border-red-500 @enderror block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ old('content') }}" name="content" placeholder="Objectif : faire 5 demandes avant Noël, 24 Décembre 2022">
                @error('content')
                <div class="mt-2 flex flex-row items-center justify-start font-medium text-red-500 mb-2">
                    <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </label>
            <label class="block text-sm w-full sm:w-1/3">
                <span class="text-gray-700 dark:text-gray-400">Promotion</span>
                <select class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="promotion_id">
                    @foreach($promotions as $promotion)
                        <option value="{{ $promotion->getKey() }}">{{ $promotion->name }}</option>
                    @endforeach
                </select>
            </label>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Créer l'objectif</span>
                <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"><path d="M5 21h14a2 2 0 0 0 2-2V8a1 1 0 0 0-.29-.71l-4-4A1 1 0 0 0 16 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zm10-2H9v-5h6zM13 7h-2V5h2zM5 5h2v4h8V5h.59L19 8.41V19h-2v-5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v5H5z"></path></svg>
            </button>
        </div>
    </form>
@endsection
