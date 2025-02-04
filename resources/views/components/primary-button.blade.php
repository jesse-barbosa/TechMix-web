<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full px-4 py-2 bg-yellow-500 hover:bg-yellow-400 font-semibold focus:outline-none transition']) }}>
    {{ $slot }}
</button>
