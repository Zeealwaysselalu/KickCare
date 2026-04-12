@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-[var(--gray)] font-medium transition-colors duration-200 hover:text-[var(--navy)]'
            : 'text-[var(--blue)] font-semibold transition-colors duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
