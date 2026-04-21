@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-emerald-500 text-left text-base font-medium text-emerald-400 bg-slate-800/50 focus:outline-none focus:text-emerald-300 focus:bg-slate-800 focus:border-emerald-600 transition duration-150 ease-in-out'
            : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-slate-400 hover:text-white hover:bg-slate-800 hover:border-slate-600 focus:outline-none focus:text-white focus:bg-slate-800 focus:border-slate-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
