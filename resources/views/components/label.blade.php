@props(['value'])

<label {{ $attributes->merge(['class' => 'text-sm font-bold mb-2 text-blue-dark tracking-wide']) }}>
    {{ $value ?? $slot }}
</label>
