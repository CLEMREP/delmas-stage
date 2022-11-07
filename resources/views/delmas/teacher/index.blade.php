@extends('delmas.teacher.components.layout')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Tableau de bord
    </h2>

    @component('delmas.components.cards', [
        'firstStats' => $countProcedures,
        'firstTitle' => 'Les démarches',
        'secondStats' => $waitingProcedures,
        'secondTitle' => 'En attente',
        'thirdStats' => $refusedProcedures,
        'thirdTitle' => 'Refusé',
        'fourthStats' => $acceptedProcedures,
        'fourthTitle' =>'Accepté',
    ])
    @endcomponent

    <div class="w-full overflow-hidden rounded-lg shadow-xs mb-6">
        <div class="w-full overflow-x-auto">
            @component('delmas.teacher.components.proceduresTabs', ['procedures' => $procedures])
            @endcomponent
        </div>
    </div>
@endsection
