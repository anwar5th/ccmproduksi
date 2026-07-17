@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-[#d4a373] text-left text-base font-medium text-[#d4a373] bg-[#5c3a21]/20 focus:outline-none focus:text-[#d4a373] focus:bg-[#5c3a21]/30 focus:border-[#d4a373] transition duration-150 ease-in-out'
            : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-white hover:text-[#d4a373] hover:bg-[#5c3a21]/10 hover:border-[#d4a373] focus:outline-none focus:text-[#d4a373] focus:bg-[#5c3a21]/10 focus:border-[#d4a373] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
