@extends('layouts.app')

@section('title', 'Sivi AI City Companion')

@section('content')
@php
    $featureStyles = [
        'cyan' => ['wrapper' => 'bg-cyan-100 text-cyan-600', 'label' => 'text-cyan-600'],
        'emerald' => ['wrapper' => 'bg-emerald-100 text-emerald-600', 'label' => 'text-emerald-600'],
        'teal' => ['wrapper' => 'bg-teal-100 text-teal-600', 'label' => 'text-teal-600'],
        'blue' => ['wrapper' => 'bg-blue-100 text-blue-600', 'label' => 'text-blue-600'],
        'violet' => ['wrapper' => 'bg-violet-100 text-violet-600', 'label' => 'text-violet-600'],
        'rose' => ['wrapper' => 'bg-rose-100 text-rose-600', 'label' => 'text-rose-600'],
    ];

    $previewCards = [];
    foreach ($previewDestinations as $destination) {
        $previewCards[$destination['slug']] = [
            'name' => $destination['name'],
            'desc' => $destination['preview_copy'],
            'streetViewUrl' => $destination['street_view_url'],
            'crowd' => $destination['crowd'],
            'area' => $destination['area'],
            'rating' => $destination['rating'],
            'best_time' => $destination['best_time'],
            'price' => $destination['price'],
        ];
    }

    $firstPreview = $previewDestinations->first();
    $firstPreviewPrice = $firstPreview['price'] ?? 0;
@endphp

<section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-cyan-950 to-emerald-950 pt-28 pb-20 text-white md:pt-32">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(34,211,238,0.18),transparent_28%),radial-gradient(circle_at_top_right,rgba(10,185,129,0.18),transparent_28%)]"></div>
    <div class="absolute left-8 top-10 h-64 w-64 rounded-full bg-cyan-400/20 blur-3xl"></div>
    <div class="absolute right-10 top-24 h-72 w-72 rounded-full bg-emerald-400/20 blur-3xl"></div>

    <div class="relative mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 flex flex-col items-center text-center">
        <div class="space-y-8 flex flex-col items-center w-full">
            <div class="inline-flex items-center gap-2 rounded-full border border-cyan-500/30 bg-cyan-500/10 px-4 py-2 backdrop-blur-sm">
            </div>

            <div class="space-y-5">
                <h1 class="text-5xl font-semibold tracking-tight leading-tight text-white sm:text-6xl lg:text-7xl mx-auto max-w-4xl">
                    Jelajahi destinasi
                    <span class="block bg-gradient-to-r from-cyan-400 via-emerald-400 to-blue-400 bg-clip-text text-transparent">
                        dari satu alur yang rapi
                    </span>
                </h1>                        <p class="mx-auto max-w-2xl text-lg leading-relaxed text-slate-300 sm:text-xl">
                    Experience dynamic itineraries, real-time crowd avoidance, and immersive VR previews seamlessly integrated with public services.
                </p>
            </div>

            <div class="flex flex-col gap-4 sm:flex-row justify-center">
                <a href="{{ url('/destinations') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-cyan-500 px-8 py-3 font-bold text-white shadow-lg shadow-cyan-500/40 transition-transform hover:-translate-y-0.5">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    Jelajahi Destinasi
                </a>
                <a href="#preview-360" class="inline-flex items-center justify-center gap-2 rounded-full border border-cyan-400 px-8 py-3 font-bold text-cyan-300 transition-colors hover:bg-cyan-500/10">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                    </svg>
                    Preview 360 di Home
                </a>
            </div>

            <div class="grid gap-4 pt-6 sm:grid-cols-2 xl:grid-cols-4 lg:pt-8 w-full max-w-4xl mx-auto">
                <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
                    <div class="text-3xl font-black text-cyan-400">{{ number_format($pageStats['destinations'] ?? 0) }}</div>
                    <p class="text-sm text-slate-400">Destinasi aktif</p>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
                    <div class="text-3xl font-black text-violet-400">100k</div>
                    <p class="text-sm text-slate-400">Pengunjung</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="features" class="py-24 px-4 sm:px-6 lg:px-8 bg-slate-50">
    <div class="mx-auto max-w-7xl">

        <!-- HEADER -->
        <div class="mb-16 space-y-4">
            <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2">
                <svg class="h-4 w-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M3 7h18M3 12h18M3 17h18"/>
                </svg>
                <span class="text-xs font-semibold uppercase tracking-widest text-slate-500">
                    Platform Features
                </span>
            </div>

            <div class="max-w-2xl">
                <h2 class="mb-4 text-3xl font-bold leading-tight text-slate-900 sm:text-4xl">
                    A tourism assistant that thinks like a city command center.
                </h2>
                <p class="text-base leading-relaxed text-slate-600">
                    Semua fitur dirancang untuk memberikan pengalaman yang konsisten, efisien, dan seamless dalam satu platform.
                </p>
            </div>
        </div>

        <!-- GRID -->
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">

            <!-- CARD -->
            <!-- 1 -->
            <a href="{{ url('/personalization') }}"
   class="block">
                <article class="group flex flex-col rounded-2xl border border-slate-200 bg-gradient-to-br from-white to-slate-50 p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-md hover:border-cyan-300">

                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-emerald-400 to-cyan-400 text-white shadow-sm transition group-hover:scale-105">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path d="M9.75 3a3 3 0 00-3 3v.75a3 3 0 00-1.5 2.6v.3a3 3 0 001.5 2.6V13.5a3 3 0 003 3h.5a3 3 0 003 3h.5a3 3 0 003-3v-6a6 6 0 00-6-6h-1.5z"/>
                        </svg>
                    </div>

                    <h3 class="text-lg font-semibold text-slate-900">
                        Contextual AI Assistant
                    </h3>

                    <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                        Memberikan rekomendasi destinasi secara real-time berdasarkan preferensi dan konteks pengguna.
                    </p>

                </article>
            </a>

            <!-- 2 -->
            <a href="#preview-360" class="block">
                <article class="group flex flex-col rounded-2xl border border-slate-200 bg-gradient-to-br from-white to-slate-50 p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-md hover:border-cyan-300">
                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-emerald-400 to-cyan-400 text-white shadow-sm transition group-hover:scale-105">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path d="M17 20a4 4 0 00-8 0M12 12a4 4 0 100-8 4 4 0 000 8z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900">Proactive Crowd Optimizer</h3>
                    <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                        Mengelola kepadatan pengunjung secara proaktif untuk menciptakan pengalaman yang lebih nyaman.
                    </p>
                </article>
            </a>

            <!-- 3 -->
            <a href="#preview-360" class="block">
                <article class="group flex flex-col rounded-2xl border border-slate-200 bg-gradient-to-br from-white to-slate-50 p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-md hover:border-cyan-300">
                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-emerald-400 to-cyan-400 text-white shadow-sm transition group-hover:scale-105">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path d="M2 12s4-6 10-6 10 6 10 6-4 6-10 6-10-6-10-6z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900">Immersive Real-Time Preview</h3>
                    <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                        Menampilkan preview destinasi secara real-time untuk membantu pengguna sebelum berkunjung.
                    </p>
                </article>
            </a>

            <!-- 4 -->
            <a href="#preview-360" class="block">
                <article class="group flex flex-col rounded-2xl border border-slate-200 bg-gradient-to-br from-white to-slate-50 p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-md hover:border-cyan-300">
                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-emerald-400 to-cyan-400 text-white shadow-sm transition group-hover:scale-105">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2"/>
                            <path d="M8 2v4M16 2v4M3 10h18"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900">Smart Booking & Dynamic Pricing</h3>
                    <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                        Sistem booking pintar dengan penyesuaian harga dinamis berdasarkan kondisi dan permintaan.
                    </p>
                </article>
            </a>

            <!-- 5 -->
            <a href="#preview-360" class="block">
                <article class="group flex flex-col rounded-2xl border border-slate-200 bg-gradient-to-br from-white to-slate-50 p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-md hover:border-cyan-300">
                    <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-emerald-400 to-cyan-400 text-white shadow-sm transition group-hover:scale-105">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <rect x="2" y="5" width="20" height="14" rx="2"/>
                            <path d="M2 10h20"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900">Unified Payment & Access</h3>
                    <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                        Integrasi pembayaran dan akses dalam satu sistem untuk pengalaman yang lebih praktis.
                    </p>
                </article>
            </a>

        </div>

    </div>
</section>

<section class="relative py-20 px-4 sm:px-6 lg:px-8 overflow-hidden">

    {{-- Background Gradient --}}
    <div class="absolute inset-0 bg-gradient-to-br from-slate-50 via-cyan-50 to-emerald-50"></div>
    <div class="absolute -top-40 left-1/2 h-[500px] w-[500px] -translate-x-1/2 rounded-full bg-cyan-300/20 blur-3xl"></div>
    <div class="absolute bottom-[-200px] right-[-100px] h-[400px] w-[400px] rounded-full bg-emerald-300/20 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl">

        {{-- Header --}}
        <div class="mb-12 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">

            <div class="max-w-3xl space-y-4">
                <p class="inline-flex items-center rounded-full bg-white/60 px-4 py-1 text-xs font-black uppercase tracking-[0.24em] text-cyan-700 backdrop-blur">
                    Destinasi unggulan
                </p>

                <h2 class="text-4xl font-black leading-tight text-slate-900 sm:text-5xl">
                    Destinasi Favorit para wisatawan
                </h2>

                <p class="text-base leading-7 text-slate-600">
                    Destinasi paling banyak dikunjungi dan selalu ramai
                </p>
            </div>

           

        </div>

        {{-- Grid --}}
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">

            @foreach ($featuredDestinations as $destination)
                <article
                    class="group relative overflow-hidden rounded-3xl border border-white/40 bg-white/70 shadow-[0_20px_60px_rgba(15,23,42,0.08)] backdrop-blur-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_30px_90px_rgba(15,23,42,0.12)]">

                    {{-- Image --}}
                    <div class="relative h-60 overflow-hidden">
                        <img src="{{ $destination['image_url'] }}"
                             alt="{{ $destination['name'] }}"
                             class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                             loading="lazy">

                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/20 to-transparent"></div>

                        {{-- Badge --}}
                        <div class="absolute bottom-4 left-4 right-4 flex items-end justify-between">
                            <div>
                                <p class="text-[11px] font-black uppercase tracking-[0.2em] text-cyan-200">
                                    {{ $destination['category'] }}
                                </p>
                                <h3 class="mt-1 text-lg font-black text-white">
                                    {{ $destination['name'] }}
                                </h3>
                            </div>

                            <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-black text-white backdrop-blur ring-1 ring-white/20">
                                ★ {{ $destination['rating'] }}
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="space-y-4 p-5">

                        <p class="text-sm leading-6 text-slate-600">
                            {{ $destination['preview_copy'] }}
                        </p>

                        <div class="flex items-center justify-between text-sm font-semibold text-slate-500">
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs">
                                {{ $destination['area'] }}
                            </span>

                            <span class="font-black text-slate-800">
                                {{ $destination['price'] > 0 ? 'Rp ' . number_format($destination['price'], 0, ',', '.') : 'Gratis' }}
                            </span>
                        </div>

                        <a href="{{ url('/destinations/' . $destination['id']) }}"
                           class="inline-flex items-center gap-2 text-sm font-black text-cyan-700 transition-all hover:gap-3 hover:text-cyan-800">

                            Lihat detail
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                    </div>
                </article>
            @endforeach

        </div>
    </div>
</section>
<section id="preview-360" class="bg-gradient-to-br from-slate-50 to-cyan-50 px-4 py-24 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <div class="mb-12 space-y-4 text-center">
           
            <h2 class="text-4xl font-black text-slate-900 sm:text-5xl">Lihat lokasi, cek kepadatan, lalu pesan tiket dalam satu alur.</h2>
            <p class="mx-auto max-w-2xl text-lg text-slate-600">
                Wisatawan bisa memilih destinasi Jakarta, melihat peta interaktif, membuka Google Maps, memilih paket tiket, lalu mendapatkan konfirmasi booking demo tanpa pembayaran asli.
            </p>
        </div>

        <div class="mb-8 rounded-2xl border border-cyan-200 bg-white px-4 py-3 text-sm font-semibold text-slate-600 shadow-sm">
            Preview ini memakai data destinasi yang sama dengan dashboard, sehingga home tetap selaras dengan halaman detail.
        </div>

        <div class="grid gap-4 md:gap-8 grid-cols-12">
            <!-- Destination List di atas dengan full width -->
            <div class="col-span-12">
                <div class="space-y-3">
                    @foreach ($previewDestinations as $destination)
                        <button onclick="updatePreview('{{ $destination['slug'] }}', this)" data-dest="{{ $destination['slug'] }}" class="destination-preview-card group w-full rounded-2xl border-2 border-transparent bg-white p-4 text-left shadow-sm transition-all duration-300 hover:border-cyan-400 hover:shadow-md {{ $loop->first ? 'active border-cyan-500 shadow-md' : '' }} flex items-center justify-between">
                            <div>
                                <h3 class="font-bold text-slate-900 text-lg">{{ $destination['name'] }}</h3>
                                <div class="mt-1 flex items-center gap-2">
                                    <span class="text-sm font-semibold text-slate-500">{{ $destination['area'] }}</span>
                                    <span class="flex items-center gap-1 text-xs font-bold text-yellow-500 bg-yellow-50 px-2 py-0.5 rounded-md">
                                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        {{ $destination['rating'] }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-slate-50 text-slate-400 transition-colors group-hover:bg-cyan-50 group-hover:text-cyan-600">
                                <svg class="h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Preview Street View di kiri -->
            <div class="col-span-12 md:col-span-6">
                <div class="overflow-hidden rounded-[1.5rem] border border-slate-200 shadow-sm h-full">
                    <iframe id="preview-street-view" width="100%" height="400" style="border:none;" src="{{ isset($firstPreview['street_view_url']) ? $firstPreview['street_view_url'] . '&output=svembed' : '' }}" title="Street View 360" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <!-- Selected Destination di kanan -->
            <div class="col-span-12 md:col-span-6">
                <div class="rounded-[2rem] bg-white p-6 shadow-lg overflow-hidden h-full flex flex-col">
                    <div class="mb-6">
                        <h3 class="mb-2 text-xs font-bold uppercase tracking-widest text-slate-500">Selected destination</h3>
                        <h2 id="preview-dest-name" class="text-3xl md:text-4xl font-black text-slate-900">{{ $firstPreview['name'] ?? 'Preview 360' }}</h2>
                        <p id="preview-dest-desc" class="mt-2 leading-relaxed text-slate-600">{{ $firstPreview['preview_copy'] ?? '' }}</p>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-2 mb-6">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-semibold text-slate-600">
                            Crowd: <span id="preview-crowd" class="font-black text-slate-900">{{ $firstPreview['crowd'] ?? 0 }}%</span>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-semibold text-slate-600">
                            Area: <span id="preview-area" class="font-black text-slate-900">{{ $firstPreview['area'] ?? '' }}</span>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-semibold text-slate-600">
                            Best time: <span id="preview-best-time" class="font-black text-slate-900">{{ $firstPreview['best_time'] ?? '' }}</span>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm font-semibold text-slate-600">
                            Price: <span id="preview-price" class="font-black text-slate-900">{{ $firstPreviewPrice > 0 ? 'Rp ' . number_format($firstPreviewPrice, 0, ',', '.') : 'Gratis' }}</span>
                        </div>
                    </div>

                    <div class="mt-auto flex flex-col gap-3">
                       
                        <a href="{{ url('/destinations/' . ($firstPreview['id'] ?? 1)) }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-slate-900 px-5 py-3 text-sm font-black text-white transition-colors hover:bg-slate-800">
                            Lihat destinasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="manfaat" class="bg-gradient-to-b from-slate-50 to-white px-4 py-24 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <div class="mb-20 space-y-4 text-center">
            
            <h2 class="text-4xl font-black text-slate-900 sm:text-5xl">Mulai Liburanmu Dalam 4 Langkah</h2>
            <p class="mx-auto max-w-2xl text-lg text-slate-500">
                4 langkah mudah mencari wisata yang sesuai dengan moodmu!
            </p>
        </div>

        <div class="grid gap-8 md:grid-cols-2 xl:grid-cols-4 relative">
            <!-- Connecting line for desktop -->
            <div class="hidden xl:block absolute top-12 left-[12%] right-[12%] h-0.5 bg-gradient-to-r from-cyan-100 via-emerald-100 to-cyan-100 z-0"></div>

            <article class="relative z-10 rounded-[2rem] border border-slate-100 bg-white p-8 shadow-[0_20px_50px_rgba(15,23,42,0.04)] transition-all hover:-translate-y-2 hover:shadow-[0_30px_60px_rgba(15,23,42,0.08)]">
                <div class="mb-6 mx-auto flex h-16 w-16 items-center justify-center rounded-[1.25rem] bg-gradient-to-br from-cyan-400 to-blue-500 text-2xl font-black text-white shadow-lg shadow-cyan-500/30">1</div>
                <h3 class="mb-3 text-center text-xl font-black text-slate-900">Pilih Destinasi</h3>
                <p class="text-center text-sm leading-relaxed text-slate-500">Daftar Destinasi unggulan dan seru yang sesuai dengan kondisi cuaca dan mood!.</p>
            </article>

            <article class="relative z-10 rounded-[2rem] border border-slate-100 bg-white p-8 shadow-[0_20px_50px_rgba(15,23,42,0.04)] transition-all hover:-translate-y-2 hover:shadow-[0_30px_60px_rgba(15,23,42,0.08)]">
                <div class="mb-6 mx-auto flex h-16 w-16 items-center justify-center rounded-[1.25rem] bg-gradient-to-br from-emerald-400 to-teal-500 text-2xl font-black text-white shadow-lg shadow-emerald-500/30">2</div>
                <h3 class="mb-3 text-center text-xl font-black text-slate-900">Lihat Preview Destinasi</h3>
                <p class="text-center text-sm leading-relaxed text-slate-500">Lihat kondisi lokasi Realtime, termasuk keadaan cuaca dan tingkat keramaian</p>
            </article>

            <article class="relative z-10 rounded-[2rem] border border-slate-100 bg-white p-8 shadow-[0_20px_50px_rgba(15,23,42,0.04)] transition-all hover:-translate-y-2 hover:shadow-[0_30px_60px_rgba(15,23,42,0.08)]">
                <div class="mb-6 mx-auto flex h-16 w-16 items-center justify-center rounded-[1.25rem] bg-gradient-to-br from-blue-400 to-indigo-500 text-2xl font-black text-white shadow-lg shadow-blue-500/30">3</div>
                <h3 class="mb-3 text-center text-xl font-black text-slate-900">Dashboard Terpadu</h3>
                <p class="text-center text-sm leading-relaxed text-slate-500">Buka halaman detail destinasi untuk melihat overview lengkap, pantauan keramaian AI, hingga simulasi deteksi objek terkini.</p>
            </article>

            <article class="relative z-10 rounded-[2rem] border border-slate-100 bg-white p-8 shadow-[0_20px_50px_rgba(15,23,42,0.04)] transition-all hover:-translate-y-2 hover:shadow-[0_30px_60px_rgba(15,23,42,0.08)]">
                <div class="mb-6 mx-auto flex h-16 w-16 items-center justify-center rounded-[1.25rem] bg-gradient-to-br from-violet-400 to-purple-500 text-2xl font-black text-white shadow-lg shadow-violet-500/30">4</div>
                <h3 class="mb-3 text-center text-xl font-black text-slate-900">Pesan & Nikmati</h3>
                <p class="text-center text-sm leading-relaxed text-slate-500">Lanjutkan pemesanan tiket dengan mudah dari panel sidebar yang selalu tersedia menemani eksplorasi informasi destinasi Anda.</p>
            </article>
        </div>
    </div>
</section>

<section id="faq" class="py-24 px-4 sm:px-6 lg:px-8 bg-white">
    <div class="mx-auto max-w-4xl">
        <div class="mb-16 text-center space-y-4">
            
            <h2 class="text-4xl font-black text-slate-900 sm:text-5xl">FAQ untuk Pengunjung</h2>
            <p class="text-lg text-slate-600">Jawaban singkat untuk membantu Anda sebelum menjelajahi destinasi.</p>
        </div>
        <div class="space-y-4">
            <div class="rounded-2xl border border-slate-200 p-6 bg-slate-50 transition-colors hover:border-cyan-200">
                <h3 class="text-xl font-bold text-slate-900">Apa yang bisa saya lakukan di sini sebelum berkunjung?</h3>
                <p class="mt-2 text-slate-600">Anda bisa melihat preview 360°, mengecek tingkat keramaian, membaca info area, dan membuka detail destinasi agar lebih siap sebelum datang.</p>
            </div>
            <div class="rounded-2xl border border-slate-200 p-6 bg-slate-50 transition-colors hover:border-cyan-200">
                <h3 class="text-xl font-bold text-slate-900">Apakah saya perlu login untuk melihat preview destinasi?</h3>
                <p class="mt-2 text-slate-600">Tidak perlu. Anda bisa langsung menjelajahi Street View 360 dan membaca informasi destinasi dari halaman beranda.</p>
            </div>
            <div class="rounded-2xl border border-slate-200 p-6 bg-slate-50 transition-colors hover:border-cyan-200">
                <h3 class="text-xl font-bold text-slate-900">Bagaimana saya tahu destinasi sedang ramai atau tidak?</h3>
                <p class="mt-2 text-slate-600">Setiap destinasi menampilkan indikator crowd, sehingga Anda bisa memilih waktu kunjungan yang lebih nyaman sesuai kondisi saat ini.</p>
            </div>
        </div>
    </div>
</section>

<section class="bg-gradient-to-r from-cyan-600 to-emerald-600 px-4 py-16 text-white sm:px-6 lg:px-8">
    <div class="mx-auto max-w-5xl rounded-[2rem] border border-white/15 bg-white/10 p-8 text-center shadow-2xl backdrop-blur-xl sm:p-12">
        <h2 class="text-4xl font-black sm:text-5xl">Siap menjelajahi Indonesia dengan alur yang lebih rapi?</h2>
        <p class="mx-auto mt-4 max-w-2xl text-lg text-cyan-100">
            Siapkan barang bawaanmu, nantikan liburan yang menjamin kenyamanan dan kebersamaan!
        </p>
        <div class="mt-8 flex flex-col justify-center gap-4 sm:flex-row">
            <a href="{{ url('/destinations') }}" class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-6 py-3 text-sm font-black text-cyan-700 transition-transform hover:-translate-y-0.5">
                Mulai dari Destinasi
            </a>
          
        </div>
    </div>
</section>

<style>
    @keyframes blob {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }

    .animation-delay-4000 {
        animation-delay: 4s;
    }

    .destination-preview-card.active {
        border-color: rgb(6 182 212);
        border-left-width: 4px;
        padding-left: 0.75rem;
        background: rgba(236, 254, 255, 0.85);
    }
</style>

<script>
    const previewData = @json($previewCards);

    function updatePreview(destinationId, cardElement) {
        const data = previewData[destinationId];

        if (!data) {
            return;
        }

        document.getElementById('preview-dest-name').textContent = data.name;
        document.getElementById('preview-dest-desc').textContent = data.desc || '';
        document.getElementById('preview-street-view').src = data.streetViewUrl ? data.streetViewUrl + '&output=svembed' : '';
        document.getElementById('preview-area').textContent = data.area || '-';
        document.getElementById('preview-best-time').textContent = data.best_time || '-';
        document.getElementById('preview-crowd').textContent = `${data.crowd ?? 0}%`;
        document.getElementById('preview-price').textContent = data.price > 0 ? `Rp ${new Intl.NumberFormat('id-ID').format(data.price)}` : 'Gratis';

        document.querySelectorAll('.destination-preview-card').forEach((card) => {
            card.classList.remove('active', 'border-cyan-500', 'border-l-4', 'pl-3');
        });

        if (cardElement) {
            cardElement.classList.add('active', 'border-cyan-500', 'border-l-4', 'pl-3');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const initialCard = document.querySelector('.destination-preview-card.active') || document.querySelector('.destination-preview-card');
        const initialId = initialCard?.dataset.dest;

        if (initialId) {
            updatePreview(initialId, initialCard);
        }
    });
</script>
@endsection
