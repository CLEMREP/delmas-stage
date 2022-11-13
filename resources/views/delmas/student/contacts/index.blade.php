@extends('delmas.student.components.layout')

@section('content')
    @if(Session::has('success'))
        <div class="p-4 mb-4 text-sm  rounded-lg bg-green-200 text-green-800" role="alert" x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 5000)">
            <span class="font-medium">{!! Session::get('success') !!}</span>
        </div>
    @endif

    @if(Session::has('errors'))
        <div class="p-4 mb-4 text-sm rounded-lg bg-red-200 text-red-800" role="alert" x-data="{ showError: true }" x-show="showError" x-init="setTimeout(() => showError = false, 5000)">
            <span class="font-medium">{!! Session::get('errors') !!}</span>
        </div>
    @endif

    <livewire:student.contacts-table />
@endsection
