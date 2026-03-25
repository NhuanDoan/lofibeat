<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LofiBeat🎵 - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #312e81; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #4338ca; }
    </style>
</head>
<body class="bg-[#08070B] text-white antialiased overflow-hidden h-screen">

    <div class="flex h-full relative overflow-hidden">
        
        {{-- Sidebar --}}
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 md:w-72 bg-[#0C0B10] border-r border-white/5 p-8 flex flex-col transform -translate-x-full transition-all duration-300 ease-in-out md:relative md:translate-x-0">
            <div class="flex items-center gap-3 mb-10">
                <div class="w-10 h-10 bg-[#BD93F9] rounded-xl flex items-center justify-center shadow-[0_0_20px_rgba(189,147,249,0.3)]">
                    <svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 24 24"><path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/></svg>
                </div>
                <h1 class="text-2xl font-extrabold tracking-tighter">LofiBeat</h1>
            </div>

            <nav class="space-y-2">
                <x-nav-item active icon="home">Home</x-nav-item>
                <x-nav-item icon="explore">Explore</x-nav-item>
                <x-nav-item icon="library">Library</x-nav-item>
            </nav>

            <div class="mt-10">
                <p class="text-[10px] uppercase tracking-[0.2em] text-white/30 font-bold mb-4 px-3">Your Playlist</p>
                <nav class="space-y-2">
                    <x-nav-item icon="plus">Create Playlist</x-nav-item>
                    <x-nav-item icon="heart">Liked Songs</x-nav-item>
                </nav>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 overflow-y-auto bg-gradient-to-br from-[#0D0C14] via-[#08070B] to-[#08070B] relative">
            
            {{-- Mobile Header --}}
            <header class="md:hidden flex items-center justify-between py-4 px-6 sticky top-0 z-40 backdrop-blur-xl bg-[#08070B]/70 border-b border-white/5">
                <button id="menu-toggle" class="p-2 -ml-2 text-white/70 hover:text-white">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                </button>
                <span class="text-xl font-black text-[#BD93F9]">LofiBeat</span>
                <div class="flex items-center gap-4">
                    <button class="p-1 text-white/80 hover:text-white transition-transform active:scale-90">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>

                    <button class="w-9 h-9 rounded-full bg-white/10 border border-white/10 flex items-center justify-center text-white shadow-lg backdrop-blur-md active:scale-95 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </button>
                </div>
            </header>

            {{-- Desktop Header --}}
            <header class="hidden md:flex items-center justify-between py-6 px-10 sticky top-0 z-40 backdrop-blur-md bg-[#08070B]/40">
                <div class="flex items-center gap-4 bg-white/5 rounded-full px-4 py-2 border border-white/5 w-96">
                    <svg class="w-5 h-5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    <input type="text" placeholder="Search for lofi beats..." class="bg-transparent border-none focus:ring-0 text-sm placeholder:text-white/20 w-full">
                </div>
                <div class="flex items-center gap-6">
                    <button class="text-sm font-bold text-white/50 hover:text-white transition">Sign Up</button>
                    <button class="bg-white text-black font-bold px-8 py-2.5 rounded-full text-sm hover:scale-105 transition shadow-lg shadow-white/5">Sign In</button>
                </div>
            </header>
            
            <div class="px-6 md:px-10">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        const btn = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');
        btn.addEventListener('click', (e) => {
            e.stopPropagation();
            sidebar.classList.toggle('-translate-x-full');
            sidebar.classList.toggle('shadow-[0_0_50px_rgba(0,0,0,0.8)]');
        });
        document.addEventListener('click', (e) => {
            if (!sidebar.contains(e.target) && !sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>
</body>
</html>