@extends('delmas.admin.components.layout')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Fiche de l'entreprise {{ $company->name }}
    </h2>

    <h2 class="text-gray-200 mb-3">Entreprise :</h2>
    <div class="flex flex-col sm:flex-row justify-between w-full">
        <label class="block text-sm w-full mb-4 sm:mb-0 sm:w-1/2 sm:mr-3">
            <span class="text-gray-700 dark:text-gray-400">Nom</span>
            <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $company->name }}" placeholder="Binary-Cloud" disabled>
        </label>
        <label class="block text-sm w-full sm:w-1/2">
            <span class="text-gray-700 dark:text-gray-400">Téléphone</span>
            <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $company->phone }}" placeholder="07 61 38 20 21" disabled>
        </label>
    </div>

    <div class="mt-4">
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Adresse</span>
            <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $company->completeAddress() }}" placeholder="Bd du Massacre, 44800, Saint-Herblain" disabled>
        </label>
    </div>

    <h2 class="text-gray-200 mb-3 mt-10">Contacts :</h2>
    <div class="flex flex-col mt-4 sm:flex-row justify-between w-full mb-4">
        <table class="w-full whitespace-no-wrap">
            <thead>
            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                <th class="px-4 py-3">Prénom</th>
                <th class="px-4 py-3">Nom</th>
                <th class="px-4 py-3">E-Mail</th>
                <th class="px-4 py-3">Téléphone</th>
                <th class="px-4 py-3">Métier</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            @foreach($company->contacts as $contact)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        {{ $contact->firstname }}
                    </td>
                    <td class="px-4 py-3">
                        {{ $contact->name }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $contact->email }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $contact->phone }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $contact->job->name }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="flex justify-end mt-6">
        <a href="{{ route('admin.company.index') }}">
            <button class="h-full flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Retour</span>
            </button>
        </a>
    </div>
@endsection
