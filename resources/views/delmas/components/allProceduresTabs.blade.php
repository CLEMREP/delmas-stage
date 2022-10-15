@if($allProcedures->count() > 0)
    <table class="w-full whitespace-no-wrap">
        <thead>
        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">Étudiant</th>
            <th class="px-4 py-3">Entreprise</th>
            <th class="px-4 py-3">Format</th>
            <th class="px-4 py-3">Statut</th>
            <th class="px-4 py-3">Date</th>
            <th class="px-4 py-3">Relance</th>
            <th class="px-4 py-3 text-right">Date relance</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        @foreach($allProcedures as $procedure)
            <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-3">
                    {{ $procedure->user()->first()->firstname . ' ' . $procedure->user()->first()->name }}
                </td>
                <td class="px-4 py-3">
                    <a href="{{ route('admin.companies.show', $procedure->company()->first()) }}">
                        {{ $procedure->company()->first()->name }}
                    </a>
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
                <td class="px-4 py-3 text-sm text-center">
                    {{ $procedure->date_resend ?? '-' }}
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
    {{ $allProcedures->links() }}
</div>
