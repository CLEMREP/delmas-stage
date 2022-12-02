@extends('delmas.admin.components.layout')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Résumé de la démarche de {{ $procedure->student->fullname() }}
    </h2>

    <h2 class="text-gray-200 mb-3">Entreprise :</h2>
    <div class="flex flex-col sm:flex-row justify-between w-full">
        <label class="block text-sm w-full mb-4 sm:mb-0 sm:w-1/2 sm:mr-3">
            <span class="text-gray-700 dark:text-gray-400">Nom</span>
            <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $procedure->company->name }}" placeholder="Binary-Cloud" disabled>
        </label>
        <label class="block text-sm w-full sm:w-1/2">
            <span class="text-gray-700 dark:text-gray-400">Téléphone</span>
            <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $procedure->company->phone }}" placeholder="07 61 38 20 21" disabled>
        </label>
    </div>

    <div class="mt-4">
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Adresse</span>
            <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $procedure->company->completeAddress() }}" placeholder="Bd du Massacre, 44800, Saint-Herblain" disabled>
        </label>
    </div>

    <h2 class="text-gray-200 mb-3 mt-10">Contact :</h2>
    <div class="flex flex-col sm:flex-row justify-between w-full">
        <label class="block text-sm w-full mb-4 sm:mb-0 sm:w-1/2 sm:mr-3">
            <span class="text-gray-700 dark:text-gray-400">Nom complet</span>
            <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $procedure->contact->fullname() }}" placeholder="Binary-Cloud" disabled>
        </label>
        <label class="block text-sm w-full sm:w-1/2">
            <span class="text-gray-700 dark:text-gray-400">Téléphone</span>
            <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $procedure->contact->phone }}" placeholder="07 61 38 20 21" disabled>
        </label>
    </div>

    <div class="flex flex-col sm:flex-row justify-between w-full mt-4">
        <label class="block text-sm w-full mb-4 sm:mb-0 sm:w-1/2 sm:mr-3">
            <span class="text-gray-700 dark:text-gray-400">Adresse électronique</span>
            <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $procedure->contact->email }}" placeholder="contact@clement-repel.fr" disabled>
        </label>
        <label class="block text-sm w-full sm:w-1/2">
            <span class="text-gray-700 dark:text-gray-400">Intitulé du métier</span>
            <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $procedure->contact->job->name }}" placeholder="07 61 38 20 21" disabled>
        </label>
    </div>

    <h2 class="text-gray-200 mb-3 mt-10">Démarche :</h2>
    <div class="flex flex-col mt-4 sm:flex-row justify-between w-full mb-4">
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
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        {{ $procedure->company->name }}
                    </td>
                    <td class="px-4 py-3">
                        {{ $procedure->format->name }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        @component('delmas.components.status', [
                            'statusId' => $procedure->status->getKey(),
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
            </tbody>
        </table>
    </div>


    <div class="flex justify-end">
        <a href="{{ route('admin.procedure.index') }}">
            <button class="h-full flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Retour</span>
            </button>
        </a>
    </div>
@endsection
