<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 bg-yellow-500 hover:bg-yellow-400 font-bold focus:outline-none transition']) }}>
    {{ $slot }}
</button>
