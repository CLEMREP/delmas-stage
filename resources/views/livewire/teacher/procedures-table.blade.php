<div class="w-full overflow-hidden rounded-lg shadow-xs" x-data="{ 'showFilters' : false }">
    <div class="flex flex-col sm:flex-row sm:items-center w-full">
        <div class="sm:w-1/3">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Suivi des démarches
            </h2>
        </div>

        <div class="flex flex-col sm:flex-row w-full justify-end sm:w-2/3">
            <div class="sm:mr-3 mb-3 sm:mb-0">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input wire:model="search" type="text" class="bg-gray-50 border border-purple-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Recherchez un étudiant">
                </div>
            </div>
            <button @click="showFilters = true" class="flex items-center mb-3 sm:mb-0 justify-between px-4 py-2 text-sm font-medium leading-5 dark:text-white text-purple-600 transition-colors duration-150 border-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <svg width="24" height="24" class="mr-2 -ml-1" fill="currentColor">
                    <path d="M21 3H5a1 1 0 0 0-1 1v2.59c0 .523.213 1.037.583 1.407L10 13.414V21a1.001 1.001 0 0 0 1.447.895l4-2c.339-.17.553-.516.553-.895v-5.586l5.417-5.417c.37-.37.583-.884.583-1.407V4a1 1 0 0 0-1-1zm-6.707 9.293A.996.996 0 0 0 14 13v5.382l-2 1V13a.996.996 0 0 0-.293-.707L6 6.59V5h14.001l.002 1.583-5.71 5.71z"></path>
                </svg>
                <span>Filtres</span>
            </button>
        </div>
    </div>

    <div x-show="showFilters" tabindex="-1" class="mb-6">
        <div x-show="showFilters" @click.away="showFilters = false" x-transition.duration.250ms class="w-full shadow p-5 rounded-lg bg-gray-800">

            <div class="flex items-center justify-between">
                <p class="font-medium text-xl text-gray-200">
                    Filtres
                </p>

                <button wire:click="resetFilters()" class="flex items-center mb-3 sm:mb-0 justify-between px-4 py-2 text-sm font-medium leading-5 dark:text-white text-purple-600 transition-colors duration-150 border-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Supprimer les filtres
                </button>
            </div>

            <div>
                <div class="grid grid-cols-2 md:grid-cols-2 xl:grid-cols-4 gap-4 mt-4">
                    <label class="block text-sm w-full mb-4 sm:mb-0 ">
                        <span class="text-gray-700 dark:text-gray-400">Promotion</span>
                        <select wire:model="promotion" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="promotion_id">
                            <option value="" selected>Tous</option>
                            @foreach(loggedUser()->promotions as $promotion)
                                <option value="{{ $promotion->id }}">{{ $promotion->name }}</option>
                            @endforeach
                        </select>
                    </label>

                    <label class="block text-sm w-full mb-4 sm:mb-0">
                        <span class="text-gray-700 dark:text-gray-400">Trier par</span>
                        <select wire:model="sortField" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="promotion_id">
                            <option value="status_id">Status</option>
                            <option value="resend">Relancé</option>
                            <option value="date">Date création</option>
                        </select>
                    </label>

                    <label class="block text-sm w-full mb-4 sm:mb-0">
                        <span class="text-gray-700 dark:text-gray-400">Statut</span>
                        <select wire:model="status" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="promotion_id">
                            <option value="" selected>Tous</option>
                            <option value="3">Accepté</option>
                            <option value="2">Refusé</option>
                            <option value="1">En Attente</option>
                        </select>
                    </label>

                    <label class="block text-sm w-full mb-4 sm:mb-0">
                        <span class="text-gray-700 dark:text-gray-400">Ordre</span>
                        <select wire:model="sortDirection" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="promotion_id">
                            <option value="desc" selected>Descendant</option>
                            <option value="asc">Ascendant</option>
                        </select>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs mb-6">
        <div class="w-full overflow-x-auto">
            @if($procedures->count() > 0)
                <table class="w-full whitespace-no-wrap">
                    <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Étudiant</th>
                        <th class="px-4 py-3">Entreprise</th>
                        <th class="px-4 py-3">Format</th>
                        <th class="px-4 py-3">Statut</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Relance</th>
                        <th class="px-4 py-3">Date relance</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($procedures as $procedure)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                {{ $procedure->student->fullname() }}
                            </td>
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
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end text-sm">
                                    <a href="{{ route('teacher.procedure.show', $procedure) }}">
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
                        <th class="px-4 py-3">Étudiant</th>
                        <th class="px-4 py-3">Entreprise</th>
                        <th class="px-4 py-3">Format</th>
                        <th class="px-4 py-3">Statut</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Relance</th>
                        <th class="px-4 py-3">Date relance</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                    </thead>
                </table>
                <div class="text-center text-white bg-gray-800 pb-2 flex h-[160px] justify-center items-center flex-col">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 w-6 h-6 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="block mt-1">Pas de résultats</span>
                </div>
            @endif

            <div class="mt-4">
                {{ $procedures->links() }}
            </div>

        </div>
    </div>
</div>