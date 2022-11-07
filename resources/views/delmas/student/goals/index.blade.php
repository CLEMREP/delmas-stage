@extends('delmas.student.components.layout')

@section('content')
    @if($goals->count() > 0)
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Objectif en cours
        </h2>
        <div class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                    ></path>
                </svg>
                <span>{{ $goals->last()->content }}</span>
            </div>
        </div>
    @endif
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Historique des objectifs
        </h2>
        <button class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 dark:text-white text-purple-600 transition-colors duration-150 border-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            <svg width="24" height="24" class="mr-2 -ml-1" fill="currentColor">
                <path d="M21 3H5a1 1 0 0 0-1 1v2.59c0 .523.213 1.037.583 1.407L10 13.414V21a1.001 1.001 0 0 0 1.447.895l4-2c.339-.17.553-.516.553-.895v-5.586l5.417-5.417c.37-.37.583-.884.583-1.407V4a1 1 0 0 0-1-1zm-6.707 9.293A.996.996 0 0 0 14 13v5.382l-2 1V13a.996.996 0 0 0-.293-.707L6 6.59V5h14.001l.002 1.583-5.71 5.71z"></path>
            </svg>
            <span>Filtres</span>
        </button>
    </div>
    <!-- New Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            @if($goals->count() > 0)
                <table class="w-full whitespace-no-wrap">
                    <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Objectif</th>
                        <th class="px-4 py-3">Date</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($goals as $goal)
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                {{ $goal->content }}
                            </td>
                            <td class="px-4 py-3">
                                {{ $goal->created_at->format('d-m-Y') }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <table aria-colspan="7" class="w-full whitespace-no-wrap">
                    <thead aria-colspan="7">
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Objectif</th>
                        <th class="px-4 py-3">Date</th>
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
        </div>

        <div class="mt-4">
            {{ $goals->links() }}
        </div>
@endsection

