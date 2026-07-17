@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#d4a373] text-sm font-medium leading-5 text-[#d4a373] focus:outline-none focus:border-[#d4a373] transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-white hover:text-[#d4a373] hover:border-[#d4a373] focus:outline-none focus:text-[#d4a373] focus:border-[#d4a373] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
