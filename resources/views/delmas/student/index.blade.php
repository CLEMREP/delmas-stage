@extends('delmas.student.components.layout')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Tableau de bord
    </h2>

    @if($goals->count() > 0)
        <a class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
           href="{{ route('student.goals.index') }}">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2"
                     fill="currentColor"
                     viewBox="0 0 20 20">
                    <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                    ></path>
                </svg>
                <span>{{ $goals->last()->content }}</span>
            </div>
            <span>Voir plus &RightArrow;</span>
        </a>
    @endif

    @component('delmas.components.cards', [
        'firstStats' => $countProcedures,
        'firstTitle' => 'Mes démarches',
        'secondStats' => $waitingProcedures,
        'secondTitle' => 'En attente',
        'thirdStats' => $refusedProcedures,
        'thirdTitle' => 'Refusé',
        'fourthStats' => $acceptedProcedures,
        'fourthTitle' =>'Accepté',
    ])
    @endcomponent

    <!-- New Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            @component('delmas.student.components.proceduresTabs', ['procedures' => $procedures])
            @endcomponent
        </div>
    </div>
@endsection
