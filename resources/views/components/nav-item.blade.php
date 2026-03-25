@props(['icon' => 'home', 'active' => false])

@php
    $icons = [
        'home' => 'm2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25',
        'explore' => 'm21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z',
        'library' => 'M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25',
        'plus' => 'M12 4.5v15m7.5-7.5h-15',
        'heart' => 'M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z'
    ];

    $activeClasses = $active 
        ? 'bg-white/10 text-white shadow-sm' 
        : 'text-white/50 hover:text-white hover:bg-white/5';
    
    $iconClasses = $active ? 'text-[#BD93F9]' : 'text-white/30 group-hover:text-white';
@endphp

<a {{ $attributes->merge(['class' => "flex items-center gap-4 py-3 px-4 rounded-2xl transition-all duration-300 group " . $activeClasses]) }}>
    @if(isset($icons[$icon]))
        <svg class="w-6 h-6 {{ $iconClasses }} transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icons[$icon] }}" />
        </svg>
    @endif
    <span class="font-bold tracking-tight">{{ $slot }}</span>
</a>