@extends('delmas.student.components.layout')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Fiche de la démarche chez {{ $procedure->name }}
    </h2>

    <div class="flex flex-col mt-4 sm:flex-row justify-between w-full">
        <div  class="block flex flex-row text-sm mb-4 sm:mb-0 sm:w-1/2 sm:mr-3">
            <label class="w-full mr-2">
                <span class="text-gray-700 dark:text-gray-400">Entreprise</span>
                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $procedure->company()->first()->name }}" disabled>
            </label>
            <a href="{{ route('student.companies.show', $procedure->company()->first()) }}" class="flex items-end justify-end">
                <button class="flex h-10 items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-gray-600 border border-transparent rounded-lg hover:bg-gray-700 focus:outline-none">
                    <span>Fiche</span>
                </button>
            </a>
        </div>

        <label class="block text-sm sm:w-1/2">
            <span class="text-gray-700 dark:text-gray-400">Format</span>
            <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $procedure->format()->first()->name }}" disabled>
        </label>
    </div>

    <div class="flex flex-col mt-4 sm:flex-row justify-between w-full">
        <label class="block text-sm mb-4 sm:mb-0 sm:w-1/2 sm:mr-3">
            <span class="text-gray-700 dark:text-gray-400">Statut</span>
            <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $procedure->status()->first()->name }}" disabled>
        </label>

        <label class="block text-sm w-full sm:w-1/2">
            <span class="text-gray-700 dark:text-gray-400">Date de démarchage</span>
            <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $procedure->date->format('d-m-Y') }}" disabled>
        </label>
    </div>

    <div class="flex flex-col mt-4 sm:flex-row justify-between w-full mb-6">
        <label class="block text-sm mb-4 sm:mb-0 w-full sm:w-1/2 sm:mr-3">
            <span class="text-gray-700 dark:text-gray-400">Relance</span>
            <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $procedure->resend ? 'Oui' : 'Non' }}" disabled>
        </label>

        <label class="block text-sm sm:w-1/2">
            <span class="text-gray-700 dark:text-gray-400">Date de relance</span>
            <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $procedure->date_resend ?? '-' }}" disabled>
        </label>
    </div>


    <div class="flex justify-end">
        <a href="{{ route('student.procedures.index') }}">
            <button class="mr-4 h-full flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Retour</span>
            </button>
        </a>
        <a href="{{ route('student.procedures.edit', $procedure) }}">
            <button class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Modifier la démarche</span>
                <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"><path d="M5 21h14a2 2 0 0 0 2-2V8a1 1 0 0 0-.29-.71l-4-4A1 1 0 0 0 16 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zm10-2H9v-5h6zM13 7h-2V5h2zM5 5h2v4h8V5h.59L19 8.41V19h-2v-5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v5H5z"></path></svg>
            </button>
        </a>
    </div>
@endsection
