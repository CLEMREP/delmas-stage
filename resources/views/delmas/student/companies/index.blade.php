@extends('delmas.student.components.layout')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center w-full">
        <div class="sm:w-1/3">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Mes entreprises
            </h2>
        </div>

        <div class="flex flex-col sm:flex-row w-full justify-end sm:w-2/3">
            <button class="flex items-center mb-3 sm:mb-0 sm:mr-4 justify-between px-4 py-2 text-sm font-medium leading-5 dark:text-white text-purple-600 transition-colors duration-150 border-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <svg width="24" height="24" class="mr-2 -ml-1" fill="currentColor">
                    <path d="M21 3H5a1 1 0 0 0-1 1v2.59c0 .523.213 1.037.583 1.407L10 13.414V21a1.001 1.001 0 0 0 1.447.895l4-2c.339-.17.553-.516.553-.895v-5.586l5.417-5.417c.37-.37.583-.884.583-1.407V4a1 1 0 0 0-1-1zm-6.707 9.293A.996.996 0 0 0 14 13v5.382l-2 1V13a.996.996 0 0 0-.293-.707L6 6.59V5h14.001l.002 1.583-5.71 5.71z"></path>
                </svg>
                <span>Filtres</span>
            </button>
            <a href="{{ route('student.companies.create') }}">
                <button class="w-full flex mb-3 sm:mb-0 items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="mr-2"><path d="M20 2H8c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zM8 16V4h12l.002 12H8z"></path><path d="M4 8H2v12c0 1.103.897 2 2 2h12v-2H4V8zm11-2h-2v3h-3v2h3v3h2v-3h3V9h-3z"></path></svg>
                    <span>Nouvelle entreprise</span>
                </button>
            </a>
        </div>
    </div>

    @if(Session::has('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">
            <span class="font-medium">{!! Session::get('success') !!}</span>
        </div>
    @endif

    @if(Session::has('errors'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert" x-data="{ showError: true }" x-show="showError" x-init="setTimeout(() => showError = false, 5000)">
            <span class="font-medium">{!! Session::get('errors') !!}</span>
        </div>
    @endif

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            @if($companies->count() > 0)
                <table aria-colspan="7" class="w-full whitespace-no-wrap">
                    <thead aria-colspan="7">
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Nom</th>
                        <th class="px-4 py-3">Contact</th>
                        <th class="px-4 py-3">Adresse</th>
                        <th class="px-4 py-3">Code Postal</th>
                        <th class="px-4 py-3">Ville</th>
                        <th class="px-4 py-3">Téléphone</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody aria-colspan="7" class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach($companies as $company)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    {{ $company->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $company->contact()->first()->firstname . ' ' . $company->contact()->first()->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $company->address }}
                                </td>

                                <td class="px-4 py-3 text-sm">
                                    {{ $company->zip }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $company->city }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $company->phone }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end text-sm">
                                        <a href="{{ route('student.companies.show', $company) }}">
                                            <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Show">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24" >
                                                    <path d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 11c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4z"></path><path d="M12 10c-1.084 0-2 .916-2 2s.916 2 2 2 2-.916 2-2-.916-2-2-2z"></path>
                                                </svg>
                                            </button>
                                        </a>
                                        <a href="{{ route('student.companies.edit', $company) }}">
                                            <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24" >
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                </svg>
                                            </button>
                                        </a>
                                        <form action="{{ route('student.companies.destroy', $company) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"
                                                    ></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <table aria-colspan="7" class="w-full whitespace-no-wrap">
                    <thead aria-colspan="7">
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Nom</th>
                        <th class="px-4 py-3">Contact</th>
                        <th class="px-4 py-3">Adresse</th>
                        <th class="px-4 py-3">Code Postal</th>
                        <th class="px-4 py-3">Ville</th>
                        <th class="px-4 py-3">Téléphone</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                    </thead>
                </table>
                <div class="text-center text-white bg-gray-800 pb-2 flex h-[160px] justify-center items-center flex-col">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 w-6 h-6 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="block mt-1">Pas de résultats</span></div>
            @endif
        </div>

        <div class="mt-4">
            {{ $companies->links() }}
        </div>
@endsection
