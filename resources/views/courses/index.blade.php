@if(auth()->check())
    <x-app-layout>
        <x-slot name="header">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="studio-eyebrow">Library</p>
                    <h2>{{ __('Course Catalog') }}</h2>
                </div>
                @if(auth()->user()->isStudent())
                    <a href="{{ route('student.dashboard') }}" class="studio-outline-button">My learning desk <span aria-hidden="true">→</span></a>
                @endif
            </div>
        </x-slot>

        <div class="py-8 sm:py-12">
            <div class="studio-container">
                @include('courses.partials.catalog')
            </div>
        </div>
    </x-app-layout>
@else
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>{{ config('app.name', 'Ruang Belajar') }}</title>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400..700&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        </head>
        <body class="font-sans antialiased">
            <div class="studio-shell dark:bg-slate-950">
                @include('layouts.navigation')

                <main>
                    <section class="border-b border-[#d8d4c9] bg-[#fffdf8] py-12 sm:py-16 lg:py-20 dark:border-slate-800 dark:bg-slate-900">
                        <div class="studio-container grid items-center gap-12 lg:grid-cols-[minmax(0,1fr)_29rem] lg:gap-16">
                            <div class="max-w-2xl">
                                <p class="studio-eyebrow mb-5">Belajar dengan ritme yang masuk akal</p>
                                <h1 class="max-w-xl text-4xl leading-[1.04] text-[#203331] sm:text-5xl lg:text-[3.65rem] dark:text-white">Bangun keahlian, satu sesi yang bermakna.</h1>
                                <p class="mt-6 max-w-lg text-base leading-7 text-[#5b6660] sm:text-lg dark:text-slate-300">Koleksi kelas praktis dengan materi yang bisa dibaca, dikerjakan, dan dilanjutkan saat kamu siap. Tidak perlu terburu-buru untuk benar-benar paham.</p>
                                <div class="mt-8 flex flex-wrap gap-3">
                                    <a href="{{ route('register') }}" class="studio-button">Mulai belajar <span aria-hidden="true">→</span></a>
                                    <a href="#catalog" class="studio-outline-button">Lihat kelas</a>
                                </div>
                            </div>

                            <aside class="studio-card relative overflow-hidden p-5 sm:p-6 dark:border-slate-700 dark:bg-slate-800" aria-label="Contoh rencana belajar">
                                <div class="absolute right-0 top-0 h-20 w-20 border-b border-l border-[#d8d4c9] bg-[#f5eddd] dark:border-slate-700 dark:bg-slate-700"></div>
                                <div class="relative flex items-start justify-between gap-4 border-b border-[#d8d4c9] pb-5 dark:border-slate-700">
                                    <div>
                                        <p class="studio-eyebrow">Rencana hari ini</p>
                                        <h2 class="mt-1 text-2xl text-[#203331] dark:text-white">Satu jam yang fokus</h2>
                                    </div>
                                    <span class="studio-badge">45 menit</span>
                                </div>
                                <ol class="relative mt-5 space-y-0">
                                    <li class="grid grid-cols-[2rem_1fr_auto] items-center gap-3 border-b border-[#e4e0d5] py-4 dark:border-slate-700">
                                        <span class="grid h-8 w-8 place-items-center rounded-full bg-[#dcebe5] text-xs font-bold text-[#104841]">01</span>
                                        <div><p class="text-sm font-bold text-[#203331] dark:text-white">Baca materi inti</p><p class="mt-0.5 text-xs text-[#68716b] dark:text-slate-400">Konsep &amp; contoh</p></div>
                                        <span class="text-xs font-semibold text-[#68716b] dark:text-slate-400">20m</span>
                                    </li>
                                    <li class="grid grid-cols-[2rem_1fr_auto] items-center gap-3 border-b border-[#e4e0d5] py-4 dark:border-slate-700">
                                        <span class="grid h-8 w-8 place-items-center rounded-full border border-[#cba35f] text-xs font-bold text-[#82571a]">02</span>
                                        <div><p class="text-sm font-bold text-[#203331] dark:text-white">Uji pemahaman</p><p class="mt-0.5 text-xs text-[#68716b] dark:text-slate-400">Kuis singkat</p></div>
                                        <span class="text-xs font-semibold text-[#68716b] dark:text-slate-400">10m</span>
                                    </li>
                                    <li class="grid grid-cols-[2rem_1fr_auto] items-center gap-3 pt-4">
                                        <span class="grid h-8 w-8 place-items-center rounded-full border border-[#d8d4c9] text-xs font-bold text-[#68716b] dark:border-slate-600 dark:text-slate-400">03</span>
                                        <div><p class="text-sm font-bold text-[#203331] dark:text-white">Kerjakan praktik</p><p class="mt-0.5 text-xs text-[#68716b] dark:text-slate-400">Tugas mandiri</p></div>
                                        <span class="text-xs font-semibold text-[#68716b] dark:text-slate-400">15m</span>
                                    </li>
                                </ol>
                            </aside>
                        </div>
                    </section>

                    <section class="border-b border-[#d8d4c9] bg-[#ede8dc] py-5 dark:border-slate-800 dark:bg-slate-900">
                        <div class="studio-container grid gap-4 text-sm sm:grid-cols-2 lg:grid-cols-4">
                            <div class="studio-kpi"><p class="font-bold text-[#203331] dark:text-white">Belajar mandiri</p><p class="mt-0.5 text-xs text-[#68716b] dark:text-slate-400">Lanjut saat waktumu tersedia</p></div>
                            <div class="studio-kpi"><p class="font-bold text-[#203331] dark:text-white">Modul terstruktur</p><p class="mt-0.5 text-xs text-[#68716b] dark:text-slate-400">Materi disusun per langkah</p></div>
                            <div class="studio-kpi"><p class="font-bold text-[#203331] dark:text-white">Kuis &amp; tugas</p><p class="mt-0.5 text-xs text-[#68716b] dark:text-slate-400">Uji pemahaman langsung di kelas</p></div>
                            <div class="studio-kpi"><p class="font-bold text-[#203331] dark:text-white">Sertifikat selesai</p><p class="mt-0.5 text-xs text-[#68716b] dark:text-slate-400">Tersedia setelah progres tuntas</p></div>
                        </div>
                    </section>

                    <section id="catalog" class="py-14 sm:py-20">
                        <div class="studio-container">
                            <div class="mb-8 max-w-2xl sm:mb-10">
                                <p class="studio-eyebrow">Koleksi kelas</p>
                                <h2 class="mt-3 text-3xl text-[#203331] sm:text-4xl dark:text-white">Cari materi yang ingin kamu kuasai.</h2>
                                <p class="mt-3 text-sm leading-6 text-[#68716b] sm:text-base dark:text-slate-400">Telusuri berdasarkan topik atau pilih kategori untuk menyusun jalur belajarmu sendiri.</p>
                            </div>
                            @include('courses.partials.catalog')
                        </div>
                    </section>

                    <section class="border-y border-[#d8d4c9] bg-[#fffdf8] py-14 dark:border-slate-800 dark:bg-slate-900">
                        <div class="studio-container">
                            <div class="flex flex-col gap-3 border-b border-[#d8d4c9] pb-7 sm:flex-row sm:items-end sm:justify-between dark:border-slate-700">
                                <div><p class="studio-eyebrow">Cara belajar</p><h2 class="mt-2 text-3xl text-[#203331] dark:text-white">Buka kelas, atur tempo, selesaikan.</h2></div>
                                <p class="max-w-sm text-sm leading-6 text-[#68716b] dark:text-slate-400">Sebuah alur sederhana supaya perhatianmu tertuju pada materi, bukan antarmuka.</p>
                            </div>
                            <ol class="mt-8 grid gap-8 md:grid-cols-3 md:gap-0">
                                <li class="md:border-r md:border-[#d8d4c9] md:pr-8 dark:md:border-slate-700"><span class="studio-eyebrow">01 / Pilih</span><h3 class="mt-3 text-xl text-[#203331] dark:text-white">Temukan kelas yang relevan</h3><p class="mt-2 text-sm leading-6 text-[#68716b] dark:text-slate-400">Baca ringkasan, struktur materi, dan pengajarnya sebelum mulai.</p></li>
                                <li class="md:border-r md:border-[#d8d4c9] md:px-8 dark:md:border-slate-700"><span class="studio-eyebrow">02 / Pelajari</span><h3 class="mt-3 text-xl text-[#203331] dark:text-white">Ikuti materi per modul</h3><p class="mt-2 text-sm leading-6 text-[#68716b] dark:text-slate-400">Tandai pelajaran yang selesai dan kembali ke titik terakhirmu.</p></li>
                                <li class="md:pl-8"><span class="studio-eyebrow">03 / Buktikan</span><h3 class="mt-3 text-xl text-[#203331] dark:text-white">Kerjakan kuis dan tugas</h3><p class="mt-2 text-sm leading-6 text-[#68716b] dark:text-slate-400">Ukur pemahaman dengan praktik, lalu raih sertifikat saat rampung.</p></li>
                            </ol>
                        </div>
                    </section>
                </main>

                <footer class="py-8 text-sm text-[#68716b] dark:text-slate-400">
                    <div class="studio-container flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between"><p class="font-serif-display text-lg text-[#203331] dark:text-white">Ruang Belajar</p><p>© {{ date('Y') }} · Belajar dengan tenang, tumbuh dengan arah.</p></div>
                </footer>
            </div>
        </body>
    </html>
@endif
