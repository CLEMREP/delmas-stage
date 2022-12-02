<div class="w-full overflow-hidden rounded-lg shadow-xs">
    <div class="flex flex-col sm:flex-row sm:items-center w-full">
        <div class="sm:w-1/3">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Liste des entreprises
            </h2>
        </div>

        <div class="flex flex-col sm:flex-row w-full justify-end sm:w-2/3">
            <div class="mb-3 sm:mb-0">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input wire:model="search" type="text" class="bg-gray-50 border border-purple-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Recherchez une entreprise">
                </div>
            </div>
        </div>
    </div>


    <div class="w-full overflow-x-auto">
        @if($companies->count() > 0)
            <table aria-colspan="7" class="w-full whitespace-no-wrap">
                <thead aria-colspan="7">
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Nom</th>
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
                                <a href="{{ route('admin.company.show', $company) }}">
                                    <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Show">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24" >
                                            <path d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 11c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4z"></path><path d="M12 10c-1.084 0-2 .916-2 2s.916 2 2 2 2-.916 2-2-.916-2-2-2z"></path>
                                        </svg>
                                    </button>
                                </a>
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
</div>