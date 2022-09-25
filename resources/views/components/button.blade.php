<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-blue-dark text-gray-100 p-4 w-full rounded-lg tracking-wide
                                font-semibold font-display focus:outline-none focus:shadow-outline shadow-lg']) }}>
    {{ $slot }}
</button>
