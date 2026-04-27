@extends('layouts.app')

@section('title', 'AI Monitor — CitySync AI')

@section('content')

{{-- ── HERO ─────────────────────────────────────────────── --}}
<section class="relative min-h-[38vh] flex items-end overflow-hidden bg-gradient-to-br from-slate-900 via-blue-900 to-cyan-900">
    <div class="absolute top-10 left-10 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
    <div class="absolute top-20 right-10 w-72 h-72 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 w-full">
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-cyan-300 hover:text-cyan-200 text-sm font-bold mb-8 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Beranda
        </a>

        <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500/10 border border-blue-500/30 rounded-full backdrop-blur-sm mb-6">
            <svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
            </svg>
            <span class="text-xs font-bold text-blue-300 uppercase tracking-widest">YOLO + MobileNet AI Analysis</span>
        </div>

        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white leading-tight mb-4">
            AI Monitor
            <span class="block bg-gradient-to-r from-blue-400 via-cyan-400 to-emerald-400 text-transparent bg-clip-text">
                Cuaca & Tingkat Keramaian
            </span>
        </h1>
        <p class="text-lg text-slate-300 max-w-2xl">
            Analisis kondisi real-time setiap destinasi — deteksi keramaian (person count) dan klasifikasi cuaca menggunakan computer vision AI.
        </p>
    </div>
</section>

{{-- ── MAIN CONTENT ─────────────────────────────────────── --}}
<section class="bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- ── LEFT SIDEBAR: Destination Selector ──────────── --}}
            <aside class="lg:col-span-3 space-y-4">
                {{-- Live badge --}}
                <div class="flex items-center gap-2 px-4 py-3 bg-blue-100 border border-blue-300 rounded-xl">
                    <span class="w-3 h-3 bg-blue-500 rounded-full animate-pulse flex-shrink-0"></span>
                    <div>
                        <p class="font-bold text-blue-900 text-sm leading-tight">AI Monitor Aktif</p>
                        <p class="text-xs text-blue-700">YOLO v8 + MobileNet</p>
                    </div>
                </div>

                <h2 class="text-sm font-black text-slate-500 uppercase tracking-widest px-1">Pilih Destinasi</h2>

                <div class="space-y-3" id="mon-dest-list">

                    {{-- Kota Tua --}}
                    <button onclick="selectMonitorDest('kotaTua')"
                        class="mon-dest-btn w-full text-left rounded-2xl border-2 border-transparent bg-white shadow-md hover:shadow-lg hover:border-blue-400 transition-all duration-300 p-4 group"
                        data-dest="kotaTua">
                        <div class="flex gap-3 items-start">
                            <img src="https://images.unsplash.com/photo-1570129477492-45a003537e90?w=80&h=80&fit=crop" alt="Kota Tua"
                                class="w-16 h-16 object-cover rounded-xl flex-shrink-0 group-hover:scale-105 transition-transform"/>
                            <div>
                                <h3 class="font-black text-slate-900 text-sm">Kota Tua Jakarta</h3>
                                <p class="text-xs text-slate-500 mb-1">Jakarta Barat</p>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs px-2 py-0.5 bg-emerald-100 text-emerald-700 font-bold rounded-full">52% crowd</span>
                                    <span class="text-xs px-2 py-0.5 bg-yellow-100 text-yellow-700 font-bold rounded-full">28°C</span>
                                </div>
                            </div>
                        </div>
                    </button>

                    {{-- Dufan --}}
                    <button onclick="selectMonitorDest('dufan')"
                        class="mon-dest-btn w-full text-left rounded-2xl border-2 border-transparent bg-white shadow-md hover:shadow-lg hover:border-blue-400 transition-all duration-300 p-4 group"
                        data-dest="dufan">
                        <div class="flex gap-3 items-start">
                            <img src="https://images.unsplash.com/photo-1540932239986-310128078ceb?w=80&h=80&fit=crop" alt="Dufan"
                                class="w-16 h-16 object-cover rounded-xl flex-shrink-0 group-hover:scale-105 transition-transform"/>
                            <div>
                                <h3 class="font-black text-slate-900 text-sm">Dufan Ancol</h3>
                                <p class="text-xs text-slate-500 mb-1">Jakarta Utara</p>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs px-2 py-0.5 bg-red-100 text-red-700 font-bold rounded-full">85% crowd</span>
                                    <span class="text-xs px-2 py-0.5 bg-yellow-100 text-yellow-700 font-bold rounded-full">30°C</span>
                                </div>
                            </div>
                        </div>
                    </button>

                    {{-- Monas --}}
                    <button onclick="selectMonitorDest('monas')"
                        class="mon-dest-btn w-full text-left rounded-2xl border-2 border-transparent bg-white shadow-md hover:shadow-lg hover:border-blue-400 transition-all duration-300 p-4 group"
                        data-dest="monas">
                        <div class="flex gap-3 items-start">
                            <img src="https://images.unsplash.com/photo-1512207736139-e8c07a4b0a8e?w=80&h=80&fit=crop" alt="Monas"
                                class="w-16 h-16 object-cover rounded-xl flex-shrink-0 group-hover:scale-105 transition-transform"/>
                            <div>
                                <h3 class="font-black text-slate-900 text-sm">Monumen Nasional</h3>
                                <p class="text-xs text-slate-500 mb-1">Jakarta Pusat</p>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs px-2 py-0.5 bg-yellow-100 text-yellow-700 font-bold rounded-full">61% crowd</span>
                                    <span class="text-xs px-2 py-0.5 bg-blue-100 text-blue-700 font-bold rounded-full">26°C</span>
                                </div>
                            </div>
                        </div>
                    </button>

                    {{-- TMII --}}
                    <button onclick="selectMonitorDest('tmii')"
                        class="mon-dest-btn w-full text-left rounded-2xl border-2 border-transparent bg-white shadow-md hover:shadow-lg hover:border-blue-400 transition-all duration-300 p-4 group"
                        data-dest="tmii">
                        <div class="flex gap-3 items-start">
                            <img src="https://images.unsplash.com/photo-1555400038-63f5ba517a47?w=80&h=80&fit=crop" alt="TMII"
                                class="w-16 h-16 object-cover rounded-xl flex-shrink-0 group-hover:scale-105 transition-transform"/>
                            <div>
                                <h3 class="font-black text-slate-900 text-sm">Taman Mini Indonesia</h3>
                                <p class="text-xs text-slate-500 mb-1">Jakarta Timur</p>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs px-2 py-0.5 bg-emerald-100 text-emerald-700 font-bold rounded-full">38% crowd</span>
                                    <span class="text-xs px-2 py-0.5 bg-emerald-100 text-emerald-700 font-bold rounded-full">27°C</span>
                                </div>
                            </div>
                        </div>
                    </button>

                    {{-- Ancol --}}
                    <button onclick="selectMonitorDest('ancol')"
                        class="mon-dest-btn w-full text-left rounded-2xl border-2 border-transparent bg-white shadow-md hover:shadow-lg hover:border-blue-400 transition-all duration-300 p-4 group"
                        data-dest="ancol">
                        <div class="flex gap-3 items-start">
                            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=80&h=80&fit=crop" alt="Ancol"
                                class="w-16 h-16 object-cover rounded-xl flex-shrink-0 group-hover:scale-105 transition-transform"/>
                            <div>
                                <h3 class="font-black text-slate-900 text-sm">Ancol Waterfront</h3>
                                <p class="text-xs text-slate-500 mb-1">Jakarta Utara</p>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs px-2 py-0.5 bg-emerald-100 text-emerald-700 font-bold rounded-full">44% crowd</span>
                                    <span class="text-xs px-2 py-0.5 bg-yellow-100 text-yellow-700 font-bold rounded-full">29°C</span>
                                </div>
                            </div>
                        </div>
                    </button>

                </div>

                {{-- CTA to Street View --}}
                <a href="{{ url('/street-view') }}"
                   class="flex items-center justify-center gap-2 w-full mt-2 px-4 py-3 bg-slate-900 text-white font-bold text-sm rounded-2xl hover:bg-slate-800 transition-colors shadow-lg">
                    <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M4 6h7a2 2 0 012 2v8a2 2 0 01-2 2H4V6z"/>
                    </svg>
                    Buka Street View 360°
                </a>
            </aside>

            {{-- ── RIGHT: Monitor Dashboard ─────────────────────── --}}
            <main class="lg:col-span-9 space-y-6">

                {{-- Destination Header --}}
                <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <h2 id="mon-dest-name" class="text-2xl font-black text-slate-900">Kota Tua Jakarta</h2>
                                <span id="mon-status-badge" class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-100 text-green-700 text-xs font-black rounded-full">
                                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                    BUKA
                                </span>
                            </div>
                            <p id="mon-dest-location" class="text-sm text-slate-500">Jakarta Barat, DKI Jakarta</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <a id="mon-street-view-link" href="{{ url('/street-view') }}"
                               class="flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-bold rounded-xl transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                Street View
                            </a>
                            <div id="mon-last-updated" class="text-xs text-slate-400 font-bold">Diperbarui: Sekarang</div>
                        </div>
                    </div>
                </div>

                {{-- ── STATIC METRICS ROW ───────────────────────── --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="mon-metrics-row">
                    {{-- Suhu --}}
                    <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl shadow border border-yellow-200 p-5 text-center">
                        <p class="text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Suhu</p>
                        <p id="mon-temp" class="text-4xl font-black text-yellow-600">28°C</p>
                        <p class="text-xs text-slate-500 mt-1">Terasa 26°C</p>
                    </div>
                    {{-- Kelembaban --}}
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl shadow border border-blue-200 p-5 text-center">
                        <p class="text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Kelembaban</p>
                        <p id="mon-humidity" class="text-4xl font-black text-blue-600">65%</p>
                        <p class="text-xs text-slate-500 mt-1">Sedang</p>
                    </div>
                    {{-- Keramaian --}}
                    <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl shadow border border-emerald-200 p-5 text-center">
                        <p class="text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Crowd Level</p>
                        <p id="mon-crowd-pct" class="text-4xl font-black text-emerald-600">52%</p>
                        <p id="mon-crowd-label" class="text-xs font-bold text-emerald-700 mt-1">Sedang</p>
                    </div>
                    {{-- UV Index --}}
                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl shadow border border-indigo-200 p-5 text-center">
                        <p class="text-xs font-black text-slate-500 uppercase tracking-widest mb-2">UV Index</p>
                        <p id="mon-uv" class="text-4xl font-black text-indigo-600">5</p>
                        <p class="text-xs text-slate-500 mt-1">/10 Sedang</p>
                    </div>
                </div>

                {{-- ── CROWD BAR ─────────────────────────────────── --}}
                <div class="bg-white rounded-2xl shadow border border-slate-100 p-6">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-black text-slate-900">Kepadatan Saat Ini</h3>
                        <span id="mon-crowd-desc" class="text-sm font-bold text-slate-600">2,450 pengunjung · 45% kapasitas</span>
                    </div>
                    <div class="w-full h-5 bg-slate-200 rounded-full overflow-hidden mb-2">
                        <div id="mon-crowd-bar" class="h-full bg-gradient-to-r from-emerald-400 to-emerald-600 rounded-full transition-all duration-700" style="width: 52%"></div>
                    </div>
                    <div class="flex justify-between text-xs font-bold text-slate-500 mt-1">
                        <span>Sepi</span>
                        <span>Optimal</span>
                        <span>Ramai</span>
                        <span>Penuh</span>
                    </div>
                </div>

                {{-- ── AI ANALYSIS PANEL (Video Upload) ──────────── --}}
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

                    {{-- Upload Panel --}}
                    <div class="lg:col-span-2 bg-white rounded-2xl shadow border border-slate-100 p-6">
                        <h3 class="font-black text-slate-900 mb-1 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                            Analisis AI — Upload Video
                        </h3>
                        <p class="text-xs text-slate-500 mb-4">Upload video destinasi untuk analisis keramaian & cuaca via YOLO + MobileNet</p>

                        {{-- Drag & Drop Zone --}}
                        <div id="drop-zone"
                             class="relative border-2 border-dashed border-slate-300 hover:border-blue-400 rounded-xl p-6 text-center cursor-pointer transition-colors duration-200 mb-4 bg-slate-50 hover:bg-blue-50"
                             onclick="document.getElementById('mon-video-input').click()"
                             ondragover="event.preventDefault(); this.classList.add('border-blue-400','bg-blue-50')"
                             ondragleave="this.classList.remove('border-blue-400','bg-blue-50')"
                             ondrop="handleDrop(event)">
                            <svg class="w-10 h-10 mx-auto text-slate-400 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <p class="text-sm font-bold text-slate-700">Drag & drop video ke sini</p>
                            <p class="text-xs text-slate-500 mt-1">atau klik untuk memilih file</p>
                            <p class="text-xs text-slate-400 mt-2">.mp4 · .avi · .mov · .mkv · .webm — Maks 500 MB</p>
                        </div>

                        <input id="mon-video-input" type="file" accept="video/*" class="hidden" onchange="handleFileSelect(event)" />

                        {{-- File info --}}
                        <div id="mon-file-info" class="hidden mb-4 flex items-center gap-3 p-3 bg-emerald-50 border border-emerald-200 rounded-xl">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <div class="min-w-0">
                                <p id="mon-file-name" class="text-sm font-bold text-emerald-900 truncate"></p>
                                <p id="mon-file-size" class="text-xs text-emerald-700"></p>
                            </div>
                        </div>

                        {{-- OR source URL --}}
                        <div class="mb-4">
                            <label class="text-xs font-black text-slate-500 uppercase tracking-widest block mb-2">Atau URL / RTSP / Path</label>
                            <input id="mon-video-source" type="text" placeholder="Contoh: 0 · rtsp://... · D:\video\test.mp4"
                                class="w-full px-3 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"/>
                        </div>

                        {{-- Destination label for analysis --}}
                        <div class="mb-4">
                            <label class="text-xs font-black text-slate-500 uppercase tracking-widest block mb-2">Destinasi Analisis</label>
                            <input id="mon-analysis-dest" type="text" readonly
                                class="w-full px-3 py-2.5 border border-slate-200 bg-slate-50 rounded-xl text-sm font-bold text-slate-700"/>
                        </div>

                        <button id="mon-analyze-btn" onclick="runAnalysis()" type="button"
                            class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-blue-600 hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed text-white font-black rounded-xl transition-colors">
                            <svg id="mon-btn-icon" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/></svg>
                            <svg id="mon-btn-spinner" class="w-5 h-5 animate-spin hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                            <span id="mon-btn-text">Jalankan Analisis AI</span>
                        </button>

                        <div id="mon-error" class="hidden mt-3 p-3 bg-red-50 border border-red-200 rounded-xl text-xs text-red-700 font-semibold"></div>

                        {{-- Requirements note --}}
                        <div class="mt-4 p-3 bg-amber-50 border border-amber-200 rounded-xl text-xs text-amber-800">
                            <p class="font-black mb-1">Persiapan environment:</p>
                            <code class="block bg-amber-100 rounded p-1.5 mt-1 text-amber-900">pip install opencv-python ultralytics torch torchvision pillow</code>
                            <p class="mt-2">Jalankan <code class="bg-amber-100 px-1 rounded">php artisan storage:link</code> agar output video bisa diputar.</p>
                        </div>
                    </div>

                    {{-- Results Panel --}}
                    <div class="lg:col-span-3 bg-white rounded-2xl shadow border border-slate-100 p-6">
                        <h3 class="font-black text-slate-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            Hasil Analisis AI
                        </h3>

                        {{-- Default state (demo data) --}}
                        <div id="mon-results-default">
                            {{-- Recommendation banner --}}
                            <div id="mon-rec-banner" class="mb-4 flex items-start gap-3 p-4 bg-emerald-50 border border-emerald-200 rounded-xl">
                                <span class="text-xl">💡</span>
                                <div>
                                    <p class="font-black text-emerald-900 text-sm" id="mon-rec-text">Kondisi Ideal untuk Berkunjung</p>
                                    <p class="text-xs text-emerald-700 mt-0.5" id="mon-rec-sub">Keramaian sedang, cuaca cerah berawan. Waktu terbaik: pagi hari.</p>
                                </div>
                            </div>

                            {{-- Stats grid --}}
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                    <p class="text-xs font-black text-slate-500 uppercase tracking-widest mb-1">Kondisi Cuaca</p>
                                    <p id="mon-weather-label" class="text-lg font-black text-slate-900">⛅ Cerah Berawan</p>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                    <p class="text-xs font-black text-slate-500 uppercase tracking-widest mb-1">Tingkat Keramaian</p>
                                    <p id="mon-crowd-result" class="text-lg font-black text-slate-900">🟡 Sedang</p>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                    <p class="text-xs font-black text-slate-500 uppercase tracking-widest mb-1">Rata-rata Pengunjung</p>
                                    <p id="mon-avg-person" class="text-lg font-black text-slate-900">48 orang</p>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                    <p class="text-xs font-black text-slate-500 uppercase tracking-widest mb-1">Puncak Pengunjung</p>
                                    <p id="mon-max-person" class="text-lg font-black text-slate-900">120 orang</p>
                                </div>
                            </div>

                            {{-- Video output area --}}
                            <div id="mon-video-area" class="hidden">
                                <p class="text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Video Output (Annotated)</p>
                                <video id="mon-output-video" controls class="w-full rounded-xl border border-slate-200 bg-slate-900" style="min-height: 200px;"></video>
                            </div>

                            {{-- Weather distribution --}}
                            <div id="mon-weather-dist" class="hidden mt-4">
                                <p class="text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Distribusi Cuaca per Frame</p>
                                <div id="mon-weather-dist-content" class="flex flex-wrap gap-2"></div>
                            </div>

                            {{-- Placeholder state --}}
                            <div id="mon-placeholder" class="flex flex-col items-center justify-center py-12 text-center">
                                <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-2xl flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                                    </svg>
                                </div>
                                <h4 class="font-black text-slate-700 mb-2">Belum Ada Analisis</h4>
                                <p class="text-sm text-slate-500 max-w-xs">Upload video atau isi source URL di panel kiri, kemudian klik "Jalankan Analisis AI" untuk melihat hasil deteksi keramaian dan cuaca.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ── HOURLY CROWD PREDICTION ──────────────────── --}}
                <div class="bg-white rounded-2xl shadow border border-slate-100 p-6">
                    <h3 class="font-black text-slate-900 mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-cyan-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                        Prediksi Keramaian Per Jam
                    </h3>
                    <div id="mon-hourly-grid" class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-8 gap-3">
                        {{-- Filled by JS --}}
                    </div>
                </div>

                {{-- ── AI RECOMMENDATIONS ───────────────────────── --}}
                <div class="bg-gradient-to-br from-slate-900 to-blue-900 rounded-2xl p-6 border border-blue-500/20">
                    <h3 class="text-white font-black mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-cyan-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-13c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z"/></svg>
                        Rekomendasi AI
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="mon-ai-recs">
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

    .mon-dest-btn.active {
        border-color: #3b82f6;
        background: linear-gradient(135deg, #eff6ff, #ecfeff);
        box-shadow: 0 4px 20px rgba(59,130,246,0.15);
    }
</style>

@push('scripts')
<script>
const monDestinations = {
    kotaTua: {
        name: 'Kota Tua Jakarta',
        location: 'Jakarta Barat, DKI Jakarta',
        temp: '28°C', humidity: '65%', uv: '5', crowd: 52,
        visitors: '2,450', capacity: '45%',
        crowdLabel: 'Sedang', crowdColor: 'from-emerald-400 to-emerald-600',
        weather: '⛅ Cerah Berawan',
        rec: 'Kondisi Ideal untuk Berkunjung',
        recSub: 'Keramaian sedang, cuaca cerah berawan. Waktu terbaik: pagi hari.',
        recBannerClass: 'bg-emerald-50 border-emerald-200',
        recTextClass: 'text-emerald-900', recSubClass: 'text-emerald-700',
        avgPerson: '48 orang', maxPerson: '120 orang',
        optimalTime: '09:00 – 11:00', waitTime: '~5-10 menit',
        clothes: 'Bawa payung & sunscreen', duration: '2-3 jam',
        hourly: [
            { h: '08:00', v: 1200, pct: 30, color: 'bg-cyan-400' },
            { h: '09:00', v: 1600, pct: 40, color: 'bg-cyan-500' },
            { h: '10:00', v: 1800, pct: 45, color: 'bg-emerald-400' },
            { h: '11:00', v: 2100, pct: 52, color: 'bg-emerald-500' },
            { h: '12:00', v: 2450, pct: 62, color: 'bg-yellow-500' },
            { h: '13:00', v: 2800, pct: 70, color: 'bg-orange-400' },
            { h: '14:00', v: 3100, pct: 78, color: 'bg-orange-500' },
            { h: '15:00', v: 2600, pct: 65, color: 'bg-yellow-400' },
        ],
    },
    dufan: {
        name: 'Dufan Ancol',
        location: 'Jakarta Utara, DKI Jakarta',
        temp: '30°C', humidity: '72%', uv: '8', crowd: 85,
        visitors: '4,200', capacity: '85%',
        crowdLabel: 'Sangat Ramai', crowdColor: 'from-red-400 to-red-600',
        weather: '☀️ Cerah',
        rec: 'Pertimbangkan Datang Nanti',
        recSub: 'Keramaian sangat tinggi. Disarankan datang setelah pukul 15:00.',
        recBannerClass: 'bg-orange-50 border-orange-200',
        recTextClass: 'text-orange-900', recSubClass: 'text-orange-700',
        avgPerson: '215 orang', maxPerson: '380 orang',
        optimalTime: '15:00 – 17:00', waitTime: '~25-40 menit',
        clothes: 'Topi, kacamata & sepatu nyaman', duration: '4-5 jam',
        hourly: [
            { h: '08:00', v: 2000, pct: 40, color: 'bg-cyan-400' },
            { h: '09:00', v: 2800, pct: 56, color: 'bg-yellow-400' },
            { h: '10:00', v: 3400, pct: 68, color: 'bg-orange-400' },
            { h: '11:00', v: 4000, pct: 80, color: 'bg-red-400' },
            { h: '12:00', v: 4200, pct: 85, color: 'bg-red-500' },
            { h: '13:00', v: 4500, pct: 90, color: 'bg-red-600' },
            { h: '14:00', v: 4300, pct: 86, color: 'bg-red-500' },
            { h: '15:00', v: 3600, pct: 72, color: 'bg-orange-400' },
        ],
    },
    monas: {
        name: 'Monumen Nasional',
        location: 'Jakarta Pusat, DKI Jakarta',
        temp: '26°C', humidity: '58%', uv: '6', crowd: 61,
        visitors: '3,050', capacity: '61%',
        crowdLabel: 'Ramai', crowdColor: 'from-yellow-400 to-orange-500',
        weather: '🌤️ Cerah Berawan',
        rec: 'Siap untuk Dikunjungi',
        recSub: 'Keramaian dalam batas wajar. Bawa air minum yang cukup.',
        recBannerClass: 'bg-blue-50 border-blue-200',
        recTextClass: 'text-blue-900', recSubClass: 'text-blue-700',
        avgPerson: '90 orang', maxPerson: '200 orang',
        optimalTime: '08:00 – 10:00', waitTime: '~10-15 menit',
        clothes: 'Pakaian kasual & alas kaki nyaman', duration: '1-2 jam',
        hourly: [
            { h: '08:00', v: 1500, pct: 30, color: 'bg-cyan-400' },
            { h: '09:00', v: 2000, pct: 40, color: 'bg-emerald-400' },
            { h: '10:00', v: 2500, pct: 50, color: 'bg-yellow-400' },
            { h: '11:00', v: 3050, pct: 61, color: 'bg-yellow-500' },
            { h: '12:00', v: 3200, pct: 65, color: 'bg-orange-400' },
            { h: '13:00', v: 3400, pct: 68, color: 'bg-orange-500' },
            { h: '14:00', v: 3100, pct: 62, color: 'bg-yellow-500' },
            { h: '15:00', v: 2700, pct: 55, color: 'bg-yellow-400' },
        ],
    },
    tmii: {
        name: 'Taman Mini Indonesia Indah',
        location: 'Jakarta Timur, DKI Jakarta',
        temp: '27°C', humidity: '60%', uv: '4', crowd: 38,
        visitors: '1,900', capacity: '38%',
        crowdLabel: 'Sepi', crowdColor: 'from-emerald-300 to-emerald-500',
        weather: '⛅ Cerah Berawan',
        rec: 'Kondisi Ideal untuk Berkunjung',
        recSub: 'Keramaian rendah, cuaca nyaman. Waktu sempurna untuk jelajah!',
        recBannerClass: 'bg-emerald-50 border-emerald-200',
        recTextClass: 'text-emerald-900', recSubClass: 'text-emerald-700',
        avgPerson: '35 orang', maxPerson: '80 orang',
        optimalTime: 'Sepanjang hari', waitTime: 'Hampir tidak ada antrian',
        clothes: 'Pakaian santai & sepatu jalan', duration: '3-5 jam',
        hourly: [
            { h: '08:00', v: 800, pct: 16, color: 'bg-emerald-300' },
            { h: '09:00', v: 1200, pct: 24, color: 'bg-emerald-400' },
            { h: '10:00', v: 1600, pct: 32, color: 'bg-emerald-400' },
            { h: '11:00', v: 1900, pct: 38, color: 'bg-emerald-500' },
            { h: '12:00', v: 2100, pct: 42, color: 'bg-yellow-400' },
            { h: '13:00', v: 2300, pct: 46, color: 'bg-yellow-400' },
            { h: '14:00', v: 2100, pct: 42, color: 'bg-yellow-400' },
            { h: '15:00', v: 1800, pct: 36, color: 'bg-emerald-400' },
        ],
    },
    ancol: {
        name: 'Ancol Waterfront',
        location: 'Jakarta Utara, DKI Jakarta',
        temp: '29°C', humidity: '70%', uv: '6', crowd: 44,
        visitors: '2,200', capacity: '44%',
        crowdLabel: 'Sedang', crowdColor: 'from-emerald-400 to-teal-500',
        weather: '☀️ Cerah',
        rec: 'Kondisi Ideal untuk Berkunjung',
        recSub: 'Pantai ramai namun masih nyaman. Nikmati sunset di sore hari.',
        recBannerClass: 'bg-emerald-50 border-emerald-200',
        recTextClass: 'text-emerald-900', recSubClass: 'text-emerald-700',
        avgPerson: '60 orang', maxPerson: '150 orang',
        optimalTime: '16:00 – 18:00', waitTime: '~5-10 menit',
        clothes: 'Baju ringan, sandal & kacamata hitam', duration: '2-4 jam',
        hourly: [
            { h: '08:00', v: 900, pct: 18, color: 'bg-cyan-300' },
            { h: '09:00', v: 1400, pct: 28, color: 'bg-cyan-400' },
            { h: '10:00', v: 1800, pct: 36, color: 'bg-emerald-400' },
            { h: '11:00', v: 2200, pct: 44, color: 'bg-emerald-500' },
            { h: '12:00', v: 2500, pct: 50, color: 'bg-yellow-400' },
            { h: '13:00', v: 2800, pct: 56, color: 'bg-yellow-500' },
            { h: '14:00', v: 3000, pct: 60, color: 'bg-yellow-500' },
            { h: '15:00', v: 3200, pct: 64, color: 'bg-orange-400' },
        ],
    },
};

let currentMonDest = 'kotaTua';
let selectedFile = null;

function selectMonitorDest(id) {
    const dest = monDestinations[id];
    if (!dest) return;
    currentMonDest = id;

    // Sidebar active state
    document.querySelectorAll('.mon-dest-btn').forEach(btn => {
        btn.classList.toggle('active', btn.dataset.dest === id);
    });

    // Header
    document.getElementById('mon-dest-name').textContent = dest.name;
    document.getElementById('mon-dest-location').textContent = dest.location;

    // Metrics
    document.getElementById('mon-temp').textContent = dest.temp;
    document.getElementById('mon-humidity').textContent = dest.humidity;
    document.getElementById('mon-uv').textContent = dest.uv;
    document.getElementById('mon-crowd-pct').textContent = dest.crowd + '%';
    document.getElementById('mon-crowd-label').textContent = dest.crowdLabel;

    // Crowd bar
    const crowdBar = document.getElementById('mon-crowd-bar');
    crowdBar.style.width = dest.crowd + '%';
    crowdBar.className = `h-full bg-gradient-to-r ${dest.crowdColor} rounded-full transition-all duration-700`;
    document.getElementById('mon-crowd-desc').textContent = `${dest.visitors} pengunjung · ${dest.capacity} kapasitas`;

    // Results panel
    const recBanner = document.getElementById('mon-rec-banner');
    recBanner.className = `mb-4 flex items-start gap-3 p-4 border rounded-xl ${dest.recBannerClass}`;
    document.getElementById('mon-rec-text').textContent = dest.rec;
    document.getElementById('mon-rec-text').className = `font-black text-sm ${dest.recTextClass}`;
    document.getElementById('mon-rec-sub').textContent = dest.recSub;
    document.getElementById('mon-rec-sub').className = `text-xs mt-0.5 ${dest.recSubClass}`;
    document.getElementById('mon-weather-label').textContent = dest.weather;
    document.getElementById('mon-crowd-result').textContent = crowdIconLabel(dest.crowdLabel);
    document.getElementById('mon-avg-person').textContent = dest.avgPerson;
    document.getElementById('mon-max-person').textContent = dest.maxPerson;

    // Analysis destination label
    document.getElementById('mon-analysis-dest').value = dest.name;

    // Last updated
    document.getElementById('mon-last-updated').textContent = 'Diperbarui: ' + new Date().toLocaleTimeString('id-ID', {hour:'2-digit', minute:'2-digit'});

    // Hourly chart
    renderHourlyChart(dest.hourly);

    // AI Recs
    renderAIRecs(dest);
}

function crowdIconLabel(label) {
    const map = { 'Sepi': '🟢 Sepi', 'Sedang': '🟡 Sedang', 'Ramai': '🟠 Ramai', 'Sangat Ramai': '🔴 Sangat Ramai' };
    return map[label] || '⚪ ' + label;
}

function renderHourlyChart(hourly) {
    const grid = document.getElementById('mon-hourly-grid');
    grid.innerHTML = '';
    hourly.forEach(h => {
        const el = document.createElement('div');
        el.className = 'bg-slate-50 rounded-xl p-3 border border-slate-100 text-center';
        el.innerHTML = `
            <p class="text-xs font-black text-slate-500 mb-1">${h.h}</p>
            <p class="text-base font-black text-slate-900">${(h.v/1000).toFixed(1)}K</p>
            <div class="h-1.5 bg-slate-200 rounded-full mt-1.5 overflow-hidden">
                <div class="h-full ${h.color} rounded-full" style="width:${h.pct}%"></div>
            </div>
            <p class="text-xs text-slate-500 mt-1">${h.pct}%</p>`;
        grid.appendChild(el);
    });
}

function renderAIRecs(dest) {
    const container = document.getElementById('mon-ai-recs');
    const recs = [
        { icon: '⏰', label: 'Waktu Kunjung Optimal', value: dest.optimalTime },
        { icon: '⏱️', label: 'Estimasi Antrian', value: dest.waitTime },
        { icon: '👔', label: 'Persiapan Pakaian', value: dest.clothes },
        { icon: '💡', label: 'Durasi Kunjungan', value: dest.duration },
    ];
    container.innerHTML = '';
    recs.forEach(r => {
        const el = document.createElement('div');
        el.className = 'bg-white/10 rounded-xl p-4';
        el.innerHTML = `
            <div class="text-2xl mb-2">${r.icon}</div>
            <p class="text-white text-xs font-black uppercase tracking-widest mb-1">${r.label}</p>
            <p class="text-slate-300 text-sm font-semibold">${r.value}</p>`;
        container.appendChild(el);
    });
}

// ── Video Upload Handling ─────────────────────────────────
function handleFileSelect(event) {
    const file = event.target.files[0];
    if (file) setFile(file);
}

function handleDrop(event) {
    event.preventDefault();
    document.getElementById('drop-zone').classList.remove('border-blue-400', 'bg-blue-50');
    const file = event.dataTransfer.files[0];
    if (file && file.type.startsWith('video/')) setFile(file);
}

function setFile(file) {
    const MAX = 500 * 1024 * 1024;
    if (file.size > MAX) {
        showError('File terlalu besar (maks 500 MB). Pilih file yang lebih kecil.');
        return;
    }
    selectedFile = file;
    const sizeMB = (file.size / (1024 * 1024)).toFixed(2);
    document.getElementById('mon-file-name').textContent = file.name;
    document.getElementById('mon-file-size').textContent = `${sizeMB} MB`;
    document.getElementById('mon-file-info').classList.remove('hidden');
    document.getElementById('mon-file-info').classList.add('flex');
    hideError();
}

function showError(msg) {
    const el = document.getElementById('mon-error');
    el.textContent = msg;
    el.classList.remove('hidden');
}

function hideError() {
    document.getElementById('mon-error').classList.add('hidden');
}

async function runAnalysis() {
    const source = document.getElementById('mon-video-source').value.trim();
    if (!selectedFile && !source) {
        showError('Pilih file video atau isi URL/path source terlebih dahulu.');
        return;
    }

    hideError();

    // Toggle button loading
    document.getElementById('mon-analyze-btn').disabled = true;
    document.getElementById('mon-btn-icon').classList.add('hidden');
    document.getElementById('mon-btn-spinner').classList.remove('hidden');
    document.getElementById('mon-btn-text').textContent = 'Menganalisis...';

    // Hide placeholder
    document.getElementById('mon-placeholder').classList.add('hidden');

    try {
        const formData = new FormData();

        // Add CSRF
        const tokenMeta = document.querySelector('meta[name="csrf-token"]');
        if (tokenMeta) formData.append('_token', tokenMeta.content);

        if (selectedFile) formData.append('video_file', selectedFile);
        if (source) formData.append('video_source', source);

        const response = await fetch('{{ route("akbar.ai-monitor.analyze") }}', {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        });

        if (response.ok) {
            const data = await response.json().catch(() => null);

            if (data && data.crowd_level) {
                // Real API response
                applyAnalysisResult(data);
            } else {
                // Simulate result with current destination mock data
                simulateAnalysisResult();
            }
        } else {
            // Simulate result on non-ok (likely non-JSON or different route setup)
            simulateAnalysisResult();
        }
    } catch (e) {
        // Simulate result as fallback (demo mode)
        simulateAnalysisResult();
    } finally {
        document.getElementById('mon-analyze-btn').disabled = false;
        document.getElementById('mon-btn-icon').classList.remove('hidden');
        document.getElementById('mon-btn-spinner').classList.add('hidden');
        document.getElementById('mon-btn-text').textContent = 'Jalankan Analisis AI';
    }
}

function simulateAnalysisResult() {
    // Use mock data from selected destination + simulate video analysis
    const dest = monDestinations[currentMonDest];
    const mockResult = {
        crowd_level: dest.crowdLabel,
        dominant_weather_label: dest.weather.replace(/[^\w\s]/gu, '').trim(),
        visit_recommendation: dest.rec,
        avg_person_count: parseInt(dest.avgPerson),
        max_person_count: parseInt(dest.maxPerson),
        frames_processed: Math.floor(Math.random() * 200) + 100,
        weather_distribution: {
            [dest.weather.replace(/[^\w\s]/gu, '').trim()]: Math.floor(Math.random() * 50) + 80,
            'Lainnya': Math.floor(Math.random() * 20) + 5,
        }
    };

    applyAnalysisResult(mockResult);

    // Show demo notification
    const notice = document.createElement('div');
    notice.className = 'mt-3 p-3 bg-cyan-50 border border-cyan-200 rounded-xl text-xs text-cyan-800 font-semibold';
    notice.innerHTML = '🔬 <strong>Demo Mode</strong>: Hasil simulasi berdasarkan data destinasi. Untuk analisis nyata, pastikan Python backend aktif.';
    const results = document.getElementById('mon-results-default');
    const existing = results.querySelector('.demo-notice');
    if (existing) existing.remove();
    notice.classList.add('demo-notice');
    results.appendChild(notice);
}

function applyAnalysisResult(data) {
    const crowdIcon = { 'Sepi':'🟢', 'Sedang':'🟡', 'Ramai':'🟠', 'Sangat Ramai':'🔴' };
    const weatherIconMap = (w) => {
        if (w.includes('Cerah Berawan')) return '⛅';
        if (w.includes('Cerah')) return '☀️';
        if (w.includes('Berawan') || w.includes('Mendung')) return '☁️';
        if (w.includes('Hujan') || w.includes('Kabut')) return '🌧️';
        if (w.includes('Malam')) return '🌙';
        return '🌤️';
    };

    const weather = data.dominant_weather_label || '-';
    const crowd = data.crowd_level || '-';
    const icon = crowdIcon[crowd] || '⚪';
    const wIcon = weatherIconMap(weather);

    document.getElementById('mon-weather-label').textContent = `${wIcon} ${weather}`;
    document.getElementById('mon-crowd-result').textContent = `${icon} ${crowd}`;
    document.getElementById('mon-avg-person').textContent = (data.avg_person_count ?? '-') + ' orang';
    document.getElementById('mon-max-person').textContent = (data.max_person_count ?? '-') + ' orang';

    // Recommendation
    if (data.visit_recommendation) {
        document.getElementById('mon-rec-text').textContent = data.visit_recommendation;
        document.getElementById('mon-rec-sub').textContent = `Dianalisis dari ${data.frames_processed ?? '-'} frame video.`;
    }

    // Weather distribution
    if (data.weather_distribution && Object.keys(data.weather_distribution).length > 0) {
        const container = document.getElementById('mon-weather-dist-content');
        container.innerHTML = '';
        Object.entries(data.weather_distribution).forEach(([label, count]) => {
            const badge = document.createElement('span');
            badge.className = 'px-2 py-1 bg-slate-100 border border-slate-200 rounded-full text-xs font-bold text-slate-700';
            badge.textContent = `${label}: ${count}x`;
            container.appendChild(badge);
        });
        document.getElementById('mon-weather-dist').classList.remove('hidden');
    }

    // Update crowd metrics row
    document.getElementById('mon-crowd-pct').textContent = monDestinations[currentMonDest].crowd + '%';
    document.getElementById('mon-crowd-label').textContent = crowd;
    document.getElementById('mon-last-updated').textContent = 'Dianalisis: ' + new Date().toLocaleTimeString('id-ID', {hour:'2-digit', minute:'2-digit'});
}

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    // Add CSRF meta if not present
    if (!document.querySelector('meta[name="csrf-token"]')) {
        const meta = document.createElement('meta');
        meta.name = 'csrf-token';
        meta.content = '{{ csrf_token() }}';
        document.head.appendChild(meta);
    }
    selectMonitorDest('kotaTua');
});
</script>
@endpush

@endsection
