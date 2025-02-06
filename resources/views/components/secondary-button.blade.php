<button {{ $attributes->merge(['type' => 'button', 'class' => 'px-4 py-2 bg-neutral-800 border border-neutral-500 text-neutral-300 hover:bg-neutral-700 transition']) }}>
    {{ $slot }}
</button>
