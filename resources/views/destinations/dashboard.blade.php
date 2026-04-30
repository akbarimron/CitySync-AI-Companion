@extends('layouts.app')

@section('title', 'Detail Destinasi — Sivi AI')

@php
$selected = isset($destination) && is_object($destination) ? $destination->toUiArray() : [];
if (empty($selected)) {
    $selected = [
        'name' => 'Demo Destination',
        'area' => 'Jakarta',
        'category' => 'Budaya',
        'description' => 'Demo description',
        'price' => 0,
        'rating' => 4.5,
        'crowd' => 50,
        'weather' => 'Cerah',
        'opening_hours' => '08:00 - 17:00 WIB',
        'best_time' => 'Pagi hari',
        'tip' => 'Demo tip',
        'image_url' => 'https://images.unsplash.com/photo-1570129477492-45a003537e90?w=1400&h=900&fit=crop',
        'street_view_url' => '',
        'demo_video_url' => 'https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4',
        'visitors' => '1,200',
        'confidence' => 92,
    ];
}
$priceLabel = $selected['price'] > 0 ? 'Rp ' . number_format($selected['price'], 0, ',', '.') : 'Gratis';
$mapUrl = !empty($selected['street_view_url']) ? $selected['street_view_url'] . '&output=svembed' : '';
@endphp

@section('content')
<section class="relative overflow-hidden pt-28 pb-14 md:pt-32 md:pb-16 bg-gradient-to-br from-slate-950 via-cyan-950 to-emerald-950 text-white">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(34,211,238,0.18),transparent_28%),radial-gradient(circle_at_top_right,rgba(16,185,129,0.18),transparent_28%),linear-gradient(180deg,rgba(15,23,42,0),rgba(15,23,42,.2))]"></div>
    <div class="absolute left-6 top-8 h-64 w-64 rounded-full bg-cyan-400/20 blur-3xl"></div>
    <div class="absolute right-8 top-16 h-72 w-72 rounded-full bg-emerald-400/20 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-10 flex flex-wrap items-center gap-2 text-sm font-bold text-cyan-200">
            <a href="{{ url('/') }}" class="hover:text-white transition-colors">Beranda</a>
            <span class="text-cyan-600">/</span>
            <a href="{{ url('/destinations') }}" class="hover:text-white transition-colors">Destinasi</a>
            <span class="text-cyan-600">/</span>
            <span class="text-white">Dashboard Terpadu</span>
        </div>

        <div class="grid gap-8 lg:grid-cols-[minmax(0,1.1fr)_360px] lg:items-end">
            <div class="space-y-6">
                <div class="space-y-4">
                    <h1 class="max-w-4xl text-4xl font-black leading-[1.02] sm:text-5xl lg:text-6xl">{{ $selected['name'] }}</h1>
                    <p class="max-w-3xl text-base leading-7 text-slate-200 sm:text-lg">{{ $selected['description'] }}</p>
                </div>
                <div class="flex flex-wrap gap-4 text-sm font-bold text-cyan-100">
                    <span class="flex items-center gap-1.5"><svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>{{ $selected['category'] }}</span>
                    <span class="flex items-center gap-1.5"><svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>{{ $selected['area'] }}</span>
                    <span class="flex items-center gap-1.5 text-emerald-300"><svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.381z" clip-rule="evenodd"></path></svg>AI Monitor Ready</span>
                </div>
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-4">
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-slate-300">Rating</p>
                        <p class="mt-2 text-2xl font-black text-white">{{ $selected['rating'] }}</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-slate-300">Keramaian</p>
                        <p class="mt-2 text-2xl font-black text-white">{{ $selected['crowd'] }}%</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-slate-300">Cuaca</p>
                        <p class="mt-2 text-lg font-black text-white">{{ $selected['weather'] }}</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur">
                        <p class="text-xs font-black uppercase tracking-[0.2em] text-slate-300">Harga</p>
                        <p class="mt-2 text-lg font-black text-white">{{ $priceLabel }}</p>
                    </div>
                </div>
            </div>

            <div class="rounded-[1.75rem] border border-white/10 bg-white/10 p-5 shadow-2xl backdrop-blur-xl">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.22em] text-cyan-100/80">Status destinasi</p>
                        <p class="mt-1 text-2xl font-black text-white">Siap dijelajahi</p>
                    </div>
                    <div class="rounded-2xl bg-emerald-400/15 px-3 py-2 text-right ring-1 ring-emerald-300/20">
                        <p class="text-[10px] font-black uppercase tracking-[0.22em] text-emerald-100">Kapasitas</p>
                        <p class="text-xl font-black text-white">{{ $selected['crowd'] }}%</p>
                    </div>
                </div>
                <div class="mt-4 rounded-2xl border border-white/10 bg-slate-950/40 p-4">
                    <p class="text-xs font-black uppercase tracking-[0.2em] text-slate-300">Jam buka</p>
                    <p class="mt-2 text-lg font-black text-white">{{ $selected['opening_hours'] }}</p>
                    <p class="mt-3 text-sm leading-6 text-slate-300">{{ $selected['tip'] }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-[linear-gradient(180deg,#f8fcff_0%,#f3f8fd_100%)] py-12 md:py-14">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_360px] lg:items-start">
            <div class="space-y-8">
                <section class="rounded-[2rem] border border-slate-200/70 bg-white p-6 shadow-[0_20px_80px_rgba(15,23,42,0.07)] md:p-8">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <p class="text-xs font-black uppercase tracking-[0.22em] text-cyan-700">Overview</p>
                            <h2 class="mt-2 text-2xl font-black text-slate-900 sm:text-3xl">Ringkasan destinasi</h2>
                        </div>
                        <div class="rounded-full bg-cyan-50 px-4 py-2 text-sm font-bold text-cyan-700 ring-1 ring-cyan-100">{{ $selected['category'] }}</div>
                    </div>

                    <div class="mt-6 space-y-8">
                        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-slate-100 shadow-sm h-64 md:h-[400px]">
                            <img src="{{ $selected['image_url'] }}" alt="{{ $selected['name'] }}" class="h-full w-full object-cover" loading="lazy">
                        </div>
                        <div class="grid gap-6 lg:grid-cols-[minmax(0,1.1fr)_minmax(0,0.9fr)]">
                            <div class="space-y-4">
                                <p class="text-base leading-8 text-slate-600 md:text-lg">{{ $selected['description'] }}</p>
                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                                    <p class="text-xs font-black uppercase tracking-[0.22em] text-slate-500">Yang perlu diperhatikan</p>
                                    <p class="mt-3 text-sm leading-7 text-slate-600">Gunakan bagian Street View untuk melihat kondisi lokasi, lalu cek AI Monitor untuk membaca cuaca dan keramaian dari preview 360 demo. Semua tetap berada di satu halaman.</p>
                                </div>
                                <div class="grid gap-3 sm:grid-cols-3">
                                    <div class="rounded-2xl border border-slate-200 p-4">
                                        <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-500">Harga</p>
                                        <p class="mt-2 text-xl font-black text-slate-900">{{ $priceLabel }}</p>
                                    </div>
                                    <div class="rounded-2xl border border-slate-200 p-4">
                                        <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-500">Jam buka</p>
                                        <p class="mt-2 text-xl font-black text-slate-900">{{ $selected['opening_hours'] }}</p>
                                    </div>
                                    <div class="rounded-2xl border border-slate-200 p-4">
                                        <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-500">Waktu ideal</p>
                                        <p class="mt-2 text-xl font-black text-slate-900">{{ $selected['best_time'] }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="grid gap-3">
                                <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-cyan-50 to-white p-4">
                                    <p class="text-xs font-black uppercase tracking-[0.18em] text-cyan-700">Rating</p>
                                    <p class="mt-2 text-3xl font-black text-slate-900">{{ $selected['rating'] }}</p>
                                </div>
                                <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-emerald-50 to-white p-4">
                                    <p class="text-xs font-black uppercase tracking-[0.18em] text-emerald-700">Keramaian</p>
                                    <p class="mt-2 text-3xl font-black text-slate-900">{{ $selected['crowd'] }}%</p>
                                </div>
                                <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-slate-50 to-white p-4">
                                    <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-500">Catatan</p>
                                    <p class="mt-2 text-sm leading-7 text-slate-600">{{ $selected['tip'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="street-view" class="rounded-[2rem] border border-slate-200/70 bg-slate-950 p-5 text-white shadow-[0_20px_80px_rgba(15,23,42,0.12)] md:p-6">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <p class="text-xs font-black uppercase tracking-[0.22em] text-cyan-200/80">Street View</p>
                            <h2 class="mt-2 text-2xl font-black sm:text-3xl">Preview 360 di dalam home flow</h2>
                        </div>
                        <div class="rounded-full border border-cyan-300/20 bg-cyan-400/10 px-4 py-2 text-sm font-bold text-cyan-100">Demo map tanpa API key</div>
                    </div>

                    <div class="mt-5 grid gap-6 lg:grid-cols-[minmax(0,1.2fr)_minmax(0,0.8fr)]">
                        <div class="overflow-hidden rounded-[1.75rem] border border-white/10 bg-slate-900">
                            <div class="flex items-center justify-between border-b border-white/10 px-4 py-3 text-xs font-black uppercase tracking-[0.18em] text-slate-300">
                                <span>Google Maps / Street View demo</span>
                                <span class="text-emerald-300">Live 360° placeholder</span>
                            </div>
                            <iframe
                                src="{{ $mapUrl }}"
                                class="h-[340px] w-full md:h-[460px]"
                                style="border: 0;"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                title="{{ $selected['name'] }} Street View Demo"
                            ></iframe>
                        </div>

                        <div class="space-y-4 rounded-[1.75rem] border border-white/10 bg-white/5 p-5 backdrop-blur">
                            <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                                <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-300">Status preview</p>
                                <p class="mt-2 text-lg font-black text-white">{{ $selected['name'] }}</p>
                                <p class="mt-2 text-sm leading-7 text-slate-300">Bagian ini tetap tampil di halaman destinasi agar pengguna bisa melihat preview lokasi sebelum masuk ke AI Monitor.</p>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                                    <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-300">Location</p>
                                    <p class="mt-2 text-sm font-bold text-white">{{ $selected['area'] ?? '' }}</p>
                                </div>
                                <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                                    <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-300">Weather</p>
                                    <p class="mt-2 text-sm font-bold text-white">{{ $selected['weather'] }}</p>
                                </div>
                            </div>
                            <div class="rounded-2xl bg-gradient-to-br from-emerald-400/15 to-cyan-400/15 p-4 ring-1 ring-emerald-300/20">
                                <p class="text-xs font-black uppercase tracking-[0.18em] text-emerald-100">Catatan API</p>
                                <p class="mt-2 text-sm leading-7 text-slate-200">Saat ini preview 360 masih menggunakan demo embed. Jika API Google Maps sudah tersedia, blok ini tinggal diganti tanpa mengubah struktur halaman.</p>
                            </div>
                            <a href="{{ url('/street-view') }}" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-white px-5 py-3 text-sm font-black text-slate-900 transition-transform hover:-translate-y-0.5">
                                Buka Street View Home
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                </section>

                <section id="ai-monitor" class="rounded-[2rem] border border-slate-200/70 bg-white p-6 shadow-[0_20px_80px_rgba(15,23,42,0.07)] md:p-8">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <p class="text-xs font-black uppercase tracking-[0.22em] text-cyan-700">AI Monitor</p>
                            <h2 class="mt-2 text-2xl font-black text-slate-900 sm:text-3xl">Preview hasil live 360 dengan upload gambar demo</h2>
                        </div>
                        <div class="rounded-full bg-emerald-50 px-4 py-2 text-sm font-bold text-emerald-700 ring-1 ring-emerald-100">Demo sementara</div>
                    </div>

                    <div class="mt-6 grid gap-6 xl:grid-cols-[minmax(0,0.9fr)_minmax(0,1.1fr)]">
                        <div class="space-y-4">
                            <form id="analysisForm" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                    <label for="video_file" class="mb-2 block text-sm font-bold text-slate-700">Upload Video (.mp4/.avi)</label>
                                    <input
                                        id="video_file"
                                        name="video_file"
                                        type="file"
                                        accept="video/*"
                                        class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm"
                                    />
                                    <p id="fileInfo" class="mt-1 text-xs text-slate-500"></p>
                                </div>

                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                    <label for="video_source" class="mb-2 block text-sm font-bold text-slate-700">Atau URL/Path Source (RTSP/HTTP/local/0)</label>
                                    <input
                                        id="video_source"
                                        name="video_source"
                                        type="text"
                                        placeholder="Contoh: 0 atau rtsp://..."
                                        class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2 text-sm"
                                    />
                                </div>

                                <button
                                    id="submitBtn"
                                    type="submit"
                                    class="inline-flex w-full items-center justify-center rounded-2xl bg-cyan-600 px-5 py-4 text-sm font-black text-white transition-transform hover:-translate-y-0.5 disabled:opacity-50 disabled:cursor-not-allowed"
                                >
                                    <span id="btnText">Jalankan Analisis AI</span>
                                    <span id="btnSpinner" class="hidden ml-2">
                                        <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </span>
                                </button>
                            </form>
                            <div class="mt-5 rounded-lg bg-amber-50 p-3 text-xs text-amber-800">
                                <p class="font-semibold">Pastikan environment Python sudah siap:</p>
                                <p class="mt-1 font-mono">pip install opencv-python ultralytics torch torchvision pillow</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="grid gap-3 sm:grid-cols-2">
                                <div class="rounded-[1.5rem] border border-slate-200 bg-gradient-to-br from-cyan-50 to-white p-5">
                                    <p class="text-xs font-black uppercase tracking-[0.18em] text-cyan-700">Cuaca terdeteksi</p>
                                    <p id="ai-weather" class="mt-3 text-2xl font-black text-slate-900">-</p>
                                </div>
                                <div class="rounded-[1.5rem] border border-slate-200 bg-gradient-to-br from-emerald-50 to-white p-5">
                                    <p class="text-xs font-black uppercase tracking-[0.18em] text-emerald-700">Keramaian</p>
                                    <p id="ai-crowd" class="mt-3 text-2xl font-black text-slate-900">-</p>
                                </div>
                                <div class="col-span-2 rounded-[1.5rem] border border-slate-200 bg-gradient-to-br from-slate-50 to-white p-5">
                                    <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-500">Rekomendasi</p>
                                    <p id="ai-recommendation" class="mt-3 text-base font-bold text-slate-900">Tunggu hasil analisis...</p>
                                </div>
                            </div>

                            <div class="rounded-[1.5rem] border border-slate-200 bg-slate-900 p-5 text-white" id="ai-video-container" style="display: none;">
                                <p class="mb-3 text-xs font-black uppercase tracking-[0.18em] text-cyan-200">Hasil Render YOLOv8</p>
                                <video id="ai-result-video" controls class="w-full rounded-xl bg-black">
                                    <source src="" type="video/mp4">
                                </video>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <aside id="booking" class="lg:sticky lg:top-28 h-fit space-y-6">
                <div class="rounded-[2rem] border border-slate-200/80 bg-white p-6 shadow-[0_20px_80px_rgba(15,23,42,0.08)]">
                    <p class="text-xs font-black uppercase tracking-[0.22em] text-cyan-700">Booking Sidebar</p>
                    <h2 class="mt-2 text-2xl font-black text-slate-900">Pesan dari halaman ini</h2>
                    <div class="mt-5 rounded-[1.5rem] bg-gradient-to-br from-cyan-50 to-emerald-50 p-5 ring-1 ring-cyan-100">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-500">Harga mulai</p>
                        <p class="mt-2 text-3xl font-black text-slate-900">{{ $priceLabel }}</p>
                        <p class="mt-3 text-sm leading-7 text-slate-600">Semua informasi booking tetap konstan di sisi kanan, sementara sisi kiri memuat overview, street view, dan AI monitor.</p>
                    </div>

                    <div class="mt-5 space-y-4">
                        <div>
                            <label for="booking-date" class="mb-2 block text-sm font-bold text-slate-700">Tanggal kunjungan</label>
                            <input id="booking-date" type="date" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100">
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-bold text-slate-700">Jumlah tiket</label>
                            <div class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                                <button id="ticket-decrease" type="button" class="flex h-10 w-10 items-center justify-center rounded-full bg-white text-lg font-black text-slate-900 shadow-sm ring-1 ring-slate-200 transition-transform hover:scale-105">−</button>
                                <div class="text-center">
                                    <p id="ticket-count" class="text-2xl font-black text-slate-900">1</p>
                                    <p class="text-xs font-bold text-slate-500">tiket</p>
                                </div>
                                <button id="ticket-increase" type="button" class="flex h-10 w-10 items-center justify-center rounded-full bg-white text-lg font-black text-slate-900 shadow-sm ring-1 ring-slate-200 transition-transform hover:scale-105">+</button>
                            </div>
                        </div>

                        <div class="rounded-2xl border border-slate-200 p-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500">Harga satuan</span>
                                <span class="font-bold text-slate-900">{{ $priceLabel }}</span>
                            </div>
                            <div class="mt-3 flex items-center justify-between text-sm">
                                <span class="text-slate-500">Total</span>
                                <span id="booking-total" class="text-2xl font-black text-cyan-700">{{ $priceLabel }}</span>
                            </div>
                        </div>

                        <button type="button" class="w-full rounded-2xl bg-slate-950 px-5 py-4 text-sm font-black text-white transition-transform hover:-translate-y-0.5">
                            Pesan Tiket Demo
                        </button>
                        <a href="{{ url('/destinations') }}" class="block w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 text-center text-sm font-black text-slate-700 transition-colors hover:bg-slate-50">
                            Kembali ke daftar destinasi
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
(function () {
    const price = {{ (float) ($selected['price'] ?? 0) }};
    let ticketCount = 1;

    const ticketCountEl = document.getElementById('ticket-count');
    const bookingTotalEl = document.getElementById('booking-total');
    const ticketIncreaseEl = document.getElementById('ticket-increase');
    const ticketDecreaseEl = document.getElementById('ticket-decrease');

    function formatCurrency(value) {
        if (value <= 0) {
            return 'Gratis';
        }
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
    }

    function updateBookingTotal() {
        const total = price * ticketCount;
        ticketCountEl.textContent = String(ticketCount);
        bookingTotalEl.textContent = formatCurrency(total);
    }

    if(ticketIncreaseEl) {
        ticketIncreaseEl.addEventListener('click', function () {
            ticketCount = Math.min(9, ticketCount + 1);
            updateBookingTotal();
        });
    }

    if(ticketDecreaseEl) {
        ticketDecreaseEl.addEventListener('click', function () {
            ticketCount = Math.max(1, ticketCount - 1);
            updateBookingTotal();
        });
    }

    updateBookingTotal();

    // AI Monitor Logic
    const form = document.getElementById('analysisForm');
    const fileInput = document.getElementById('video_file');
    const sourceInput = document.getElementById('video_source');
    const submitBtn = document.getElementById('submitBtn');
    const fileInfo = document.getElementById('fileInfo');

    if(form) {
        const MAX_FILE_SIZE_MB = 500;
        const MAX_FILE_SIZE_BYTES = MAX_FILE_SIZE_MB * 1024 * 1024;

        fileInput.addEventListener('change', function(e) {
            if (this.files.length > 0) {
                const file = this.files[0];
                const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
                if (file.size > MAX_FILE_SIZE_BYTES) {
                    fileInfo.textContent = `⚠ File terlalu besar: ${sizeMB} MB (maks ${MAX_FILE_SIZE_MB} MB)`;
                    fileInfo.className = 'mt-1 text-xs font-bold text-red-500';
                    this.value = '';
                } else {
                    fileInfo.textContent = `✓ File: ${file.name} (${sizeMB} MB)`;
                    fileInfo.className = 'mt-1 text-xs font-bold text-emerald-600';
                }
            } else {
                fileInfo.textContent = '';
            }
        });

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            const hasFile = fileInput.files.length > 0;
            const hasSource = sourceInput.value.trim().length > 0;

            if (!hasFile && !hasSource) {
                fileInfo.textContent = '⚠ Pilih file atau isi URL/path source!';
                fileInfo.className = 'mt-1 text-xs font-bold text-red-500';
                return false;
            }

            if (hasFile && fileInput.files[0].size > MAX_FILE_SIZE_BYTES) {
                const sizeMB = (fileInput.files[0].size / (1024 * 1024)).toFixed(2);
                fileInfo.textContent = `⚠ File terlalu besar: ${sizeMB} MB (maks ${MAX_FILE_SIZE_MB} MB)`;
                fileInfo.className = 'mt-1 text-xs font-bold text-red-500';
                return false;
            }

            submitBtn.disabled = true;
            document.getElementById('btnText').classList.add('hidden');
            document.getElementById('btnSpinner').classList.remove('hidden');

            try {
                const formData = new FormData();
                const token = document.querySelector('input[name="_token"]').value;
                formData.append('_token', token);

                if (hasFile) formData.append('video_file', fileInput.files[0]);
                if (hasSource) formData.append('video_source', sourceInput.value.trim());
                formData.append('json', '1'); // Request JSON response instead of HTML view

                const response = await fetch('{{ route("akbar.ai-monitor.analyze") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    const data = await response.json();

                    document.getElementById('ai-weather').innerHTML = (data.weather_icon || '') + ' ' + (data.dominant_weather_label || '-');
                    document.getElementById('ai-crowd').textContent = (data.crowd_level || '-') + ' (' + (data.avg_person_count || 0) + ' orang)';

                    const recEl = document.getElementById('ai-recommendation');
                    recEl.innerHTML = '<span class="text-base">💡</span> ' + (data.visit_recommendation || 'Analisis selesai.');

                    if (data.output_video_url) {
                        const videoContainer = document.getElementById('ai-video-container');
                        const videoEl = document.getElementById('ai-result-video');
                        videoContainer.style.display = 'block';
                        videoEl.src = data.output_video_url;
                        videoEl.play();
                    }
                } else {
                    const errorText = await response.text();
                    fileInfo.textContent = '⚠ Upload gagal: ' + errorText;
                    fileInfo.className = 'mt-1 text-xs font-bold text-red-500';
                }
            } catch (error) {
                fileInfo.textContent = '⚠ Error: ' + error.message;
                fileInfo.className = 'mt-1 text-xs font-bold text-red-500';
            } finally {
                submitBtn.disabled = false;
                document.getElementById('btnText').classList.remove('hidden');
                document.getElementById('btnSpinner').classList.add('hidden');
            }
        });
    }
})();
</script>
@endpush
