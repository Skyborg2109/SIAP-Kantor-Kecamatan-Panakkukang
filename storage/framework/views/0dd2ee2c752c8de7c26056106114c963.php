<!-- Main Display Wrapper with Dual Sync (WebSockets + 2s Polling Fallback) -->
<div class="min-h-screen bg-slate-100 flex flex-col font-sans select-none" wire:poll.2s="checkQueueUpdate">

    <!-- Header Instansi Resmi (Duo Logo Kota Makassar & Kecamatan Panakkukang) -->
    <header class="bg-slate-900 text-white px-6 py-4 shadow-md flex justify-between items-center border-b-4 border-orange-500">
        <div class="flex items-center gap-4">
            <img src="<?php echo e(asset('logo kota makassar.png')); ?>" alt="Logo Kota Makassar" class="h-14 w-auto object-contain drop-shadow-sm shrink-0" />
            <img src="<?php echo e(asset('logo kecamatan panakkukang.jpg')); ?>" alt="Logo Kecamatan Panakkukang" class="h-14 w-auto object-contain rounded-xl shadow-xs shrink-0" />
            <div class="border-l-2 border-orange-500/40 pl-4">
                <p class="text-xs font-bold text-amber-400 uppercase tracking-widest leading-none">Pemerintah Kota Makassar</p>
                <h1 class="text-2xl font-black tracking-tight leading-tight text-white">KANTOR KECAMATAN PANAKKUKANG</h1>
            </div>
        </div>

        <!-- Live Clock & Date -->
        <div class="text-right" x-data="{ time: '', date: '' }" x-init="
            const updateTime = () => {
                const now = new Date();
                time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
                date = now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
            };
            updateTime();
            setInterval(updateTime, 1000);
        ">
            <div class="text-4xl font-extrabold font-mono tracking-tight text-white drop-shadow-sm" x-text="time">
                <?php echo e(now()->format('H:i:s')); ?>

            </div>
            <div class="text-xs font-semibold text-orange-200 mt-0.5" x-text="date">
                <?php echo e(now()->translatedFormat('l, d F Y')); ?>

            </div>
        </div>
    </header>

    <!-- Content Area -->
    <main class="flex-1 p-6 flex flex-col lg:flex-row gap-6 overflow-hidden">
        
        <!-- Left: Area Video Informasi Pelayanan (tanpa informasi panggilan antrean) -->
        <div class="flex-1 flex flex-col gap-4">
            <section id="video-display" class="flex-1 bg-gradient-to-br from-slate-900 via-slate-850 to-slate-950 rounded-2xl overflow-hidden shadow-md border-2 border-slate-200/15 relative flex flex-col justify-between text-white p-6 sm:p-8" aria-labelledby="video-display-heading">
                <div class="text-center">
                    <p class="text-xs font-bold uppercase tracking-widest text-orange-300">Layar Informasi Pelayanan</p>
                    <h2 id="video-display-heading" class="mt-2 text-2xl sm:text-3xl font-black tracking-tight text-white">Tayangan Video Informasi</h2>
                </div>

                <div class="flex-1 flex items-center justify-center py-4">
                    <div class="w-full max-w-4xl aspect-video rounded-2xl overflow-hidden border border-slate-700 shadow-inner">
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

        <!-- Right: Panggilan KTP dan IKD ditempatkan terpisah dari layar video -->
        <aside class="w-full lg:w-[440px] flex flex-col gap-4" aria-label="Panggilan antrean">
            <div class="flex-1 flex flex-col gap-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $this->serviceStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceStatus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php
                        $isKtp = $serviceStatus['code'] === 'KTP';
                        $isActive = $serviceStatus['is_active'];
                    ?>

                    <section id="queue-call-<?php echo e(strtolower($serviceStatus['code'])); ?>" class="flex-1 bg-white rounded-2xl shadow-md border-t-8 <?php echo e($isKtp ? 'border-orange-600' : 'border-emerald-600'); ?> border-x border-b border-slate-200 px-5 py-5 text-center transition-all duration-300 flex flex-col items-center justify-center" aria-labelledby="queue-call-<?php echo e(strtolower($serviceStatus['code'])); ?>-heading">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider <?php echo e($isKtp ? 'bg-orange-50 text-orange-800 border border-orange-200' : 'bg-emerald-50 text-emerald-800 border border-emerald-200'); ?>">
                            <span class="w-2 h-2 rounded-full <?php echo e($isActive ? ($isKtp ? 'bg-orange-600 animate-pulse' : 'bg-emerald-600 animate-pulse') : 'bg-slate-400'); ?>"></span>
                            <span><?php echo e($isActive ? 'Panggilan Antrean' : 'Panggilan Terakhir'); ?> <?php echo e($serviceStatus['code']); ?></span>
                        </div>

                        <h2 id="queue-call-<?php echo e(strtolower($serviceStatus['code'])); ?>-heading" class="mt-4 text-lg font-black uppercase tracking-wide <?php echo e($isKtp ? 'text-orange-900' : 'text-emerald-900'); ?>">
                            <?php echo e($serviceStatus['name']); ?>

                        </h2>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($serviceStatus['count'] > 1): ?>
                            <div class="grid <?php echo e($serviceStatus['count'] === 2 ? 'grid-cols-2' : 'grid-cols-3'); ?> gap-2 mt-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $serviceStatus['numbers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $number): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <div class="rounded-xl border <?php echo e($isKtp ? 'border-orange-200 bg-orange-50' : 'border-emerald-200 bg-emerald-50'); ?> px-2 py-2.5">
                                        <span class="block text-[10px] font-bold uppercase tracking-widest <?php echo e($isKtp ? 'text-orange-600' : 'text-emerald-600'); ?>">Nomor</span>
                                        <span class="block mt-1 text-2xl font-black font-mono <?php echo e($isKtp ? 'text-orange-950' : 'text-emerald-950'); ?>"><?php echo e($number); ?></span>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        <?php else: ?>
                            <p class="mt-4 text-8xl font-black font-mono tracking-tight <?php echo e($isKtp ? 'text-orange-950' : 'text-emerald-950'); ?>"><?php echo e($serviceStatus['display_number']); ?></p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <div class="mt-4 pt-3 border-t <?php echo e($isKtp ? 'border-orange-100' : 'border-emerald-100'); ?> w-full">
                            <p class="text-xs font-semibold <?php echo e($isActive ? ($isKtp ? 'text-orange-700' : 'text-emerald-700') : 'text-slate-500'); ?>"><?php echo e($isActive ? 'Sedang Dilayani di Ruang Pelayanan' : $serviceStatus['status_label']); ?></p>
                        </div>
                    </section>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="p-6 text-center rounded-2xl border border-slate-200 bg-white text-sm text-slate-500">
                        Layanan antrean KTP dan IKD belum tersedia atau belum aktif.
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </aside>

    </main>

    <!-- Footer / Running Text Marquee -->
    <footer class="bg-slate-900 text-white py-4 px-5 shadow-inner border-t-2 border-orange-500/60">
        <div class="flex items-center">
            <div class="bg-orange-500 text-slate-950 px-4 py-2 rounded-lg font-black text-sm uppercase tracking-wider whitespace-nowrap z-10 shadow-sm">
                PENGUMUMAN
            </div>
            <div class="overflow-hidden w-full relative ml-4">
                <div class="animate-marquee whitespace-nowrap text-base text-slate-100 font-semibold">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($this->announcements->count() > 0): ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ann): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <span class="mx-8">• <?php echo e($ann->content); ?></span>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <?php else: ?>
                        <span class="mx-8">• Pelayanan Kantor Kecamatan Panakkukang buka Senin s.d. Kamis pukul 07.30 - 16.00 WITA, dan di hari Jumat pukul 07.30 - 16.30 WITA</span>
                        <span class="mx-8">• Yang Ingin Mengurus Kartu Tanda Penduduk (KTP) Bisa Langsung Mendatangi Petugas Yang ada di depan Ruang Pelayanan.</span>
                        <span class="mx-8">• Yang Ingin Mengurus Kartu Keluarga Bisa langsung Mendatangi Petugas Yang ada di depan Ruang Pelayanan Tanpa Mengambil Nomor Antrean.</span>
                        <span class="mx-8">• Yang Ingin Membuat atau Mendaftar Akun Aplikasi Identitas Kependudukan Digital (IKD), Harap Mendownload aplikasinya terlebih dahulu di Play Store Atau App Store, Kemudian Mengisi data hingga tahap Scan Barcode.</span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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

        const openingAudioUrl = "<?php echo e(asset('opening sound.mp3')); ?>";
        const closingAudioUrl = "<?php echo e(asset('closing sound.mp3')); ?>";

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
            display: inline-block;
            animation: marquee 100s linear infinite;
        }
        .animate-marquee:hover {
            animation-play-state: paused;
        }
        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
    </style>
</div>
<?php /**PATH C:\laragon\www\SIAP-Kantor-Camat-Panakkukang\resources\views/livewire/public-display.blade.php ENDPATH**/ ?>