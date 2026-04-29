@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center border border-slate-200 bg-slate-900 text-sm font-medium leading-5 text-white shadow-sm focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center border border-transparent text-sm font-medium leading-5 text-slate-500 hover:bg-slate-100 hover:text-slate-900 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
