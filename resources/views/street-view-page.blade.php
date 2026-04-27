@extends('layouts.app')

@section('title', 'Street View 360° — CitySync AI')

@section('content')

{{-- ── HERO ─────────────────────────────────────────────── --}}
<section class="relative min-h-[38vh] flex items-end overflow-hidden bg-gradient-to-br from-slate-900 via-cyan-900 to-emerald-900">
    {{-- Animated blobs --}}
    <div class="absolute top-10 left-10 w-72 h-72 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
    <div class="absolute top-20 right-10 w-72 h-72 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 w-full">
        {{-- Back --}}
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-cyan-300 hover:text-cyan-200 text-sm font-bold mb-8 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Beranda
        </a>

        {{-- Kicker --}}
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-cyan-500/10 border border-cyan-500/30 rounded-full backdrop-blur-sm mb-6">
            <svg class="w-4 h-4 text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
            </svg>
            <span class="text-xs font-bold text-cyan-300 uppercase tracking-widest">Live 360° Immersive Preview</span>
        </div>

        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white leading-tight mb-4">
            Jelajahi Destinasi
            <span class="block bg-gradient-to-r from-cyan-400 via-emerald-400 to-blue-400 text-transparent bg-clip-text">
                dengan Street View 360°
            </span>
        </h1>
        <p class="text-lg text-slate-300 max-w-2xl">
            Lihat kondisi nyata destinasi wisata secara interaktif sebelum berkunjung — simulasi menggunakan Google Street View API.
        </p>
    </div>
</section>

{{-- ── MAIN CONTENT ───────────────────────────────────────── --}}
<section class="bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- ── LEFT SIDEBAR: Destination Selector ──────────── --}}
            <aside class="lg:col-span-3 space-y-4">
                {{-- Live badge --}}
                <div class="flex items-center gap-2 px-4 py-3 bg-emerald-100 border border-emerald-300 rounded-xl">
                    <span class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse flex-shrink-0"></span>
                    <div>
                        <p class="font-bold text-emerald-900 text-sm leading-tight">Street View Aktif</p>
                        <p class="text-xs text-emerald-700">Simulasi via Google Maps</p>
                    </div>
                </div>

                <h2 class="text-sm font-black text-slate-500 uppercase tracking-widest px-1">Pilih Destinasi</h2>

                {{-- Destination cards --}}
                <div class="space-y-3" id="dest-list">

                    {{-- Kota Tua --}}
                    <button onclick="selectDestination('kotaTua')"
                        class="dest-btn w-full text-left rounded-2xl border-2 border-transparent bg-white shadow-md hover:shadow-lg hover:border-cyan-400 transition-all duration-300 p-4 group"
                        data-dest="kotaTua">
                        <div class="flex gap-3 items-start">
                            <img src="https://images.unsplash.com/photo-1570129477492-45a003537e90?w=80&h=80&fit=crop" alt="Kota Tua"
                                class="w-16 h-16 object-cover rounded-xl flex-shrink-0 group-hover:scale-105 transition-transform" />
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-0.5">
                                    <h3 class="font-black text-slate-900 text-sm truncate">Kota Tua Jakarta</h3>
                                </div>
                                <p class="text-xs text-slate-500 mb-2">Jakarta Barat</p>
                                <div class="flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    <span class="text-xs font-bold text-emerald-700">Crowd: 52%</span>
                                </div>
                            </div>
                        </div>
                    </button>

                    {{-- Dufan --}}
                    <button onclick="selectDestination('dufan')"
                        class="dest-btn w-full text-left rounded-2xl border-2 border-transparent bg-white shadow-md hover:shadow-lg hover:border-cyan-400 transition-all duration-300 p-4 group"
                        data-dest="dufan">
                        <div class="flex gap-3 items-start">
                            <img src="https://images.unsplash.com/photo-1540932239986-310128078ceb?w=80&h=80&fit=crop" alt="Dufan"
                                class="w-16 h-16 object-cover rounded-xl flex-shrink-0 group-hover:scale-105 transition-transform" />
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-0.5">
                                    <h3 class="font-black text-slate-900 text-sm truncate">Dufan Ancol</h3>
                                </div>
                                <p class="text-xs text-slate-500 mb-2">Jakarta Utara</p>
                                <div class="flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                                    <span class="text-xs font-bold text-orange-700">Crowd: 85%</span>
                                </div>
                            </div>
                        </div>
                    </button>

                    {{-- Monas --}}
                    <button onclick="selectDestination('monas')"
                        class="dest-btn w-full text-left rounded-2xl border-2 border-transparent bg-white shadow-md hover:shadow-lg hover:border-cyan-400 transition-all duration-300 p-4 group"
                        data-dest="monas">
                        <div class="flex gap-3 items-start">
                            <img src="https://images.unsplash.com/photo-1512207736139-e8c07a4b0a8e?w=80&h=80&fit=crop" alt="Monas"
                                class="w-16 h-16 object-cover rounded-xl flex-shrink-0 group-hover:scale-105 transition-transform" />
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-0.5">
                                    <h3 class="font-black text-slate-900 text-sm truncate">Monumen Nasional</h3>
                                </div>
                                <p class="text-xs text-slate-500 mb-2">Jakarta Pusat</p>
                                <div class="flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-yellow-500"></span>
                                    <span class="text-xs font-bold text-yellow-700">Crowd: 61%</span>
                                </div>
                            </div>
                        </div>
                    </button>

                    {{-- TMII --}}
                    <button onclick="selectDestination('tmii')"
                        class="dest-btn w-full text-left rounded-2xl border-2 border-transparent bg-white shadow-md hover:shadow-lg hover:border-cyan-400 transition-all duration-300 p-4 group"
                        data-dest="tmii">
                        <div class="flex gap-3 items-start">
                            <img src="https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=80&h=80&fit=crop" alt="TMII"
                                class="w-16 h-16 object-cover rounded-xl flex-shrink-0 group-hover:scale-105 transition-transform" />
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-0.5">
                                    <h3 class="font-black text-slate-900 text-sm truncate">Taman Mini Indonesia</h3>
                                </div>
                                <p class="text-xs text-slate-500 mb-2">Jakarta Timur</p>
                                <div class="flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    <span class="text-xs font-bold text-emerald-700">Crowd: 38%</span>
                                </div>
                            </div>
                        </div>
                    </button>

                    {{-- Ancol Waterfront --}}
                    <button onclick="selectDestination('ancol')"
                        class="dest-btn w-full text-left rounded-2xl border-2 border-transparent bg-white shadow-md hover:shadow-lg hover:border-cyan-400 transition-all duration-300 p-4 group"
                        data-dest="ancol">
                        <div class="flex gap-3 items-start">
                            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=80&h=80&fit=crop" alt="Ancol"
                                class="w-16 h-16 object-cover rounded-xl flex-shrink-0 group-hover:scale-105 transition-transform" />
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-0.5">
                                    <h3 class="font-black text-slate-900 text-sm truncate">Ancol Waterfront</h3>
                                </div>
                                <p class="text-xs text-slate-500 mb-2">Jakarta Utara</p>
                                <div class="flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    <span class="text-xs font-bold text-emerald-700">Crowd: 44%</span>
                                </div>
                            </div>
                        </div>
                    </button>

                </div>

                {{-- CTA to AI Monitor --}}
                <a href="{{ url('/ai-monitor') }}"
                   class="flex items-center justify-center gap-2 w-full mt-2 px-4 py-3 bg-slate-900 text-white font-bold text-sm rounded-2xl hover:bg-slate-800 transition-colors shadow-lg">
                    <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Buka AI Monitor
                </a>
            </aside>

            {{-- ── RIGHT: Street View Viewer ────────────────────── --}}
            <main class="lg:col-span-9 space-y-6">

                {{-- Destination Header --}}
                <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <h2 id="sv-dest-name" class="text-2xl font-black text-slate-900">Kota Tua Jakarta</h2>
                                <span id="sv-crowd-badge" class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-black rounded-full">Crowd: 52%</span>
                            </div>
                            <p id="sv-dest-location" class="text-sm text-slate-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
                                Jakarta Barat, DKI Jakarta
                            </p>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-2 px-3 py-2 bg-slate-100 rounded-lg text-xs font-bold text-slate-700">
                                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                                Live Preview
                            </div>
                            <a id="sv-maps-link" href="https://maps.google.com/?q=-6.1344,106.8065" target="_blank"
                               class="flex items-center gap-2 px-4 py-2 bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-bold rounded-xl transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                Google Maps
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Street View Iframe --}}
                <div class="bg-slate-900 rounded-2xl overflow-hidden shadow-2xl border border-slate-700 relative">
                    {{-- Toolbar --}}
                    <div class="flex items-center justify-between px-5 py-3 bg-slate-800 border-b border-slate-700">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                        </div>
                        <div class="flex items-center gap-2 px-4 py-1.5 bg-slate-700 rounded-lg border border-slate-600">
                            <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <span id="sv-iframe-url" class="text-xs text-slate-300 font-mono truncate max-w-xs">google.com/maps/embed — Kota Tua Jakarta</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-slate-400 font-bold">
                            <span class="w-2 h-2 bg-cyan-400 rounded-full animate-pulse"></span>
                            360° ACTIVE
                        </div>
                    </div>

                    {{-- Loading overlay --}}
                    <div id="sv-loading" class="absolute inset-0 top-12 bg-slate-900 flex flex-col items-center justify-center z-10 transition-opacity duration-500">
                        <div class="w-16 h-16 border-4 border-cyan-500 border-t-transparent rounded-full animate-spin mb-4"></div>
                        <p class="text-slate-400 font-bold">Memuat Street View...</p>
                        <p class="text-slate-500 text-sm mt-1">Menghubungkan ke Google Maps</p>
                    </div>

                    <iframe
                        id="sv-iframe"
                        class="w-full"
                        style="height: 70vh; min-height: 520px; border: none; display: block;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.938853786688!2d106.80398!3d-6.13439!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5e92efb9acb%3A0x8196c4e08040b3e8!2sKota%20Tua%20Jakarta!5e0!3m2!1sen!2sid!4v1699000000000!5m2!1sen!2sid"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Google Street View"
                        onload="document.getElementById('sv-loading').style.opacity='0'; setTimeout(()=>document.getElementById('sv-loading').style.display='none',500);"
                    ></iframe>
                </div>

                {{-- Info Row --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- GPS --}}
                    <div class="bg-white rounded-2xl shadow border border-slate-100 p-5">
                        <p class="text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Koordinat GPS</p>
                        <p id="sv-coords" class="font-mono text-lg font-bold text-emerald-700">-6.1344°, 106.8065°</p>
                    </div>

                    {{-- Address --}}
                    <div class="bg-white rounded-2xl shadow border border-slate-100 p-5">
                        <p class="text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Alamat</p>
                        <p id="sv-address" class="text-sm font-semibold text-slate-900">Jl. Pintu Besar Utara, Jakarta Barat</p>
                    </div>

                    {{-- ETA --}}
                    <div class="bg-white rounded-2xl shadow border border-slate-100 p-5">
                        <p class="text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Estimasi Jarak</p>
                        <p id="sv-eta" class="text-sm font-semibold text-slate-900">~5 km dari pusat kota · 24 menit</p>
                    </div>
                </div>

                {{-- Navigation Tips --}}
                <div class="bg-gradient-to-r from-slate-900 to-cyan-900 rounded-2xl p-6 border border-cyan-500/20">
                    <h3 class="text-white font-black mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-cyan-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                        Tips Navigasi 360°
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <div class="bg-white/10 rounded-xl p-4">
                            <div class="text-2xl mb-2">🖱️</div>
                            <p class="text-white text-sm font-semibold">Drag mouse</p>
                            <p class="text-slate-400 text-xs">Putar pandangan</p>
                        </div>
                        <div class="bg-white/10 rounded-xl p-4">
                            <div class="text-2xl mb-2">🔍</div>
                            <p class="text-white text-sm font-semibold">Scroll</p>
                            <p class="text-slate-400 text-xs">Zoom in / out</p>
                        </div>
                        <div class="bg-white/10 rounded-xl p-4">
                            <div class="text-2xl mb-2">👆</div>
                            <p class="text-white text-sm font-semibold">Klik panah</p>
                            <p class="text-slate-400 text-xs">Pindah lokasi</p>
                        </div>
                        <div class="bg-white/10 rounded-xl p-4">
                            <div class="text-2xl mb-2">⛶</div>
                            <p class="text-white text-sm font-semibold">Full screen</p>
                            <p class="text-slate-400 text-xs">Ikon di kanan atas</p>
                        </div>
                    </div>
                </div>

                {{-- Other destinations quick access --}}
                <div class="bg-white rounded-2xl shadow border border-slate-100 p-6">
                    <h3 class="text-sm font-black text-slate-500 uppercase tracking-widest mb-4">Destinasi Lainnya</h3>
                    <div class="flex flex-wrap gap-3" id="quick-dest-btns">
                        {{-- Filled by JS --}}
                    </div>
                </div>
            </main>

        </div>
    </div>
</section>

<style>
    @keyframes blob {
        0%, 100% { transform: translate(0,0) scale(1); }
        33% { transform: translate(30px,-50px) scale(1.1); }
        66% { transform: translate(-20px,20px) scale(0.9); }
    }
    .animate-blob { animation: blob 7s infinite; }
    .animation-delay-2000 { animation-delay: 2s; }

    .dest-btn.active {
        border-color: #06b6d4;
        background: linear-gradient(135deg, #ecfeff, #f0fdf4);
        box-shadow: 0 4px 20px rgba(6,182,212,0.15);
    }
</style>

@push('scripts')
<script>
const destinations = {
    kotaTua: {
        name: 'Kota Tua Jakarta',
        location: 'Jakarta Barat, DKI Jakarta',
        address: 'Jl. Pintu Besar Utara, Jakarta Barat',
        coords: '-6.1344°, 106.8065°',
        lat: -6.1344, lng: 106.8065,
        crowd: 52,
        eta: '~5 km dari pusat kota · 24 menit',
        crowdColor: 'bg-emerald-100 text-emerald-700',
        embedUrl: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.938853786688!2d106.80398!3d-6.13439!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5e92efb9acb%3A0x8196c4e08040b3e8!2sKota%20Tua%20Jakarta!5e0!3m2!1sen!2sid!4v1699000000000!5m2!1sen!2sid',
    },
    dufan: {
        name: 'Dufan Ancol',
        location: 'Jakarta Utara, DKI Jakarta',
        address: 'Jl. Lodan Timur No.7, Ancol, Jakarta Utara',
        coords: '-6.1290°, 106.7868°',
        lat: -6.1290, lng: 106.7868,
        crowd: 85,
        eta: '~8 km dari pusat kota · 38 menit',
        crowdColor: 'bg-red-100 text-red-700',
        embedUrl: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2!2d106.7868!3d-6.1290!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a0091e3e02bd9%3A0xe4f81960e94a3a8!2sDufan%20-%20Dunia%20Fantasi!5e0!3m2!1sen!2sid!4v1699000000000!5m2!1sen!2sid',
    },
    monas: {
        name: 'Monumen Nasional',
        location: 'Jakarta Pusat, DKI Jakarta',
        address: 'Gambir, Jakarta Pusat, DKI Jakarta',
        coords: '-6.1751°, 106.8270°',
        lat: -6.1751, lng: 106.8270,
        crowd: 61,
        eta: '~2 km dari pusat kota · 18 menit',
        crowdColor: 'bg-yellow-100 text-yellow-700',
        embedUrl: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.5!2d106.8270!3d-6.1751!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e3a34c30cf%3A0x1c8db3cd3af2e8e2!2sNational%20Monument%20(MONAS)!5e0!3m2!1sen!2sid!4v1699000000000!5m2!1sen!2sid',
    },
    tmii: {
        name: 'Taman Mini Indonesia Indah',
        location: 'Jakarta Timur, DKI Jakarta',
        address: 'Taman Mini, Cipayung, Jakarta Timur',
        coords: '-6.2961°, 106.8941°',
        lat: -6.2961, lng: 106.8941,
        crowd: 38,
        eta: '~12 km dari pusat kota · 45 menit',
        crowdColor: 'bg-emerald-100 text-emerald-700',
        embedUrl: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.5!2d106.8941!3d-6.2961!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698ef8ad85fb1b%3A0xe598d5a6c2e9a89a!2sTaman%20Mini%20Indonesia%20Indah!5e0!3m2!1sen!2sid!4v1699000000000!5m2!1sen!2sid',
    },
    ancol: {
        name: 'Ancol Waterfront',
        location: 'Jakarta Utara, DKI Jakarta',
        address: 'Jl. Lodan Timur, Ancol, Jakarta Utara',
        coords: '-6.1220°, 106.8300°',
        lat: -6.1220, lng: 106.8300,
        crowd: 44,
        eta: '~9 km dari pusat kota · 35 menit',
        crowdColor: 'bg-emerald-100 text-emerald-700',
        embedUrl: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.0!2d106.8300!3d-6.1220!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a00820b2fd27b%3A0xbadf9d41571a9c38!2sAncol%20Beach%20City!5e0!3m2!1sen!2sid!4v1699000000000!5m2!1sen!2sid',
    },
};

let currentDest = 'kotaTua';

function selectDestination(id) {
    const dest = destinations[id];
    if (!dest) return;
    currentDest = id;

    // Update active sidebar button
    document.querySelectorAll('.dest-btn').forEach(btn => {
        btn.classList.toggle('active', btn.dataset.dest === id);
    });

    // Update header info
    document.getElementById('sv-dest-name').textContent = dest.name;
    document.getElementById('sv-dest-location').innerHTML = `
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
        ${dest.location}`;
    document.getElementById('sv-crowd-badge').textContent = `Crowd: ${dest.crowd}%`;
    document.getElementById('sv-crowd-badge').className = `px-3 py-1 text-xs font-black rounded-full ${dest.crowdColor}`;

    // Update maps link
    document.getElementById('sv-maps-link').href = `https://maps.google.com/?q=${dest.lat},${dest.lng}`;

    // Update URL bar label
    document.getElementById('sv-iframe-url').textContent = `google.com/maps/embed — ${dest.name}`;

    // Show loading, update iframe
    const loading = document.getElementById('sv-loading');
    loading.style.display = 'flex';
    loading.style.opacity = '1';

    document.getElementById('sv-iframe').src = dest.embedUrl;

    // Info row
    document.getElementById('sv-coords').textContent = dest.coords;
    document.getElementById('sv-address').textContent = dest.address;
    document.getElementById('sv-eta').textContent = dest.eta;

    // Update quick buttons
    renderQuickButtons(id);
}

function renderQuickButtons(activeDest) {
    const container = document.getElementById('quick-dest-btns');
    container.innerHTML = '';
    Object.entries(destinations).forEach(([id, d]) => {
        if (id === activeDest) return;
        const btn = document.createElement('button');
        btn.onclick = () => selectDestination(id);
        btn.className = 'inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-cyan-50 hover:border-cyan-300 border border-transparent text-slate-700 hover:text-cyan-700 text-sm font-bold rounded-full transition-all duration-200';
        btn.innerHTML = `
            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>
            ${d.name}`;
        container.appendChild(btn);
    });
}

// Initialize on load
document.addEventListener('DOMContentLoaded', () => {
    selectDestination('kotaTua');
});
</script>
@endpush

@endsection
