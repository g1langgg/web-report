@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-2xl bg-slate-900 px-4 py-3 text-start text-base font-medium text-white focus:outline-none transition duration-150 ease-in-out'
            : 'block w-full rounded-2xl px-4 py-3 text-start text-base font-medium text-slate-600 hover:bg-slate-100 hover:text-slate-900 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
