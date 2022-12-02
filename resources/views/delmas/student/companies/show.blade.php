@extends('delmas.student.components.layout')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Fiche de l'entreprise {{ $company->name }}
    </h2>

    <div class="flex flex-col mt-4 sm:flex-row justify-between w-full">
        <label class="block text-sm mb-4 sm:mb-0 sm:w-1/2 sm:mr-3">
            <span class="text-gray-700 dark:text-gray-400">Nom</span>
            <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $company->name }}" name="name" placeholder="Web^ID" disabled>
        </label>

        <label class="block text-sm sm:w-1/2">
            <span class="text-gray-700 dark:text-gray-400">Téléphone</span>
            <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $company->phone }}" name="phone" placeholder="07 61 38 20 21" disabled>
        </label>
    </div>

    <div class="mt-4">
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Adresse</span>
            <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $company->address }}" name="address" placeholder="569 Boulevard du Massacre" disabled>
        </label>
    </div>

    <div class="mt-4 mb-6 w-full">
        <div class="flex flex-col sm:flex-row justify-between w-full ">
            <label class="block text-sm w-full mb-4 sm:mb-0 sm:w-1/2 sm:mr-3">
                <span class="text-gray-700 dark:text-gray-400">Code Postal</span>
                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $company->zip }}" name="zip" placeholder="44100" disabled>
            </label>

            <label class="block text-sm w-full sm:w-1/2">
                <span class="text-gray-700 dark:text-gray-400">Ville</span>
                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $company->city }}" name="city" placeholder="Nantes" disabled>
            </label>
        </div>
    </div>

    @if($company->contacts->isNotEmpty())
        <h2 class="mt-4 text-2xl font-semibold text-gray-700 dark:text-gray-200">Les contacts rattachés à cette entreprise ({{ $company->contacts->count() }}) :</h2>
        <div class="flex flex-col mt-4 sm:flex-row justify-between w-full mb-8">
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
    @endif

    <div class="flex justify-end">
        <a href="{{ route('student.companies.index') }}">
            <button class="@if($company->student->getKey() == loggedUser()->getKey()) mr-4 @endif h-full flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Retour</span>
            </button>
        </a>
        @if($company->student->getKey() == loggedUser()->getKey())
            <a href="{{ route('student.companies.edit', $company) }}">
                <button class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    <span>Modifier l'entreprise</span>
                    <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"><path d="M5 21h14a2 2 0 0 0 2-2V8a1 1 0 0 0-.29-.71l-4-4A1 1 0 0 0 16 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zm10-2H9v-5h6zM13 7h-2V5h2zM5 5h2v4h8V5h.59L19 8.41V19h-2v-5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v5H5z"></path></svg>
                </button>
            </a>
        @endif
    </div>
@endsection
