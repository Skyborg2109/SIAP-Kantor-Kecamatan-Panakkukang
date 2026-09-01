<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'SIAP Panakkukang')); ?> - Portal Pelayanan Terpadu</title>

        <!-- Google Fonts: Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts & Styles -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="font-sans antialiased h-full bg-slate-100 text-slate-800 flex flex-col justify-between min-h-screen">
        
        <!-- Top Institutional Header -->
        <header class="w-full bg-white border-b-4 border-orange-500 py-3.5 px-4 sm:px-6 shadow-xs">
            <div class="max-w-6xl mx-auto flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="<?php echo e(asset('logo kota makassar.png')); ?>" alt="Logo Kota Makassar" class="h-10 w-auto object-contain drop-shadow-2xs" />
                    <img src="<?php echo e(asset('logo kecamatan panakkukang.jpg')); ?>" alt="Logo Kecamatan Panakkukang" class="h-10 w-auto object-contain rounded-lg shadow-2xs" />
                    <div class="border-l-2 border-slate-200 pl-3">
                        <p class="text-[10px] font-bold text-orange-600 uppercase tracking-widest leading-none">Pemerintah Kota Makassar</p>
                        <h1 class="text-sm sm:text-base font-black text-slate-900 leading-tight">Kantor Kecamatan Panakkukang</h1>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="<?php echo e(route('public.display')); ?>" target="_blank" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl border border-orange-200 bg-orange-50 hover:bg-orange-100/80 text-xs font-bold text-orange-800 transition shadow-2xs">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Monitor Antrean</span>
                        <svg class="w-3.5 h-3.5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Authentication Section -->
        <main class="flex-1 flex items-center justify-center p-4 sm:p-6 my-4">
            <div class="w-full max-w-md">
                
                <!-- System Title Box -->
                <div class="text-center mb-6">
                    <div class="inline-flex items-center justify-center gap-2.5 p-3 rounded-2xl bg-white border-2 border-orange-200 shadow-sm mb-3">
                        <img src="<?php echo e(asset('logo kota makassar.png')); ?>" alt="Logo Kota Makassar" class="h-12 w-auto object-contain" />
                        <div class="w-px h-10 bg-slate-200"></div>
                        <img src="<?php echo e(asset('logo kecamatan panakkukang.jpg')); ?>" alt="Logo Kecamatan Panakkukang" class="h-12 w-auto object-contain rounded-lg" />
                    </div>
                    <h2 class="text-2xl font-black text-slate-900 tracking-tight">SIAP PANAKKUKANG</h2>
                    <p class="text-xs font-medium text-slate-500 mt-0.5">Sistem Informasi Antrian & Informasi Pelayanan</p>
                </div>

                <!-- Form Card -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-md p-6 sm:p-8">
                    <?php echo e($slot); ?>

                </div>

                <!-- Security & Role Disclaimer -->
                <div class="mt-4 p-3.5 rounded-xl bg-orange-50/80 border border-orange-200 text-orange-950 text-xs flex items-start gap-2.5">
                    <svg class="w-4 h-4 text-orange-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="leading-relaxed text-slate-700">
                        Akses khusus petugas dan staf ruang pelayanan. Pendaftaran akun petugas baru dikelola langsung oleh <strong>Administrator</strong> melalui panel admin.
                    </p>
                </div>

            </div>
        </main>

        <!-- Official Institutional Footer -->
        <footer class="w-full py-4 bg-white border-t border-slate-200 text-center text-xs text-slate-500 px-4">
            <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-1.5">
                <p>&copy; <?php echo e(date('Y')); ?> Kantor Kecamatan Panakkukang, Kota Makassar.</p>
                <p class="text-[11px] text-slate-400">Jl. Batua Raya No. 1, Panakkukang, Makassar, Sulawesi Selatan</p>
            </div>
        </footer>

    </body>
</html>
<?php /**PATH C:\laragon\www\SIAP-Kantor-Camat-Panakkukang\resources\views/layouts/guest.blade.php ENDPATH**/ ?>