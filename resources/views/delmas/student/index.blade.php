@extends('delmas.student.components.layout')

@section('content')
    @if(Session::has('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">
            <span class="font-medium">{!! Session::get('success') !!}</span>
        </div>
    @endif

    @if(Session::has('errors'))
        <div class="p-4 mt-6 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert" x-data="{ showError: true }" x-show="showError" x-init="setTimeout(() => showError = false, 5000)">
            <span class="font-medium">{!! Session::get('errors') !!}</span>
        </div>
    @endif

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Tableau de bord
    </h2>

    @if(Hash::check('password', loggedUser()->password))
        <div id="alert-additional-content-2" class="p-4 mb-4 border border-red-300 rounded-lg bg-red-50 dark:bg-red-200" role="alert">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="w-6 h-6 mr-2 text-red-900 dark:text-red-800 mr-3" fill="currentColor">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path>
                    <path d="M11 11h2v6h-2zm0-4h2v2h-2z"></path>
                </svg>
                <span class="sr-only">Info</span>
                <h3 class="text-lg font-medium text-red-900 dark:text-red-800">La sécurité, une priorité.</h3>
            </div>
            <div class="mt-2 mb-4 text-sm text-red-900 dark:text-red-800">
                Vous possédez actuellement le mot de passe par défault. Vous devez impérativement changer le mot de passe !
            </div>
            <div class="flex">
                <a href="{{ route('student.account.edit') }}">
                    <button type="button" class="cursor-pointer text-white bg-red-900 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center dark:bg-red-800 dark:hover:bg-red-900">
                        <svg aria-hidden="true" class="-ml-0.5 mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                        Modifier
                    </button>
                </a>
            </div>
        </div>

    @endif

    @if(is_null(loggedUser()->promotion_id))
        <div class="p-3 mb-6 text-sm text-red-700 rounded-lg border border-red-300 dark:bg-red-200 dark:text-red-80" role="alert">
            <span class="font-medium flex flex-row items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="w-6 h-6 mr-2 text-red-900 dark:text-red-800 mr-3" fill="currentColor">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path>
                    <path d="M11 11h2v6h-2zm0-4h2v2h-2z"></path>
                </svg>
                Vous devez contacter votre professeur référent pour être assigné à votre promotion.
            </span>
        </div>
    @endif

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
