<!-- Public Display — locked 100dvh, no scroll, rapih -->
<div class="flex-1 min-h-0 h-full bg-slate-100 flex flex-col font-sans select-none overflow-hidden" wire:poll.2s="checkQueueUpdate" style="height:100%; max-height:100%;">

    <!-- Header — shrink-0, fixed -->
    <header class="shrink-0 bg-slate-900 text-white px-4 lg:px-6 py-3 shadow-md flex justify-between items-center border-b-4 border-orange-500 gap-4">
        <div class="flex items-center gap-3 min-w-0">
            <div class="flex items-center gap-2 shrink-0">
                <img src="{{ asset('logo kota makassar.png') }}" alt="Logo Kota Makassar" class="h-10 lg:h-11 w-auto object-contain drop-shadow-sm shrink-0" />
                <img src="{{ asset('logo kecamatan panakkukang.png') }}" alt="Logo Kecamatan Panakkukang" class="h-10 lg:h-11 w-auto object-contain rounded-lg shadow-sm shrink-0" />
            </div>
            <div class="hidden sm:block border-l-2 border-orange-500/30 pl-3 min-w-0">
                <p class="text-xs font-bold text-amber-400 uppercase tracking-widest leading-none">Pemerintah Kota Makassar</p>
                <h1 class="text-lg lg:text-xl font-black tracking-tight leading-none text-white mt-1 truncate">KANTOR KECAMATAN PANAKKUKANG</h1>
            </div>
            <div class="sm:hidden min-w-0">
                <p class="text-xs font-black leading-none text-white truncate">KANTOR KECAMATAN PANAKKUKANG</p>
            </div>
        </div>

        <!-- Live Clock -->
        <div class="text-right shrink-0" x-data="{ time: '', date: '' }" x-init="
            const updateTime = () => {
                const now = new Date();
                time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
                date = now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
            };
            updateTime();
            setInterval(updateTime, 1000);
        ">
            <div class="text-2xl lg:text-3xl font-black font-mono tracking-tight leading-none text-white tabular-nums" x-text="time">{{ now()->format('H:i:s') }}</div>
            <div class="text-xs font-semibold text-orange-200 leading-none mt-1 truncate" x-text="date">{{ now()->translatedFormat('l, d F Y') }}</div>
        </div>
    </header>

    <!-- Main — flex-1, no scroll -->
    <main class="flex-1 min-h-0 p-3 lg:p-4 flex flex-col lg:flex-row gap-3 lg:gap-4 overflow-hidden bg-slate-100">

        <!-- Left: Video -->
        <div class="flex-1 min-h-0 min-w-0 flex flex-col overflow-hidden">
            <section id="video-display" class="flex-1 min-h-0 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-950 rounded-2xl overflow-hidden shadow-md border border-slate-700/50 flex flex-col text-white p-4 lg:p-5 overflow-hidden" aria-labelledby="video-display-heading">
                <div class="text-center shrink-0">
                    <p class="text-xs font-bold uppercase tracking-widest text-orange-300">Layar Informasi Pelayanan</p>
                    <h2 id="video-display-heading" class="mt-1 text-lg lg:text-xl font-black tracking-tight text-white leading-none">Tayangan Video Informasi</h2>
                </div>

                <div class="flex-1 min-h-0 flex items-center justify-center py-3 overflow-hidden">
                    <div class="w-full max-w-4xl max-h-full aspect-video rounded-xl overflow-hidden border border-slate-700 shadow-inner bg-black shrink">
                        <iframe
                            src="https://www.youtube.com/embed/a2zz1HvpUwQ?autoplay=1&mute=1&loop=1&playlist=a2zz1HvpUwQ&controls=0&showinfo=0&rel=0&modestbranding=1"
                            class="w-full h-full"
                            allow="autoplay; encrypted-media"
                            allowfullscreen
                            title="Video Informasi Pelayanan"
                        ></iframe>
                    </div>
                </div>
            </section>
        </div>

        <!-- Right: Queue Cards -->
        <aside class="w-full lg:w-[380px] xl:w-[420px] shrink-0 flex flex-col gap-3 lg:gap-4 min-h-0 overflow-hidden" aria-label="Panggilan antrean">
            <div class="flex-1 min-h-0 flex flex-col gap-3 lg:gap-4 overflow-hidden">
                @forelse($this->serviceStatuses as $serviceStatus)
                    @php
                        $isKtp = $serviceStatus['code'] === 'KTP';
                        $isActive = $serviceStatus['is_active'];
                    @endphp

                    <section id="queue-call-{{ strtolower($serviceStatus['code']) }}" class="flex-1 min-h-0 bg-white rounded-2xl shadow-md border-t-8 {{ $isKtp ? 'border-orange-600' : 'border-emerald-600' }} border-x border-b border-slate-200 px-4 lg:px-5 py-4 text-center transition-all duration-300 flex flex-col items-center justify-center overflow-hidden" aria-labelledby="queue-call-{{ strtolower($serviceStatus['code']) }}-heading">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $isKtp ? 'bg-orange-50 text-orange-800 border border-orange-200' : 'bg-emerald-50 text-emerald-800 border border-emerald-200' }}">
                            <span class="w-2 h-2 rounded-full {{ $isActive ? ($isKtp ? 'bg-orange-600 animate-pulse' : 'bg-emerald-600 animate-pulse') : 'bg-slate-400' }}"></span>
                            <span>{{ $isActive ? 'Panggilan Antrean' : 'Panggilan Terakhir' }} {{ $serviceStatus['code'] }}</span>
                        </div>

                        <h2 id="queue-call-{{ strtolower($serviceStatus['code']) }}-heading" class="mt-4 text-lg font-black uppercase tracking-wide {{ $isKtp ? 'text-orange-900' : 'text-emerald-900' }}">
                            {{ $serviceStatus['name'] }}
                        </h2>

                        @if($serviceStatus['count'] > 1)
                            <div class="grid {{ $serviceStatus['count'] === 2 ? 'grid-cols-2' : 'grid-cols-3' }} gap-2 mt-3 w-full">
                                @foreach($serviceStatus['numbers'] as $number)
                                    <div class="rounded-xl border {{ $isKtp ? 'border-orange-200 bg-orange-50' : 'border-emerald-200 bg-emerald-50' }} px-2 py-2">
                                        <span class="block text-[10px] font-bold uppercase tracking-widest {{ $isKtp ? 'text-orange-600' : 'text-emerald-600' }}">Nomor</span>
                                        <span class="block mt-1 text-xl lg:text-2xl font-black font-mono leading-none {{ $isKtp ? 'text-orange-950' : 'text-emerald-950' }}">{{ $number }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="mt-3 font-black font-mono tracking-tight leading-none {{ $isKtp ? 'text-orange-950' : 'text-emerald-950' }}" style="font-size: clamp(2.5rem, 6vh, 4.2rem);">{{ $serviceStatus['display_number'] }}</p>
                        @endif

                        <div class="mt-3 pt-3 border-t {{ $isKtp ? 'border-orange-100' : 'border-emerald-100' }} w-full shrink-0">
                            <p class="text-xs font-semibold leading-none {{ $isActive ? ($isKtp ? 'text-orange-700' : 'text-emerald-700') : 'text-slate-500' }}">{{ $isActive ? 'Sedang Dilayani di Ruang Pelayanan' : $serviceStatus['status_label'] }}</p>
                        </div>
                    </section>
                @empty
                    <div class="p-6 text-center rounded-2xl border border-slate-200 bg-white text-sm text-slate-500">
                        Layanan antrean KTP dan IKD belum tersedia atau belum aktif.
                    </div>
                @endforelse
            </div>
        </aside>

    </main>

    <!-- Footer — shrink-0, no scroll — pengumuman looping seamless tanpa jeda -->
    <footer class="shrink-0 bg-slate-900 text-white py-3 px-4 shadow-inner border-t-2 border-orange-500/60 overflow-hidden">
        <div class="flex items-center gap-0">
            <div class="bg-orange-500 text-slate-950 px-4 py-2 rounded-lg font-black text-sm uppercase tracking-wider whitespace-nowrap z-10 shadow-sm shrink-0">
                PENGUMUMAN
            </div>
            <div class="flex-1 min-w-0 overflow-hidden relative ml-4">
                @php
                    $fallbackAnnouncements = [
                        'Pelayanan Kantor Kecamatan Panakkukang buka Senin s.d. Kamis pukul 07.30 - 16.00 WITA, dan di hari Jumat pukul 07.30 - 16.30 WITA',
                        'Yang Ingin Mengurus Kartu Tanda Penduduk (KTP) Bisa Langsung Mendatangi Petugas Yang ada di depan Ruang Pelayanan.',
                        'Yang Ingin Mengurus Kartu Keluarga Bisa langsung Mendatangi Petugas Yang ada di depan Ruang Pelayanan Tanpa Mengambil Nomor Antrean.',
                        'Yang Ingin Membuat atau Mendaftar Akun Aplikasi Identitas Kependudukan Digital (IKD), Harap Mendownload aplikasinya terlebih dahulu di Play Store Atau App Store, Kemudian Mengisi data hingga tahap Scan Barcode.',
                    ];
                @endphp
                <div class="animate-marquee flex w-max items-center text-base text-slate-100 font-semibold whitespace-nowrap will-change-transform">
                    @for($repeat = 0; $repeat < 4; $repeat++)
                        <div class="flex shrink-0 items-center" @if($repeat > 0) aria-hidden="true" @endif>
                            @if($this->announcements->count() > 0)
                                @foreach($this->announcements as $ann)
                                    <span class="mx-8">• {{ $ann->content }}</span>
                                @endforeach
                            @else
                                @foreach($fallbackAnnouncements as $text)
                                    <span class="mx-8">• {{ $text }}</span>
                                @endforeach
                            @endif
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating Audio Unlock Notification (Bila browser memblokir autoplay audio otomatis) -->
    <div id="audio-banner" class="hidden fixed bottom-14 right-6 z-50 bg-blue-900/95 text-white text-xs px-4 py-2.5 rounded-xl shadow-xl backdrop-blur-sm border border-amber-400/50 flex items-center gap-2.5 cursor-pointer hover:bg-blue-800 transition">
        <span class="text-base animate-bounce">🔔</span>
        <div>
            <p class="font-bold text-amber-300">Suara Bel & Panggilan Siap</p>
            <p class="text-[11px] text-blue-200">Klik di sini untuk mengaktifkan audio otomatis</p>
        </div>
    </div>

    <!-- Audio & TTS Announcement Script (Opening Sound MP3 + Suara Wanita Profesional + Closing Sound MP3) -->
    <script>
        let isAudioUnlocked = false;
        window._activeUtterance = null;

        const openingAudioUrl = "{{ asset('opening sound.mp3') }}";
        const closingAudioUrl = "{{ asset('closing sound.mp3') }}";

        // Fungsi pemutar file audio MP3 yang menunggu hingga file benar-benar selesai diputar
        function playAudioFile(url) {
            return new Promise((resolve) => {
                try {
                    const audio = new Audio(url);
                    audio.currentTime = 0;

                    let hasResolved = false;
                    const done = () => {
                        if (!hasResolved) {
                            hasResolved = true;
                            resolve();
                        }
                    };

                    audio.addEventListener('ended', done, { once: true });
                    audio.addEventListener('error', (e) => {
                        console.warn('Gagal memuat file audio:', url, e);
                        done();
                    }, { once: true });

                    const playPromise = audio.play();
                    if (playPromise !== undefined) {
                        playPromise.catch((err) => {
                            console.warn('Autoplay audio tertunda:', err);
                            const banner = document.getElementById('audio-banner');
                            if (banner) banner.classList.remove('hidden');
                            done();
                        });
                    }
                } catch (err) {
                    console.warn('Audio exception:', err);
                    resolve();
                }
            });
        }

        // Pencarian Suara Wanita Profesional Bahasa Indonesia
        function getProfessionalFemaleVoice() {
            if (!('speechSynthesis' in window)) return null;
            const voices = window.speechSynthesis.getVoices();
            if (!voices || voices.length === 0) return null;

            const idVoices = voices.filter(v => v.lang.startsWith('id') || v.lang.includes('ID'));
            const femaleKeywords = ['gadis', 'ayu', 'damayanti', 'female', 'wanita', 'natural', 'google bahasa indonesia'];

            for (const keyword of femaleKeywords) {
                const match = idVoices.find(v => v.name.toLowerCase().includes(keyword));
                if (match) return match;
            }

            if (idVoices.length > 0) return idVoices[0];

            return null;
        }

        if ('speechSynthesis' in window) {
            window.speechSynthesis.onvoiceschanged = () => {
                getProfessionalFemaleVoice();
            };
        }

        // Fungsi pembacaan 1 kalimat pemanggilan dengan proteksi anti-cut / anti-garbage-collection Chrome
        function speakSingleSentence(text) {
            return new Promise((resolve) => {
                if (!('speechSynthesis' in window)) {
                    resolve();
                    return;
                }

                try {
                    window.speechSynthesis.cancel();

                    const utterance = new SpeechSynthesisUtterance(text);
                    utterance.lang = 'id-ID';

                    const femaleVoice = getProfessionalFemaleVoice();
                    if (femaleVoice) {
                        utterance.voice = femaleVoice;
                    }

                    utterance.rate = 0.90;  // Kecepatan stabil pengumuman publik
                    utterance.pitch = 1.05; // Nada wanita bersih

                    // Simpan di window agar tidak terkena garbage collection browser
                    window._activeUtterance = utterance;

                    let hasResolved = false;
                    let checkInterval = null;
                    let resumeInterval = null;

                    const cleanupAndDone = () => {
                        if (!hasResolved) {
                            hasResolved = true;
                            if (checkInterval) clearInterval(checkInterval);
                            if (resumeInterval) clearInterval(resumeInterval);
                            window._activeUtterance = null;
                            resolve();
                        }
                    };

                    utterance.onend = () => {
                        // Pastikan engine benar-benar selesai sebelum resolve
                        setTimeout(() => {
                            if (!window.speechSynthesis.speaking) {
                                cleanupAndDone();
                            }
                        }, 100);
                    };

                    utterance.onerror = (e) => {
                        console.warn('TTS voice error:', e);
                        cleanupAndDone();
                    };

                    window.speechSynthesis.speak(utterance);

                    // Pengawas jika Chrome bug pause di tengah pembacaan
                    resumeInterval = setInterval(() => {
                        if (!hasResolved && window.speechSynthesis.speaking) {
                            window.speechSynthesis.pause();
                            window.speechSynthesis.resume();
                        }
                    }, 4000);

                    // Fallback polling jika onend event tidak terpanggil oleh browser
                    checkInterval = setInterval(() => {
                        if (!window.speechSynthesis.speaking && !window.speechSynthesis.pending) {
                            cleanupAndDone();
                        }
                    }, 300);

                } catch (e) {
                    console.warn('Speech exception:', e);
                    resolve();
                }
            });
        }

        // Unlock audio listener
        function unlockAudio() {
            if (isAudioUnlocked) return;
            isAudioUnlocked = true;

            const banner = document.getElementById('audio-banner');
            if (banner) banner.classList.add('hidden');
        }
        document.addEventListener('click', unlockAudio);
        document.addEventListener('keydown', unlockAudio);

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('play-tts', async (event) => {
                let data = event?.queue ?? (event?.[0]?.queue ?? event);
                if (!data) return;
                
                // Visual flash hanya pada panel panggilan layanan yang dipanggil.
                const calledQueue = data.queue ?? data;
                const serviceCode = calledQueue?.service?.code?.toLowerCase();
                const callBox = serviceCode ? document.getElementById(`queue-call-${serviceCode}`) : null;
                if (callBox) {
                    callBox.classList.add('ring-4', 'ring-blue-500', 'bg-blue-50', 'scale-[1.02]');
                    setTimeout(() => {
                        callBox.classList.remove('ring-4', 'ring-blue-500', 'bg-blue-50', 'scale-[1.02]');
                    }, 2000);
                }

                // Ekstraksi nomor-nomor antrean
                let numbers = [];
                if (data.numbers && Array.isArray(data.numbers) && data.numbers.length > 0) {
                    numbers = data.numbers;
                } else if (data.queue && data.queue.number) {
                    numbers = [data.queue.number];
                } else if (data.number) {
                    numbers = [data.number];
                }

                if (numbers.length === 0) return;

                // Urutkan nomor dari yang terkecil ke terbesar secara alami (natural sort)
                numbers.sort((a, b) => a.localeCompare(b, undefined, { numeric: true, sensitivity: 'base' }));

                // Bersihkan tanda strip agar dibaca wajar oleh mesin TTS (contoh: KTP 011)
                let spokenList = numbers.map(num => num.replace(/-/g, ' '));

                // Susun kalimat pemanggilan:
                let numberPhrase = '';
                if (spokenList.length === 1) {
                    numberPhrase = spokenList[0];
                } else if (spokenList.length === 2) {
                    numberPhrase = `${spokenList[0]} dan ${spokenList[1]}`;
                } else {
                    numberPhrase = spokenList.join(', ');
                }

                let singleSentence = `Nomor antrean ${numberPhrase}, silakan masuk ke ruang pelayanan.`;

                // 1. Putar Suara Pembuka (Opening Sound MP3) & Tunggu sampai selesai
                await playAudioFile(openingAudioUrl);

                // Jeda 250ms setelah denting pembuka
                await new Promise(r => setTimeout(r, 250));

                // 2. Pemanggilan Suara Wanita Pertama (1x) & Tunggu sampai selesai
                await speakSingleSentence(singleSentence);

                // Jeda bernafas alami 400ms sebelum pengulangan
                await new Promise(r => setTimeout(r, 400));

                // 3. Pemanggilan Suara Wanita Kedua / Pengulangan (2x) & Tunggu sampai selesai
                await speakSingleSentence(singleSentence);

                // Jeda 300ms setelah suara wanita selesai bicara seluruhnya
                await new Promise(r => setTimeout(r, 300));

                // 4. Putar Suara Penutup (Closing Sound MP3) sebagai penutup akhir
                await playAudioFile(closingAudioUrl);
            });
        });
    </script>

    <style>
        .animate-marquee {
            display: flex;
            width: max-content;
            animation: marquee 140s linear infinite;
        }
        .animate-marquee:hover {
            animation-play-state: paused;
        }
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
    </style>
</div>
