@extends('delmas.superadmin.components.layout')

@section('content')
    @if(Session::has('success'))
        <div class="p-4 mt-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">
            <span class="font-medium">{!! Session::get('success') !!}</span>
        </div>
    @endif

    @if(Session::has('errors'))
        <div class="p-4 mt-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert" x-data="{ showError: true }" x-show="showError" x-init="setTimeout(() => showError = false, 5000)">
            <span class="font-medium">{!! Session::get('errors') !!}</span>
        </div>
    @endif

    <livewire:admin.teachers-table>
@endsection
