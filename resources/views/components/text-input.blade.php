@props(['disabled' => false, 'icon' => null])

<div class="w-full">
    @if($icon)
        <i class="{{ $icon }} text-neutral-400 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
    @endif

    <input @disabled($disabled) {{ $attributes->merge(['class' => 'border-neutral-700 bg-neutral-900 text-neutral-300 focus:border-yellow-500 focus:ring-0 focus:outline-none rounded-md shadow-sm']) }}>
</div>
