@if($procedures->count() > 0)
    <table class="w-full whitespace-no-wrap">
        <thead>
        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
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
                    {{ $procedure->company()->first()->name }}
                </td>
                <td class="px-4 py-3">
                    {{ $procedure->format()->first()->name }}
                </td>
                <td class="px-4 py-3 text-sm">
                    @component('FrontDelmas.components.status', [
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
                <td class="px-4 py-3">
                    <div class="flex items-center justify-end text-sm">
                        <a href="{{ route('procedures.show', $procedure) }}">
                            <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Show">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24" >
                                    <path d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 11c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4z"></path><path d="M12 10c-1.084 0-2 .916-2 2s.916 2 2 2 2-.916 2-2-.916-2-2-2z"></path>
                                </svg>
                            </button>
                        </a>
                        <a href="{{ route('procedures.edit', $procedure) }}">
                            <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24" >
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                </svg>
                            </button>
                        </a>
                        <form action="{{ route('procedures.destroy', $procedure) }}" method="POST">
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
