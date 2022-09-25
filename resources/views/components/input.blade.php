@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full text-base py-2 border-4 rounded p-2 border-gray-300 focus:outline-none focus:border-indigo-500']) !!}>
