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
            <button id="songs-show-all" type="button" class="text-[#BD93F9] text-sm font-semibold hover:underline">Show all</button>
        </div>

        <div id="songs-loading" class="text-white/60">Loading songs...</div>

        <div id="songs-grid" class="hidden md:grid grid-cols-4 gap-6"></div>

        <div id="songs-mobile" class="md:hidden space-y-4"></div>

        <div id="songs-empty" class="hidden text-white/50 text-sm">No songs found.</div>

        <div id="songs-pagination" class="hidden mt-6 items-center justify-between gap-3">
            <button id="songs-prev-page" type="button" class="px-3 py-1.5 text-xs md:text-sm rounded-lg border border-white/10 text-white/70 hover:text-white hover:border-white/20 disabled:opacity-40 disabled:cursor-not-allowed">Prev</button>
            <p id="songs-page-info" class="text-xs md:text-sm text-white/60 text-center">Page 1 / 1</p>
            <button id="songs-next-page" type="button" class="px-3 py-1.5 text-xs md:text-sm rounded-lg border border-white/10 text-white/70 hover:text-white hover:border-white/20 disabled:opacity-40 disabled:cursor-not-allowed">Next</button>
        </div>
    </section>
</div>

{{-- Player Bar--}}
<footer class="fixed bottom-0 left-0 right-0 md:left-0 border-t border-white/5 bg-[#0E0A1A]/80 backdrop-blur-2xl px-4 md:px-10 py-4 z-50">
    <div class="flex items-center justify-between max-w-[1200px] mx-auto">
        
        {{-- Track Info --}}
        <div class="flex items-center gap-4 min-w-0 md:w-[30%]">
            <div class="relative group">
                <img id="player-cover" src="https://images.unsplash.com/photo-1490730141103-6cac27aaab94?auto=format&fit=crop&w=140&q=80" alt="Current" class="h-14 w-14 rounded-lg object-cover shadow-lg border border-white/10 group-hover:brightness-50 transition">
                <button class="absolute inset-0 items-center justify-center hidden group-hover:flex text-white"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" /></svg></button>
            </div>
            <div class="min-w-0">
                <h5 id="player-title" class="text-base font-bold text-white truncate hover:underline cursor-pointer">Now playing</h5>
                <p id="player-artist" class="text-xs text-white/50 hover:text-white transition cursor-pointer">LofiBeat</p>
            </div>
        </div>

       <div class="flex-1 flex flex-col items-center max-w-[45%] px-4">
            {{-- Control Buttons --}}
            <div class="flex items-center gap-7 mb-2.5">
                
                {{-- Previous --}}
                <button id="player-prev" class="text-white/40 hover:text-white transition-all duration-200 active:scale-90">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path d="M7.712 4.818A1.5 1.5 0 0 1 10 6.095v2.972c.104-.13.234-.248.389-.343l6.323-3.906A1.5 1.5 0 0 1 19 6.095v7.81a1.5 1.5 0 0 1-2.288 1.276l-6.323-3.905a1.505 1.505 0 0 1-.389-.344v2.973a1.5 1.5 0 0 1-2.288 1.276l-6.323-3.905a1.5 1.5 0 0 1 0-2.552l6.323-3.906Z" />
                    </svg>
                </button>

                {{-- Play --}}
                <button id="player-toggle" class="h-12 w-12 rounded-full bg-white text-black flex items-center justify-center hover:scale-110 transition-all duration-300 active:scale-95 shadow-[0_0_15px_rgba(255,255,255,0.1)] hover:shadow-[#BD93F9]/40">
                    <svg id="player-toggle-icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-7 h-7 ml-0.5">
                        <path d="M5 3L19 12L5 21V3Z" />
                    </svg>
                </button>

                {{-- Next --}}
                <button id="player-next" class="text-white/40 hover:text-white transition-all duration-200 active:scale-90">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path d="M3.288 4.818A1.5 1.5 0 0 0 1 6.095v7.81a1.5 1.5 0 0 0 2.288 1.276l6.323-3.905c.155-.096.285-.213.389-.344v2.973a1.5 1.5 0 0 0 2.288 1.276l6.323-3.905a1.5 1.5 0 0 0 0-2.552l-6.323-3.906A1.5 1.5 0 0 0 10 6.095v2.972a1.506 1.506 0 0 0-.389-.343L3.288 4.818Z" />
                    </svg>
                </button>
            </div>
            
            {{-- Seek Bar --}}
            <div class="w-full flex items-center gap-3 group/progress">
                <span id="player-current-time" class="text-[11px] font-medium text-white/40 tabular-nums min-w-[35px] text-right">0:00</span>

                <div id="player-seekbar" class="relative flex-1 h-1.5 flex items-center cursor-pointer select-none touch-none">
                    <div class="absolute w-full h-1 bg-white/10 rounded-full"></div>

                    <div id="player-progress" class="absolute h-1 bg-[#BD93F9] w-0 rounded-full group-hover/progress:bg-[#A287F4] transition-colors"></div>

                    <div id="player-progress-thumb" class="absolute left-0 h-3 w-3 bg-white rounded-full shadow-lg opacity-0 group-hover/progress:opacity-100 transition-opacity -ml-1.5"></div>
                </div>

                <span id="player-duration" class="text-[11px] font-medium text-white/40 tabular-nums min-w-[35px]">0:00</span>
            </div>
        </div>

        {{-- Volume & Extra --}}
        <div class="hidden md:flex items-center justify-end gap-3 w-[25%]">
            <button id="player-mute" class="text-white/60 hover:text-white" aria-label="Toggle mute">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.287a6 6 0 0 1 0 7.427M12 6.75v10.5a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6l4.72-4.72a.75.75 0 0 1 1.28.53Z" /></svg>
            </button>
            <div id="player-volume-bar" class="relative h-1.5 w-24 bg-white/10 rounded-full cursor-pointer">
                <div id="player-volume-level" class="h-full w-2/3 bg-[#BD93F9] rounded-full"></div>
                <div id="player-volume-thumb" class="absolute top-1/2 left-2/3 h-3.5 w-3.5 -translate-y-1/2 -ml-1.5 rounded-full border border-[#BD93F9]/70 bg-white shadow-[0_0_0_2px_rgba(0,0,0,0.35)] pointer-events-none"></div>
            </div>
        </div>
    </div>
</footer>

<audio id="player-audio" preload="metadata"></audio>

<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const loadingEl = document.getElementById('songs-loading');
        const emptyEl = document.getElementById('songs-empty');
        const desktopGridEl = document.getElementById('songs-grid');
        const mobileListEl = document.getElementById('songs-mobile');
        const showAllBtnEl = document.getElementById('songs-show-all');
        const paginationEl = document.getElementById('songs-pagination');
        const prevPageBtnEl = document.getElementById('songs-prev-page');
        const nextPageBtnEl = document.getElementById('songs-next-page');
        const pageInfoEl = document.getElementById('songs-page-info');
        const searchInputEl = document.getElementById('global-song-search');
        const playerTitleEl = document.getElementById('player-title');
        const playerArtistEl = document.getElementById('player-artist');
        const playerCoverEl = document.getElementById('player-cover');
        const playerAudioEl = document.getElementById('player-audio');
        const playerToggleBtnEl = document.getElementById('player-toggle');
        const playerToggleIconEl = document.getElementById('player-toggle-icon');
        const playerPrevBtnEl = document.getElementById('player-prev');
        const playerNextBtnEl = document.getElementById('player-next');
        const playerCurrentTimeEl = document.getElementById('player-current-time');
        const playerDurationEl = document.getElementById('player-duration');
        const playerSeekbarEl = document.getElementById('player-seekbar');
        const playerProgressEl = document.getElementById('player-progress');
        const playerProgressThumbEl = document.getElementById('player-progress-thumb');
        const playerMuteEl = document.getElementById('player-mute');
        const playerVolumeBarEl = document.getElementById('player-volume-bar');
        const playerVolumeLevelEl = document.getElementById('player-volume-level');
        const playerVolumeThumbEl = document.getElementById('player-volume-thumb');

        const fallbackCover = 'https://images.unsplash.com/photo-1490730141103-6cac27aaab94?auto=format&fit=crop&w=500&q=80';
        const fallbackAudio = '';
        let currentSongs = [];
        let currentIndex = 0;
        let isPlaying = false;
        let isSeeking = false;
        let wasPlayingBeforeSeek = false;
        let isAdjustingVolume = false;
        let searchTimer = null;
        let pendingSeekRatio = null;
        let seekCommitRafId = null;
        let currentKeyword = '';
        let currentPage = 1;
        let lastPage = 1;
        const songsPerPage = 12;

        const escapeHtml = (value) => String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');

        const resolveStorageUrl = (value, fallback = '') => {
            if (!value) return fallback;
            if (value.startsWith('http://') || value.startsWith('https://')) return value;

            const normalized = value.replace(/^\/+/, '');

            if (normalized.startsWith('storage/')) {
                return '/' + normalized;
            }

            return '/storage/' + normalized;
        };

        const resolveImage = (value) => resolveStorageUrl(value, fallbackCover);
        const resolveAudio = (value) => resolveStorageUrl(value, fallbackAudio);

        const getFallbackDuration = () => {
            const rawDuration = currentSongs[currentIndex]?.duration_seconds;
            const parsed = Number(rawDuration);
            return Number.isFinite(parsed) && parsed > 0 ? parsed : 0;
        };

        const getEffectiveDuration = () => {
            if (Number.isFinite(playerAudioEl.duration) && playerAudioEl.duration > 0) {
                return playerAudioEl.duration;
            }

            return getFallbackDuration();
        };

        const formatTime = (seconds) => {
            if (!Number.isFinite(seconds) || seconds < 0) return '0:00';
            const minutes = Math.floor(seconds / 60);
            const remaining = Math.floor(seconds % 60).toString().padStart(2, '0');
            return `${minutes}:${remaining}`;
        };

        const updateProgressUi = () => {
            const duration = getEffectiveDuration();
            const currentTime = playerAudioEl.currentTime;
            const progressPercent = duration ? Math.max(0, Math.min(100, (currentTime / duration) * 100)) : 0;

            playerCurrentTimeEl.textContent = formatTime(currentTime);
            playerDurationEl.textContent = formatTime(duration);
            playerProgressEl.style.width = `${progressPercent}%`;
            playerProgressThumbEl.style.left = `${progressPercent}%`;
        };

        const updateVolumeUi = () => {
            const percent = Math.max(0, Math.min(100, playerAudioEl.volume * 100));
            playerVolumeLevelEl.style.width = `${percent}%`;
            playerVolumeThumbEl.style.left = `${percent}%`;
            playerMuteEl.classList.toggle('text-white/30', playerAudioEl.muted || playerAudioEl.volume === 0);
            playerMuteEl.classList.toggle('text-white/60', !(playerAudioEl.muted || playerAudioEl.volume === 0));
        };

        const updateSeekbarUi = (ratio) => {
            const percent = ratio * 100;
            playerProgressEl.style.width = `${percent}%`;
            playerProgressThumbEl.style.left = `${percent}%`;
        };

        const updatePaginationUi = (pagination = null) => {
            const current = Number(pagination?.current_page) || 1;
            const last = Number(pagination?.last_page) || 1;
            const total = Number(pagination?.total) || 0;

            currentPage = current;
            lastPage = last;

            pageInfoEl.textContent = `Page ${current} / ${last} • ${total} songs`;
            prevPageBtnEl.disabled = current <= 1;
            nextPageBtnEl.disabled = current >= last;
            if (total === 0) {
                paginationEl.classList.add('hidden');
                paginationEl.style.display = 'none';
                return;
            }

            paginationEl.classList.remove('hidden');
            paginationEl.style.display = 'flex';
        };

        // Seekbar chống reset: chỉ set currentTime khi thả tay.
        const handleSeekAction = (clientX, isFinal = false) => {
            const rect = playerSeekbarEl.getBoundingClientRect();
            if (!rect.width) return;

            const offsetX = clientX - rect.left;
            const ratio = Math.max(0, Math.min(1, offsetX / rect.width));
            const duration = getEffectiveDuration();

            updateSeekbarUi(ratio);
            playerCurrentTimeEl.textContent = formatTime(duration * ratio);

            if (!isFinal) return;

            // Chỉ khi thả tay mới "commit" seek để tránh browser reset/nhảy lúc pointermove liên tục.
            const durationOk = Number.isFinite(playerAudioEl.duration) && playerAudioEl.duration > 0;
            const readyOk = playerAudioEl.readyState >= 1;
            const seekableOk = playerAudioEl.seekable && playerAudioEl.seekable.length > 0;

            if (!durationOk || !readyOk) return;

            const targetDuration = playerAudioEl.duration;
            const targetTime = targetDuration * ratio;

            try {
                if (seekableOk) {
                    const start = playerAudioEl.seekable.start(0);
                    const end = playerAudioEl.seekable.end(0);
                    const clamped = Math.max(start, Math.min(end, targetTime));
                    playerAudioEl.currentTime = clamped;
                } else {
                    // Fallback: thay vì set currentTime (dễ reset về 0),
                    // dùng fragment #t= để trình duyệt tự start từ thời gian tương ứng.
                    const baseSrc = String(playerAudioEl.src).split('#')[0];
                    playerAudioEl.src = `${baseSrc}#t=${targetTime.toFixed(2)}`;
                    playerAudioEl.load();
                }
            } catch (_) {
                // Nếu trình duyệt vẫn chưa set seek kịp thì bỏ qua lần commit này.
            }
        };

        const setVolumeFromClientX = (clientX) => {
            const rect = playerVolumeBarEl.getBoundingClientRect();
            const offsetX = clientX - rect.left;
            const ratio = Math.max(0, Math.min(1, offsetX / rect.width));
            playerAudioEl.volume = ratio;
            playerAudioEl.muted = ratio === 0;
            updateVolumeUi();
        };

        const setPlayIcon = (playing) => {
            playerToggleIconEl.innerHTML = playing
                ? '<path d="M6 5h4v14H6zM14 5h4v14h-4z" />'
                : '<path d="M5 3L19 12L5 21V3Z" />';
        };

        const setCurrentSong = (song, index) => {
            currentIndex = index;
            playerTitleEl.textContent = song.title ?? 'Now playing';
            playerArtistEl.textContent = song.artist?.name ?? 'Unknown Artist';
            playerCoverEl.src = resolveImage(song.cover_image);
            playerCoverEl.alt = song.title ?? 'Now playing';
            playerAudioEl.src = resolveAudio(song.file_url);
            playerAudioEl.load();
            playerCurrentTimeEl.textContent = '0:00';
            playerDurationEl.textContent = formatTime(getFallbackDuration());
            playerProgressEl.style.width = '0%';
            playerProgressThumbEl.style.left = '0%';

            document.querySelectorAll('[data-song-card="true"]').forEach((element) => {
                if (Number(element.dataset.index) === index) {
                    element.classList.add('ring-1', 'ring-[#BD93F9]/60', 'bg-white/10');
                } else {
                    element.classList.remove('ring-1', 'ring-[#BD93F9]/60', 'bg-white/10');
                }
            });
        };

        const playSong = async () => {
            if (!playerAudioEl.src) return;
            try {
                await playerAudioEl.play();
                isPlaying = true;
                setPlayIcon(true);
            } catch (_) {
                isPlaying = false;
                setPlayIcon(false);
            }
        };

        const pauseSong = () => {
            playerAudioEl.pause();
            isPlaying = false;
            setPlayIcon(false);
        };

        const bindStaticInteractions = () => {
            playerToggleBtnEl.addEventListener('click', async () => {
                if (isPlaying) {
                    pauseSong();
                } else {
                    await playSong();
                }
            });

            playerPrevBtnEl.addEventListener('click', async () => {
                if (currentSongs.length === 0) return;
                const nextIndex = (currentIndex - 1 + currentSongs.length) % currentSongs.length;
                setCurrentSong(currentSongs[nextIndex], nextIndex);
                await playSong();
            });

            playerNextBtnEl.addEventListener('click', async () => {
                if (currentSongs.length === 0) return;
                const nextIndex = (currentIndex + 1) % currentSongs.length;
                setCurrentSong(currentSongs[nextIndex], nextIndex);
                await playSong();
            });

            playerAudioEl.addEventListener('ended', async () => {
                if (currentSongs.length === 0) return;
                const nextIndex = (currentIndex + 1) % currentSongs.length;
                setCurrentSong(currentSongs[nextIndex], nextIndex);
                await playSong();
            });

            playerAudioEl.addEventListener('loadedmetadata', updateProgressUi);
            playerAudioEl.addEventListener('durationchange', updateProgressUi);
            playerAudioEl.addEventListener('canplay', updateProgressUi);
            playerAudioEl.addEventListener('timeupdate', () => {
                // Không update progress tự động khi đang kéo để UI không giật.
                if (!isSeeking) updateProgressUi();
            });

            playerSeekbarEl.addEventListener('pointerdown', (event) => {
                event.preventDefault();
                isSeeking = true;
                wasPlayingBeforeSeek = isPlaying;

                // Tạm pause để tránh browser reset currentTime khi đang kéo liên tục.
                if (wasPlayingBeforeSeek) pauseSong();

                playerSeekbarEl.setPointerCapture(event.pointerId);
                handleSeekAction(event.clientX, false); // chỉ update UI
            }, { passive: false });

            playerSeekbarEl.addEventListener('pointermove', (event) => {
                if (!isSeeking) return;
                event.preventDefault();
                handleSeekAction(event.clientX, false); // chỉ update UI
            }, { passive: false });

            const stopSeeking = async (event) => {
                if (!isSeeking) return;
                isSeeking = false;

                // Commit seek cuối cùng khi thả tay.
                handleSeekAction(event.clientX, true);

                if (event && playerSeekbarEl.hasPointerCapture(event.pointerId)) {
                    playerSeekbarEl.releasePointerCapture(event.pointerId);
                }

                if (wasPlayingBeforeSeek) {
                    wasPlayingBeforeSeek = false;
                    await playSong();
                }
            };

            playerSeekbarEl.addEventListener('pointerup', stopSeeking);
            playerSeekbarEl.addEventListener('pointercancel', stopSeeking);

            playerVolumeBarEl.addEventListener('mousedown', (event) => {
                isAdjustingVolume = true;
                setVolumeFromClientX(event.clientX);
            });

            playerVolumeBarEl.addEventListener('click', (event) => {
                setVolumeFromClientX(event.clientX);
            });

            window.addEventListener('mousemove', (event) => {
                if (isAdjustingVolume) {
                    setVolumeFromClientX(event.clientX);
                }
            });

            window.addEventListener('mouseup', () => {
                isAdjustingVolume = false;
            });

            playerMuteEl.addEventListener('click', () => {
                playerAudioEl.muted = !playerAudioEl.muted;
                updateVolumeUi();
            });

            desktopGridEl.addEventListener('click', async (event) => {
                const card = event.target.closest('[data-song-card="true"]');
                if (!card) return;

                const index = Number(card.dataset.index);
                if (Number.isFinite(index) && index === currentIndex) {
                    // Bấm lại đúng bài đang phát: không load lại (tránh bị chạy lại từ đầu).
                    if (isPlaying) {
                        pauseSong();
                    } else {
                        // Nếu bài đã kết thúc thì cho chạy lại từ đầu.
                        const duration = getEffectiveDuration();
                        const shouldRestart = duration > 0 && playerAudioEl.currentTime >= duration - 0.25;
                        if (shouldRestart) {
                            const song = currentSongs[index];
                            if (song) setCurrentSong(song, index);
                        }
                        await playSong();
                    }
                    return;
                }
                const song = currentSongs[index];
                if (!song) return;

                setCurrentSong(song, index);
                await playSong();
            });

            mobileListEl.addEventListener('click', async (event) => {
                const card = event.target.closest('[data-song-card="true"]');
                if (!card) return;

                const index = Number(card.dataset.index);
                if (Number.isFinite(index) && index === currentIndex) {
                    // Bấm lại đúng bài đang phát: không load lại (tránh bị chạy lại từ đầu).
                    if (isPlaying) {
                        pauseSong();
                    } else {
                        // Nếu bài đã kết thúc thì cho chạy lại từ đầu.
                        const duration = getEffectiveDuration();
                        const shouldRestart = duration > 0 && playerAudioEl.currentTime >= duration - 0.25;
                        if (shouldRestart) {
                            const song = currentSongs[index];
                            if (song) setCurrentSong(song, index);
                        }
                        await playSong();
                    }
                    return;
                }
                const song = currentSongs[index];
                if (!song) return;

                setCurrentSong(song, index);
                await playSong();
            });

            if (searchInputEl) {
                searchInputEl.addEventListener('input', () => {
                    const keyword = searchInputEl.value.trim();

                    if (searchTimer) {
                        clearTimeout(searchTimer);
                    }

                    searchTimer = setTimeout(async () => {
                        currentKeyword = keyword;
                        await fetchSongs(currentKeyword, 1);
                    }, 350);
                });
            }

            showAllBtnEl.addEventListener('click', async () => {
                if (searchInputEl) {
                    searchInputEl.value = '';
                }
                currentKeyword = '';
                await fetchSongs('', 1);
            });

            prevPageBtnEl.addEventListener('click', async () => {
                if (currentPage <= 1) return;
                await fetchSongs(currentKeyword, currentPage - 1);
            });

            nextPageBtnEl.addEventListener('click', async () => {
                if (currentPage >= lastPage) return;
                await fetchSongs(currentKeyword, currentPage + 1);
            });
        };

        const desktopCard = (song, index) => `
            <article data-song-card="true" data-index="${index}" class="group bg-white/5 p-4 rounded-2xl border border-white/5 hover:bg-white/10 transition-all duration-300 cursor-pointer">
                <div class="relative aspect-square rounded-xl overflow-hidden mb-4 shadow-2xl">
                    <img src="${resolveImage(song.cover_image)}" alt="${escapeHtml(song.title)}" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <button class="h-12 w-12 rounded-full bg-[#BD93F9] text-black flex items-center justify-center shadow-xl transform translate-y-4 group-hover:translate-y-0 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 ml-1"><path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.522-2.333 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.257.69-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" /></svg>
                        </button>
                    </div>
                </div>
                <h4 class="font-bold text-lg text-white truncate">${escapeHtml(song.title)}</h4>
                <p class="text-sm text-white/50">${escapeHtml(song.artist?.name ?? 'Unknown Artist')}</p>
            </article>
        `;

        const mobileItem = (song, index) => `
            <article data-song-card="true" data-index="${index}" class="flex items-center gap-4 bg-white/5 p-2 rounded-xl border border-white/5 active:scale-[0.98] transition cursor-pointer">
                <img src="${resolveImage(song.cover_image)}" alt="${escapeHtml(song.title)}" class="h-16 w-16 rounded-lg object-cover">
                <div class="flex-1 min-w-0">
                    <h4 class="font-bold text-lg text-white truncate">${escapeHtml(song.title)}</h4>
                    <p class="text-sm text-white/50">${escapeHtml(song.artist?.name ?? 'Unknown Artist')}</p>
                </div>
                <button class="text-[#BD93F9] mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 10a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" /></svg>
                </button>
            </article>
        `;

        const fetchSongs = async (keyword = '', page = 1) => {
            try {
                loadingEl.classList.remove('hidden');
                emptyEl.classList.add('hidden');
                paginationEl.classList.add('hidden');

                const query = new URLSearchParams({
                    per_page: String(songsPerPage),
                    page: String(page),
                });
                if (keyword) {
                    query.set('q', keyword);
                }

                const response = await fetch(`/api/songs?${query.toString()}`);
                if (!response.ok) throw new Error('Failed to fetch songs');

                const payload = await response.json();
                const songs = Array.isArray(payload.data) ? payload.data : [];

                loadingEl.classList.add('hidden');

                if (songs.length === 0) {
                    currentSongs = [];
                    desktopGridEl.innerHTML = '';
                    mobileListEl.innerHTML = '';
                    emptyEl.classList.remove('hidden');
                    emptyEl.textContent = keyword ? 'No songs match your search.' : 'No songs found.';
                    updatePaginationUi({ current_page: 1, last_page: 1, total: 0 });
                    pauseSong();
                    return;
                }

                currentSongs = songs;
                desktopGridEl.innerHTML = currentSongs.map(desktopCard).join('');
                mobileListEl.innerHTML = currentSongs.map(mobileItem).join('');
                updatePaginationUi(payload.pagination);

                setCurrentSong(currentSongs[0], 0);
                pauseSong();
            } catch (error) {
                loadingEl.classList.add('hidden');
                emptyEl.classList.remove('hidden');
                emptyEl.textContent = 'Unable to load songs from API.';
                updatePaginationUi({ current_page: 1, last_page: 1, total: 0 });
            }
        };

        bindStaticInteractions();
        playerAudioEl.volume = 0.65;
        updateVolumeUi();
        await fetchSongs();
    });
</script>
@endsection