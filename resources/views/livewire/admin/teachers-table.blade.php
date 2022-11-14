<div class="w-full overflow-hidden rounded-lg shadow-xs" x-data="{ 'showFilters' : false }">
    <div class="flex flex-col sm:flex-row sm:items-center w-full">
        <div class="sm:w-1/3">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Gestion des professeurs
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
                    <input wire:model="search" type="text" class="bg-gray-50 border border-purple-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Recherchez un professeur">
                </div>
            </div>
            <button @click="showFilters = true" class="sm:mr-3 flex items-center mb-3 sm:mb-0 justify-between px-4 py-2 text-sm font-medium leading-5 dark:text-white text-purple-600 transition-colors duration-150 border-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <svg width="24" height="24" class="mr-2 -ml-1" fill="currentColor">
                    <path d="M21 3H5a1 1 0 0 0-1 1v2.59c0 .523.213 1.037.583 1.407L10 13.414V21a1.001 1.001 0 0 0 1.447.895l4-2c.339-.17.553-.516.553-.895v-5.586l5.417-5.417c.37-.37.583-.884.583-1.407V4a1 1 0 0 0-1-1zm-6.707 9.293A.996.996 0 0 0 14 13v5.382l-2 1V13a.996.996 0 0 0-.293-.707L6 6.59V5h14.001l.002 1.583-5.71 5.71z"></path>
                </svg>
                <span>Filtres</span>
            </button>
            <a href="{{ route('admin.teacher.create') }}">
                <button class="w-full flex mb-3 sm:mb-0 items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="mr-2"><path d="M20 2H8c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V4c0-1.103-.897-2-2-2zM8 16V4h12l.002 12H8z"></path><path d="M4 8H2v12c0 1.103.897 2 2 2h12v-2H4V8zm11-2h-2v3h-3v2h3v3h2v-3h3V9h-3z"></path></svg>
                    <span>Nouveau professeur</span>
                </button>
            </a>
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
                <div class="grid grid-cols-3 md:grid-cols-3 xl:grid-cols-3 gap-4 mt-4">
                    <label class="block text-sm w-full mb-4 sm:mb-0 ">
                        <span class="text-gray-700 dark:text-gray-400">Promotion</span>
                        <select wire:model="promotion" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="promotion_id">
                            <option value="" selected>Tous</option>
                            @foreach($promotions as $promotion)
                                <option value="{{ $promotion->id }}">{{ $promotion->name }}</option>
                            @endforeach
                        </select>
                    </label>

                    <label class="block text-sm w-full mb-4 sm:mb-0">
                        <span class="text-gray-700 dark:text-gray-400">Trier par</span>
                        <select wire:model="sortField" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="promotion_id">
                            <option value="promotion_id">Promotion</option>
                            <option value="firstname">Prénom</option>
                            <option value="lastname">Nom</option>
                            <option value="email">E-Mail</option>
                        </select>
                    </label>

                    <label class="block text-sm w-full mb-4 sm:mb-0">
                        <span class="text-gray-700 dark:text-gray-400">Ordre</span>
                        <select wire:model="sortDirection" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="promotion_id">
                            <option value="asc" selected="">Ascendant</option>
                            <option value="desc">Descendant</option>
                        </select>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full overflow-x-auto">
        @if($teachers->count() > 0)
            <table aria-colspan="7" class="w-full whitespace-no-wrap">
                <thead aria-colspan="7">
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Prénom</th>
                    <th class="px-4 py-3">Nom</th>
                    <th class="px-4 py-3">E-Mail</th>
                    <th class="px-4 py-3">Téléphone</th>
                    <th class="px-4 py-3">Promotions</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
                </thead>
                <tbody aria-colspan="7" class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach($teachers as $teacher)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            {{ $teacher->firstname }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $teacher->lastname }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $teacher->email }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $teacher->phone }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @foreach($teacher->promotions as $promotion)
                                {{ $promotion->name ?? '-' }}
                            @endforeach
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end text-sm">
                                <a href="{{ route('admin.teacher.edit', $teacher) }}">
                                    <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24" >
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                        </svg>
                                    </button>
                                </a>
                                <form action="{{ route('admin.teacher.destroy', $teacher) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 rounded-lg text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
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
                    <th class="px-4 py-3">Prénom</th>
                    <th class="px-4 py-3">E-Mail</th>
                    <th class="px-4 py-3">Téléphone</th>
                    <th class="px-4 py-3">Promotions</th>
                    <th class="px-4 py-3">Actions</th>
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
        {!! $teachers->links() !!}
    </div>
</div>