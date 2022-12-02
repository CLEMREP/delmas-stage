<div class="flex flex-col mt-4 sm:flex-row justify-between w-full">
    <label class="block text-sm mb-4 sm:mb-0 sm:w-1/2 sm:mr-3">
        <span class="text-gray-700 dark:text-gray-400">
          Entreprise
        </span>
        <select wire:model="companyId" class="@error('company_id') border-red-500 @enderror block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="company_id">
            @foreach($companies as $company)
                <option value="{{ $company->getKey() }}" @if($procedure->company->getKey() == $company->getKey()) @selected(true) @endif>{{ $company->name }}</option>
            @endforeach
        </select>
        @error('company_id')
        <div class="mt-2 flex flex-row items-center justify-start font-medium text-red-500 mb-2">
            <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <div>
                {{ $message }}
            </div>
        </div>
        @enderror
    </label>

    @if(count($contacts) > 0)
        <label class="block text-sm mb-4 sm:mb-0 sm:w-1/2">
            <span class="text-gray-700 dark:text-gray-400">
              Contacts
            </span>
            <select class="@error('contact_id') border-red-500 @enderror block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" name="contact_id">
                @foreach($contacts as $contact)
                    <option value="{{ $contact->getKey() }}" @if($procedure->contact->getKey() == $contact->company->getKey()) @selected(true) @endif>{{ $contact->fullname() }}</option>
                @endforeach
            </select>
            @error('contact_id')
            <div class="mt-2 flex flex-row items-center justify-start font-medium text-red-500 mb-2">
                <svg class="w-5 h-5 inline mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <div>
                    {{ $message }}
                </div>
            </div>
            @enderror
        </label>
    @endif
</div>

