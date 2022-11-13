@extends('delmas.admin.components.layout')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Tableau de bord
    </h2>

    @component('delmas.admin.components.cards', [
        'firstStats' => $countUsers,
        'firstTitle' => 'Nombre d\'utilisateurs',
        'secondStats' => $countPromotions,
        'secondTitle' => 'Nombre de promotions',
        'thirdStats' => $countProcedures,
        'thirdTitle' => 'Nombre de démarches',
        'fourthStats' => $countCompanies,
        'fourthTitle' =>'Nombre d\'entreprises qui recrutent',
    ])
    @endcomponent


@endsection
