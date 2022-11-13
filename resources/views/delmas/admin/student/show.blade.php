@extends('delmas.admin.components.layout')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Fiche de l'utilisateur : {{ $student->fullname() }}
    </h2>

        <div class="flex flex-col sm:flex-row justify-between w-full">
            <label class="block text-sm w-full mb-4 sm:mb-0 sm:w-1/2 sm:mr-3">
                <span class="text-gray-700 dark:text-gray-400">Nom</span>
                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="lastname" value="{{ $student->lastname ?? '-' }}" disabled>
            </label>
            <label class="block text-sm w-full sm:w-1/2">
                <span class="text-gray-700 dark:text-gray-400">Prénom</span>
                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="firstname" value="{{ $student->firstname ?? '-' }}" disabled>
            </label>
        </div>

        <div class="mt-4">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Adresse électronique</span>
                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="email" value="{{ $student->email ?? '-' }}" disabled>
            </label>
        </div>

        <div class="flex flex-col sm:flex-row justify-between mt-4 w-full">
            <label class="block text-sm w-full mb-4 sm:mb-0 sm:w-1/2 sm:mr-3">
                <span class="text-gray-700 dark:text-gray-400">Promotion</span>
                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="promotion_id" value="{{ $student->promotion?->name }}" disabled>
            </label>
            <label class="block text-sm w-full sm:w-1/2">
                <span class="text-gray-700 dark:text-gray-400">Téléphone</span>
                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="phone" value="{{ $student->phone ?? '-' }}" disabled>
            </label>
        </div>

        <div class="flex flex-col mt-4 sm:flex-row justify-between w-full">
            <label class="block text-sm w-full mb-4 sm:mb-0 sm:w-1/2 sm:mr-3">
                <span class="text-gray-700 dark:text-gray-400">Code Postal</span>
                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="zip" value="{{ $student->zip ?? '-' }}" disabled>
            </label>
            <label class="block text-sm w-full sm:w-1/2">
                <span class="text-gray-700 dark:text-gray-400">Ville</span>
                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="city" value="{{ $student->city ?? '-' }}" disabled>
            </label>
        </div>

        <div class="mt-4">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Adresse</span>
                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="address" value="{{ $student->address ?? '-' }}" disabled>
            </label>
        </div>

        <div class="flex flex-col mt-4 sm:flex-row justify-between w-full">
            <label class="block text-sm sm:w-1/2 sm:mr-3">
                <span class="text-gray-700 dark:text-gray-400">Motivation</span>
                <textarea
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600
                        dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                    rows="3" name="motivation" disabled
                    placeholder="Écrivez vos motivations ...">{{ $student->motivation ?? '-' }}</textarea>
            </label>

            <label class="block mt-4 sm:mt-0 text-sm sm:w-1/2">
                <span class="text-gray-700 dark:text-gray-400">Critères d'offres</span>
                <textarea
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600
                        dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                    rows="3" name="desire" disabled
                    placeholder="Écrivez vos critères concernant les offres d'emplois, faites pas les difficiles ...">{{ $student->desire ?? '-' }}</textarea>
            </label>
        </div>

        <div class="mt-4 mb-6">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Votre mobilité</span>
                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="name" value="{{ $student->mobility ? 'Véhiculé' : 'Non véhiculé' }}" disabled>
            </label>
        </div>

    @if($student->procedures->isNotEmpty())
        <h2 class="mt-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">Démarches ({{ $student->procedures->count() }}) :</h2>
        <div class="flex flex-col mt-4 sm:flex-row justify-between w-full mb-8">
            <table class="w-full whitespace-no-wrap">
                <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Entreprise</th>
                    <th class="px-4 py-3">Format</th>
                    <th class="px-4 py-3">Statut</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Relance</th>
                    <th class="px-4 py-3">Date relance</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($student->procedures as $procedure)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            {{ $procedure->company()->first()->name }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $procedure->format()->first()->name }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @component('delmas.components.status', [
                                'statusId' => $procedure->status()->first()->getKey(),
                                ])
                            @endcomponent
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $procedure->date->format('Y-m-d') }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $procedure->resend ? 'Oui' : 'Non' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $procedure->date_resend ?? '-' }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.student.index') }}">
            <button class="mr-4 h-full flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Retour</span>
            </button>
        </a>
        <a href="{{ route('admin.student.edit', $student) }}">
            <button class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Modifier l'étudiant</span>
                <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"><path d="M5 21h14a2 2 0 0 0 2-2V8a1 1 0 0 0-.29-.71l-4-4A1 1 0 0 0 16 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zm10-2H9v-5h6zM13 7h-2V5h2zM5 5h2v4h8V5h.59L19 8.41V19h-2v-5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v5H5z"></path></svg>
            </button>
        </a>
    </div>
@endsection
