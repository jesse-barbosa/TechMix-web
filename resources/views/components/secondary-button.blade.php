<button {{ $attributes->merge(['type' => 'button', 'class' => 'px-4 py-2 bg-gray-800 border border-gray-500 text-gray-300 hover:bg-gray-700 focus:ring-2 focus:ring-indigo-500 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
