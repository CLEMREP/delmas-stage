@extends('delmas.superadmin.components.layout')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Tableau de bord
    </h2>

    @component('delmas.admin.components.cards', [
        'firstStats' => $countUsers,
        'firstTitle' => 'Nombre d\'utilisateurs',
        'secondStats' => $countSeries,
        'secondTitle' => 'Nombre de séries',
        'thirdStats' => $countPromotions,
        'thirdTitle' => 'Nombre de promotions',
        'fourthStats' => $countAdmins,
        'fourthTitle' =>'Nombre d\'administrateurs',
    ])
    @endcomponent


@endsection
