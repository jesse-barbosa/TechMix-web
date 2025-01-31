@props(['active', 'icon'])

@php
$classes = ($active ?? false)
            ? 'flex items-center w-full ps-6 text-sm font-medium text-neutral-100'
            : 'flex items-center w-full ps-6 text-sm font-medium text-neutral-400 hover:text-neutral-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon)
        <span class="material-icons mr-2">{{ $icon }}</span>
    @endif
    {{ $slot }}
</a>
