@extends('layouts.app')

@section('title', 'LofiBeat - Chill & Focus')

@section('content')
<div class="pt-6 md:pt-2 space-y-8 md:space-y-10 max-w-[1200px] mx-auto pb-32">
    
    {{-- Banner Hero --}}
    <section class="group relative overflow-hidden rounded-[2rem] border border-white/5 bg-[#1B1532] h-[160px] md:h-[300px] transition-all duration-500 hover:border-[#BD93F9]/30">
        <img
            src="https://images.unsplash.com/photo-1507838153414-b4b713384a76?auto=format&fit=crop&w=1400&q=80"
            alt="Focus and relax"
            class="absolute inset-0 h-full w-full object-cover opacity-50 transition duration-700 group-hover:scale-105"
        >
        <div class="absolute inset-0 bg-gradient-to-t from-[#0E0A1A] via-transparent to-transparent md:bg-gradient-to-r md:from-[#0E0A1A] md:via-[#0E0A1A]/40 md:to-transparent"></div>
        
        <div class="absolute inset-x-0 bottom-6 md:bottom-10 px-6 md:px-12">
            <span class="hidden md:inline-block text-[#BD93F9] font-bold tracking-[0.2em] text-xs uppercase mb-3">Featured Playlist</span>
            <h2 class="text-4xl md:text-7xl font-black leading-none tracking-tighter text-white drop-shadow-2xl">Focus & Relax</h2>
        </div>
    </section>

    {{-- Music Grid Section --}}
    <section>
        <div class="flex items-center justify-between mb-6 md:mb-8">
            <h3 class="text-2xl md:text-4xl font-bold tracking-tight text-white">Lofi Beats for You</h3>
            <a href="#" class="text-[#BD93F9] text-sm font-semibold hover:underline">Show all</a>
        </div>

        @php
            $songs = [
                ['title' => 'Rainy Day', 'artist' => 'Lofi Fruits', 'image' => 'https://images.unsplash.com/photo-1515694346937-94d85e41e6f0?auto=format&fit=crop&w=500&q=80'],
                ['title' => 'Autumn Whistle', 'artist' => 'Lofi Fruits', 'image' => 'https://images.unsplash.com/photo-1477414348463-c0eb7f1359b6?auto=format&fit=crop&w=500&q=80'],
                ['title' => 'Lofi Girl', 'artist' => 'Lofi Fruits', 'image' => 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=500&q=80'],
                ['title' => 'Autumn Whistle', 'artist' => 'Lofi Fruits', 'image' => 'https://images.unsplash.com/photo-1490730141103-6cac27aaab94?auto=format&fit=crop&w=500&q=80'],
            ];
        @endphp

        {{-- Desktop Grid --}}
        <div class="hidden md:grid grid-cols-4 gap-6">
            @foreach ($songs as $song)
                <article class="group bg-white/5 p-4 rounded-2xl border border-white/5 hover:bg-white/10 transition-all duration-300 cursor-pointer">
                    <div class="relative aspect-square rounded-xl overflow-hidden mb-4 shadow-2xl">
                        <img src="{{ $song['image'] }}" alt="{{ $song['title'] }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <button class="h-12 w-12 rounded-full bg-[#BD93F9] text-black flex items-center justify-center shadow-xl transform translate-y-4 group-hover:translate-y-0 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 ml-1"><path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.522-2.333 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.257.69-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" /></svg>
                            </button>
                        </div>
                    </div>
                    <h4 class="font-bold text-lg text-white truncate">{{ $song['title'] }}</h4>
                    <p class="text-sm text-white/50">{{ $song['artist'] }}</p>
                </article>
            @endforeach
        </div>

        {{-- Mobile List --}}
        <div class="md:hidden space-y-4">
            @foreach ($songs as $song)
                <article class="flex items-center gap-4 bg-white/5 p-2 rounded-xl border border-white/5 active:scale-[0.98] transition">
                    <img src="{{ $song['image'] }}" alt="{{ $song['title'] }}" class="h-16 w-16 rounded-lg object-cover">
                    <div class="flex-1 min-w-0">
                        <h4 class="font-bold text-lg text-white truncate">{{ $song['title'] }}</h4>
                        <p class="text-sm text-white/50">{{ $song['artist'] }}</p>
                    </div>
                    <button class="text-[#BD93F9] mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 10a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" /></svg>
                    </button>
                </article>
            @endforeach
        </div>
    </section>
</div>

{{-- Player Bar--}}
<footer class="fixed bottom-0 left-0 right-0 md:left-0 border-t border-white/5 bg-[#0E0A1A]/80 backdrop-blur-2xl px-4 md:px-10 py-4 z-50">
    <div class="flex items-center justify-between max-w-[1200px] mx-auto">
        
        {{-- Track Info --}}
        <div class="flex items-center gap-4 min-w-0 md:w-[30%]">
            <div class="relative group">
                <img src="https://images.unsplash.com/photo-1490730141103-6cac27aaab94?auto=format&fit=crop&w=140&q=80" alt="Current" class="h-14 w-14 rounded-lg object-cover shadow-lg border border-white/10 group-hover:brightness-50 transition">
                <button class="absolute inset-0 items-center justify-center hidden group-hover:flex text-white"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" /></svg></button>
            </div>
            <div class="min-w-0">
                <h5 class="text-base font-bold text-white truncate hover:underline cursor-pointer">Autumn Whistle</h5>
                <p class="text-xs text-white/50 hover:text-white transition cursor-pointer">Lofi Girl</p>
            </div>
        </div>

       <div class="flex-1 flex flex-col items-center max-w-[45%] px-4">
            {{-- Control Buttons --}}
            <div class="flex items-center gap-7 mb-2.5">
                
                {{-- Previous --}}
                <button class="text-white/40 hover:text-white transition-all duration-200 active:scale-90">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path d="M7.712 4.818A1.5 1.5 0 0 1 10 6.095v2.972c.104-.13.234-.248.389-.343l6.323-3.906A1.5 1.5 0 0 1 19 6.095v7.81a1.5 1.5 0 0 1-2.288 1.276l-6.323-3.905a1.505 1.505 0 0 1-.389-.344v2.973a1.5 1.5 0 0 1-2.288 1.276l-6.323-3.905a1.5 1.5 0 0 1 0-2.552l6.323-3.906Z" />
                    </svg>
                </button>

                {{-- Play --}}
                <button class="h-12 w-12 rounded-full bg-white text-black flex items-center justify-center hover:scale-110 transition-all duration-300 active:scale-95 shadow-[0_0_15px_rgba(255,255,255,0.1)] hover:shadow-[#BD93F9]/40">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-7 h-7 ml-0.5">
                        <path d="M5 3L19 12L5 21V3Z" />
                    </svg>
                </button>

                {{-- Next --}}
                <button class="text-white/40 hover:text-white transition-all duration-200 active:scale-90">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path d="M3.288 4.818A1.5 1.5 0 0 0 1 6.095v7.81a1.5 1.5 0 0 0 2.288 1.276l6.323-3.905c.155-.096.285-.213.389-.344v2.973a1.5 1.5 0 0 0 2.288 1.276l6.323-3.905a1.5 1.5 0 0 0 0-2.552l-6.323-3.906A1.5 1.5 0 0 0 10 6.095v2.972a1.506 1.506 0 0 0-.389-.343L3.288 4.818Z" />
                    </svg>
                </button>
            </div>
            
            {{-- Seek Bar --}}
            <div class="w-full flex items-center gap-3 group/progress">
                <span class="text-[11px] font-medium text-white/40 tabular-nums min-w-[35px] text-right">1:24</span>

                <div class="relative flex-1 h-1.5 flex items-center cursor-pointer">
                    <div class="absolute w-full h-1 bg-white/10 rounded-full"></div>

                    <div class="absolute h-1 bg-[#BD93F9] w-[60%] rounded-full group-hover/progress:bg-[#A287F4] transition-colors"></div>

                    <div class="absolute left-[60%] h-3 w-3 bg-white rounded-full shadow-lg opacity-0 group-hover/progress:opacity-100 transition-opacity -ml-1.5"></div>
                </div>

                <span class="text-[11px] font-medium text-white/40 tabular-nums min-w-[35px]">3:45</span>
            </div>
        </div>

        {{-- Volume & Extra --}}
        <div class="hidden md:flex items-center justify-end gap-3 w-[25%]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-white/50"><path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.287a6 6 0 0 1 0 7.427M12 6.75v10.5a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6l4.72-4.72a.75.75 0 0 1 1.28.53Z" /></svg>
            <div class="h-1 w-24 bg-white/10 rounded-full">
                <div class="h-full w-2/3 bg-[#BD93F9] rounded-full"></div>
            </div>
        </div>
    </div>
</footer>
@endsection