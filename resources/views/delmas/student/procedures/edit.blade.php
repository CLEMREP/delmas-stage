@extends('delmas.student.components.layout')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Édition de la démarche chez {{ $procedure->company()->first()->name }}
    </h2>

    <form x-data="{ resend: '{{ $procedure->resend }}' }" action="{{ route('student.procedures.update', $procedure) }}" method="POST">
        @csrf
        <livewire:student.edit-procedure :procedure="$procedure" />

        <div class="flex flex-col mt-4 sm:flex-row justify-between w-full">
            <label class="block text-sm mb-4 sm:mb-0 sm:w-1/2 sm:mr-3">
                <span class="text-gray-700 dark:text-gray-400">Statut</span>
                <select class="@error('status_id') border-red-500 @enderror block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="status_id">
                    @foreach($statuses as $status)
                        <option value="{{ $status->getKey() }}" @if($procedure->status->getKey() == $status->getKey()) @selected(true) @endif>{{ $status->name }}</option>
                    @endforeach
                </select>
                @error('status_id')
                <div class="mt-2 flex flex-row items-center justify-start font-medium text-red-500 mb-2">
                    <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </label>

            <label class="block text-sm mb-4 sm:mb-0 sm:w-1/2">
                <span class="text-gray-700 dark:text-gray-400">Format</span>
                <select class="@error('status_id') border-red-500 @enderror block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="format_id">
                    @foreach($formats as $format)
                        <option value="{{ $format->getKey() }}" @if($procedure->format->getKey() == $format->getKey()) @selected(true) @endif>{{ $format->name }}</option>
                    @endforeach
                </select>
                @error('status_id')
                <div class="mt-2 flex flex-row items-center justify-start font-medium text-red-500 mb-2">
                    <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </label>
        </div>

        <div class="flex flex-col mt-4 sm:flex-row justify-between w-full">
            <label class="block text-sm w-full sm:w-1/2 sm:mr-3">
                <span class="text-gray-700 dark:text-gray-400">Date de démarchage</span>
                <input type="date" class="@error('date') border-red-500 @enderror block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $procedure->date->format('Y-m-d') }}" name="date">
                @error('date')
                <div class="mt-2 flex flex-row items-center justify-start font-medium text-red-500 mb-2">
                    <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </label>

            <label class="block text-sm mb-4 sm:mb-0 w-full sm:w-1/2">
                <span class="text-gray-700 dark:text-gray-400">Relance</span>
                <select x-on:change="$event.target.value === '0' ? resend = false : resend = true" id="resend" class="@error('resend') border-red-500 @enderror block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="resend">
                    <option value="0">Non</option>
                    <option value="1" @if($procedure->resend)@selected(true)@endif>Oui</option>
                    @error('resend')
                    <div class="mt-2 flex flex-row items-center justify-start font-medium text-red-500 mb-2">
                        <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div>
                            {{ $message }}
                        </div>
                    </div>
                    @enderror
                </select>
            </label>
        </div>

        <div x-show="resend" class="flex flex-col mt-4 sm:flex-row justify-between w-full">
            <label class="block text-sm sm:w-1/2">
                <span class="text-gray-700 dark:text-gray-400">Date de relance</span>
                <input type="date" class="@error('date_resend') border-red-500 @enderror block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" value="{{ $procedure->date_resend }}" name="date_resend">
                @error('date_resend')
                <div class="mt-2 flex flex-row items-center justify-start font-medium text-red-500 mb-2">
                    <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </label>
        </div>

        <div class="flex justify-end mt-6">
            <button class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Sauvegarder les changements</span>
                <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"><path d="M5 21h14a2 2 0 0 0 2-2V8a1 1 0 0 0-.29-.71l-4-4A1 1 0 0 0 16 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zm10-2H9v-5h6zM13 7h-2V5h2zM5 5h2v4h8V5h.59L19 8.41V19h-2v-5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v5H5z"></path></svg>
            </button>
        </div>
    </form>
@endsection