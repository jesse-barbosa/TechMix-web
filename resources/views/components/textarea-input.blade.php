@props(['disabled' => false, 'icon' => null])

<div class="relative">
    @if($icon)
        <i class="{{ $icon }} text-neutral-400 absolute left-3 top-4"></i>
    @endif

    <textarea @disabled($disabled) {{ $attributes->merge(['class' => 'min-h-12 max-h-64 border-neutral-700 bg-neutral-900 text-neutral-300 focus:border-yellow-500 focus:ring-0 focus:outline-none rounded-md shadow-sm w-full p-2' . ($icon ? ' pl-10' : '')]) }}></textarea>
</div>
