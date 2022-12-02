@extends('delmas.admin.components.layout')

@section('content')
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Édition de du professeur {{ $teacher->fullname() }}
    </h2>

    <form action="{{ route('admin.teacher.update', $teacher) }}" method="POST">
        @csrf
        <div class="flex flex-col sm:flex-row justify-between w-full">
            <label class="block text-sm w-full mb-4 sm:mb-0 sm:w-1/2 sm:mr-3">
                <span class="text-gray-700 dark:text-gray-400">Nom</span>
                <input class="@error('lastname') border-red-500 @enderror block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="lastname" value="{{ $teacher->lastname }}" placeholder="REPEL">
                @error('lastname')
                <div class="mt-2 flex flex-row items-center justify-start font-medium text-red-500 mb-2">
                    <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </label>
            <label class="block text-sm w-full sm:w-1/2">
                <span class="text-gray-700 dark:text-gray-400">Prénom</span>
                <input class="@error('firstname') border-red-500 @enderror block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="firstname" value="{{ $teacher->firstname }}" placeholder="Clément">
                @error('firstname')
                <div class="mt-2 flex flex-row items-center justify-start font-medium text-red-500 mb-2">
                    <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </label>
        </div>

        <div class="mt-4">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Adresse électronique</span>
                <input class="@error('email') border-red-500 @enderror block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="email" value="{{ $teacher->email }}" placeholder="contact@clement-repel.fr">
                @error('email')
                <div class="mt-2 flex flex-row items-center justify-start font-medium text-red-500 mb-2">
                    <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </label>
        </div>

        <div class="flex flex-col sm:flex-row justify-between mt-4 w-full">
            <label class="block text-sm w-full mb-4 sm:mb-0 sm:w-1/2 sm:mr-3">
                <span class="text-gray-700 dark:text-gray-400">Promotion</span>
                <div x-data="dropdown()" x-init="loadOptions()" class="flex flex-col">
                    <input name="promotion_id" type="hidden" x-bind:value="selectedValues()">
                    <div class="inline-block relative">
                        <div class="flex flex-col items-center relative">
                            <div x-on:click="open" class="w-full">
                                <div class="form-input items-center h-10 flex w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:outline-none dark:text-gray-300 dark:focus:shadow-outline-gray">
                                    <div class="flex flex-auto flex-wrap">
                                        <template x-for="(option,index) in selected" :key="options[option].value">
                                            <div class="flex justify-center items-center my-1 font-medium py-1 px-1 bg-gray-500 border-gray-700 mr-1 rounded border">
                                                <div class="text-xs font-normal leading-none mr-1 max-w-full flex-initial x-model=" options[option] x-text="options[option].text"></div>
                                                <div class="flex flex-auto flex-row-reverse">
                                                    <div x-on:click.stop="remove(index,option)">
                                                        <svg class="fill-white h-4 w-4" role="button" viewBox="0 0 20 20">
                                                            <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                           c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                           l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                           C14.817,13.62,14.817,14.38,14.348,14.849z" />
                                                        </svg>

                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                        <div x-show="selected.length == 0" class="flex-1">
                                            <input placeholder="Choisir une promotion(s)" class="w-full focus:outline-none border-transparent focus:border-transparent focus:ring-0 outline-none text-sm dark:bg-gray-700 dark:text-gray-300 dark:focus:shadow-outline-gray" x-bind:value="selectedValues()">
                                        </div>
                                    </div>
                                    <div class="text-gray-300 w-8 py-1 pl-2 pr-1 flex items-center border-gray-200 svelte-1l8159u">

                                        <button type="button" x-show="isOpen() === true" x-on:click="open" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                            <svg version="1.1" class="fill-white h-4 w-4" viewBox="0 0 20 20">
                                                <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
  c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
  L17.418,6.109z" />
                                            </svg>
                                        </button>
                                        <button type="button" x-show="isOpen() === false" @click="close" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                            <svg class="fill-white h-4 w-4" viewBox="0 0 20 20">
                                                <path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83
  c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z
  " />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full px-4">
                                <div x-show.transition.origin.top="isOpen()" class="absolute shadow top-100 bg-white z-40 w-full left-0 rounded max-h-select" x-on:click.away="close">
                                    <div class="flex flex-col w-full overflow-y-auto h-auto">
                                        <template x-for="(option,index) in options" :key="option" class="overflow-auto">
                                            <div class="cursor-pointer w-full rounded-t border-b border-gray-600 hover:bg-gray-600" @click="select(index,$event)">
                                                <div class="flex w-full border-gray-600 text-gray-300 bg-gray-700 items-center p-2 pl-2 border-l-2 relative">
                                                    <div class="w-full items-center flex justify-between">
                                                        <div class="mx-2 leading-6" x-model="option" x-text="option.text"></div>
                                                        <div x-show="option.selected">
                                                            <svg class="svg-icon" viewBox="0 0 20 20">
                                                                <path fill="none" d="M7.197,16.963H7.195c-0.204,0-0.399-0.083-0.544-0.227l-6.039-6.082c-0.3-0.302-0.297-0.788,0.003-1.087
              C0.919,9.266,1.404,9.269,1.702,9.57l5.495,5.536L18.221,4.083c0.301-0.301,0.787-0.301,1.087,0c0.301,0.3,0.301,0.787,0,1.087
              L7.741,16.738C7.596,16.882,7.401,16.963,7.197,16.963z"></path>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @error('promotion_id')
                <div class="mt-2 flex flex-row items-center justify-start font-medium text-red-500 mb-2">
                    <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </label>

            <select x-cloak id="select" class="hidden">
                @foreach($promotions as $promotion)
                    <option value="{{ $promotion->getKey() }}">{{ $promotion->name }}</option>
                @endforeach
            </select>

            <label class="block text-sm w-full sm:w-1/2">
                <span class="text-gray-700 dark:text-gray-400">Téléphone</span>
                <input class="@error('phone') border-red-500 @enderror block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="phone" value="{{ $teacher->phone }}" placeholder="07 61 38 20 21">
                @error('phone')
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
            <label class="block text-sm w-full mb-4 sm:mb-0 sm:w-1/2 sm:mr-3">
                <span class="text-gray-700 dark:text-gray-400">Mot de passe</span>
                <input class="@error('password') border-red-500 @enderror block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="password" placeholder="Mot de passe" type="password">
                @error('password')
                <div class="mt-2 flex flex-row items-center justify-start font-medium text-red-500 mb-2">
                    <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </label>
            <label class="block text-sm w-full sm:w-1/2">
                <span class="text-gray-700 dark:text-gray-400">Confirmation du mot de passe</span>
                <input class="@error('password_confirmation') border-red-500 @enderror block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" name="password_confirmation" placeholder="Confirmation du mot de passe" type="password">
                @error('password_confirmation')
                <div class="mt-2 flex flex-row items-center justify-start font-medium text-red-500 mb-2">
                    <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                        {{ $message }}
                    </div>
                </div>
                @enderror
            </label>
        </div>

        <div class="flex justify-end mt-6 mb-6">
            <button type="submit" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Modifier le professeur</span>
                <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"><path d="M5 21h14a2 2 0 0 0 2-2V8a1 1 0 0 0-.29-.71l-4-4A1 1 0 0 0 16 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zm10-2H9v-5h6zM13 7h-2V5h2zM5 5h2v4h8V5h.59L19 8.41V19h-2v-5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v5H5z"></path></svg>
            </button>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        function dropdown() {
            return {
                options: [],
                selected: [],
                show: false,
                open() { this.show = true },
                close() { this.show = false },
                isOpen() { return this.show === true },
                select(index, event) {
                    if (!this.options[index].selected) {

                        this.options[index].selected = true;
                        this.options[index].element = event.target;
                        this.selected.push(index);

                    } else {
                        this.selected.splice(this.selected.lastIndexOf(index), 1);
                        this.options[index].selected = false
                    }
                },
                remove(index, option) {
                    this.options[option].selected = false;
                    this.selected.splice(index, 1);


                },
                loadOptions() {
                    const options = document.getElementById('select').options;
                    for (let i = 0; i < options.length; i++) {
                        this.options.push({
                            value: options[i].value,
                            text: options[i].innerText,
                            selected: options[i].getAttribute('selected') != null ? options[i].getAttribute('selected') : false
                        });
                    }

                },
                selectedValues(){
                    return this.selected.map((option) => this.options[option].value)
                }
            }
        }
    </script>
@endpush
