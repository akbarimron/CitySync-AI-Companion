@extends('layouts.app')

@section('title', 'Detail Destinasi - CitySync AI')

@section('content')

<!-- ==================== HERO SECTION ==================== -->
<section class="relative min-h-[55vh] md:min-h-[60vh] overflow-hidden bg-gradient-to-br from-slate-900 via-cyan-900 to-emerald-900">
    <div class="absolute top-20 left-10 w-96 h-96 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
    <div class="absolute top-40 right-10 w-96 h-96 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-20 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 flex flex-col justify-end min-h-[55vh] md:min-h-[60vh]">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-cyan-300 mb-6">
            <a href="{{ url('/') }}" class="hover:text-white transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ url('/destinations') }}" class="hover:text-white transition-colors">Destinasi</a>
            <span>/</span>
            <span id="hero-breadcrumb" class="text-white font-semibold">Kota Tua Jakarta</span>
        </nav>

        <h1 id="dest-name" class="text-4xl sm:text-5xl lg:text-6xl font-black text-white mb-4 leading-tight">
            Kota Tua Jakarta
        </h1>
        <p id="dest-description" class="text-lg sm:text-xl text-slate-200 mb-8 max-w-2xl">
            Jelajahi warisan sejarah Jakarta melalui arsitektur kolonial Belanda yang megah dan menawan.
        </p>

        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
            <div class="flex flex-wrap gap-3 items-center">
                <div class="flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white text-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                    <span id="dest-location">Jakarta Utara</span>
                </div>
                <div class="flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white text-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <span id="dest-rating">4.5 / 5.0</span>
                </div>
                <div id="crowd-badge" class="px-4 py-2 bg-emerald-500/90 text-white rounded-full font-bold text-sm">
                    👥 Kapasitas: 45%
                </div>
            <button onclick="switchTab('booking')" class="px-6 py-2.5 bg-cyan-500 hover:bg-cyan-600 text-white rounded-full font-bold transition-colors shadow-lg shadow-cyan-500/30">
                🎟️ Pesan Tiket
            </button>
        </div>
</section>

<!-- ==================== MAIN CONTENT ==================== -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- TABS NAVIGATION -->
    <div class="mb-10">
        <div class="flex flex-wrap gap-1 border-b border-slate-200">
            <button onclick="switchTab('overview')" class="tab-btn active px-5 py-3 font-bold text-base border-b-4 border-cyan-500 text-cyan-600 whitespace-nowrap transition-all hover:bg-cyan-50 rounded-t-lg">
                📋 Overview
            </button>
            <button onclick="switchTab('street-view')" class="tab-btn px-5 py-3 font-bold text-base border-b-4 border-transparent text-slate-500 whitespace-nowrap transition-all hover:bg-cyan-50 rounded-t-lg hover:text-cyan-600">
                🌐 Street View 360°
            </button>
            <button onclick="switchTab('ai-monitor')" class="tab-btn px-5 py-3 font-bold text-base border-b-4 border-transparent text-slate-500 whitespace-nowrap transition-all hover:bg-cyan-50 rounded-t-lg hover:text-cyan-600">
                🤖 AI Monitor
            </button>
            <button onclick="switchTab('booking')" class="tab-btn px-5 py-3 font-bold text-base border-b-4 border-transparent text-slate-500 whitespace-nowrap transition-all hover:bg-cyan-50 rounded-t-lg hover:text-cyan-600">
                🎟️ Booking
            </button>
        </div>

    <!-- ========== TAB: OVERVIEW ========== -->
    <div id="tab-overview" class="tab-pane">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left: Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- About -->
                <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-6 md:p-8">
                    <h2 class="text-2xl font-black text-slate-900 mb-4 pb-3 border-b border-slate-100">Tentang Destinasi</h2>
                    <p id="dest-full-description" class="text-slate-600 leading-relaxed mb-6">
                        Kota Tua Jakarta adalah jantung sejarah kota Jakarta dengan arsitektur kolonial Belanda yang megah dan terawat dengan baik.
                    </p>

                    <h3 class="text-lg font-bold text-slate-900 mb-4">✨ Fasilitas & Amenities</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        <div class="flex items-center gap-2 p-3 bg-cyan-50 rounded-lg border border-cyan-100">
                            <svg class="w-5 h-5 text-cyan-600" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v2h8v-2zM2 15a4 4 0 008 0v2H0v-2z"></path></svg>
                            <span class="text-sm font-semibold text-slate-700">Toilet Umum</span>
                        </div>
                        <div class="flex items-center gap-2 p-3 bg-emerald-50 rounded-lg border border-emerald-100">
                            <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path></svg>
                            <span class="text-sm font-semibold text-slate-700">Rest Area</span>
                        </div>
                        <div class="flex items-center gap-2 p-3 bg-blue-50 rounded-lg border border-blue-100">
                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            <span class="text-sm font-semibold text-slate-700">Cafe & Food</span>
                        </div>
                        <div class="flex items-center gap-2 p-3 bg-orange-50 rounded-lg border border-orange-100">
                            <svg class="w-5 h-5 text-orange-600" fill="currentColor" viewBox="0 0 20 20"><path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path><path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"></path></svg>
                            <span class="text-sm font-semibold text-slate-700">Parking</span>
                        </div>
                        <div class="flex items-center gap-2 p-3 bg-purple-50 rounded-lg border border-purple-100">
                            <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M17.778 8.232c-2.403-2.3-4.738-4.058-4.96-4.242a3.01 3.01 0 00-3.636 0c-.222.184-2.557 1.942-4.96 4.242-3.236 3.1-4.258 4.138-4.413 4.268a1.5 1.5 0 002.026 2.22c.146-.128 1.083-1.032 4.146-3.965 1.754-1.68 3.206-3.03 3.237-3.058a1 1 0 011.384 0c.031.028 1.483 1.378 3.237 3.058 3.063 2.933 4 3.837 4.146 3.965a1.5 1.5 0 002.026-2.22c-.155-.13-1.177-1.168-4.413-4.268z" clip-rule="evenodd"></path></svg>
                            <span class="text-sm font-semibold text-slate-700">WiFi Gratis</span>
                        </div>
                        <div class="flex items-center gap-2 p-3 bg-red-50 rounded-lg border border-red-100">
                            <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path></svg>
                            <span class="text-sm font-semibold text-slate-700">Aksesibel</span>
                        </div>
                </div>

                <!-- Gallery -->
                <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-6 md:p-8">
                    <h2 class="text-2xl font-black text-slate-900 mb-4 pb-3 border-b border-slate-100">📸 Galeri</h2>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <div class="aspect-square rounded-xl overflow-hidden bg-slate-100 cursor-pointer group">
                            <img id="gallery-1" src="https://images.unsplash.com/photo-1570129477492-45a003537e90?w=400&h=400&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" alt="Galeri 1">
                        </div>
                        <div class="aspect-square rounded-xl overflow-hidden bg-slate-100 cursor-pointer group">
                            <img id="gallery-2" src="https://images.unsplash.com/photo-1512207736139-e8c07a4b0a8e?w=400&h=400&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" alt="Galeri 2">
                        </div>
                        <div class="aspect-square rounded-xl overflow-hidden bg-slate-100 cursor-pointer group">
                            <img id="gallery-3" src="https://images.unsplash.com/photo-1540932239986-310128078ceb?w=400&h=400&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" alt="Galeri 3">
                        </div>
                        <div class="aspect-square rounded-xl overflow-hidden bg-slate-100 cursor-pointer group">
                            <img id="gallery-4" src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400&h=400&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" alt="Galeri 4">
                        </div>
                </div>

            <!-- Right: Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-gradient-to-br from-cyan-50 to-blue-50 rounded-2xl shadow-md border border-cyan-100 p-6 sticky top-24">
                    <h3 class="text-xl font-black text-slate-900 mb-5">📌 Info Singkat</h3>
                    <div class="space-y-4">
                        <div class="pb-4 border-b border-cyan-200">
                            <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider mb-1">Harga Tiket</p>
                            <p id="price-display" class="text-3xl font-black text-cyan-600">Rp 75.000</p>
                        </div>
                        <div class="pb-4 border-b border-cyan-200">
                            <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider mb-1">Jam Buka</p>
                            <p class="text-slate-800 font-bold">08:00 - 17:00 WIB</p>
                        </div>
                        <div class="pb-4 border-b border-cyan-200">
                            <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider mb-1">Hari Buka</p>
                            <p class="text-slate-800 font-bold">Setiap Hari</p>
                        </div>
                        <div class="pb-4 border-b border-cyan-200">
                            <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider mb-1">Pengunjung Hari Ini</p>
                            <p id="visitors-today" class="text-xl font-black text-emerald-600">2,450 orang</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider mb-1">Rating</p>
                            <div class="flex items-center gap-2">
                                <span class="text-yellow-400 text-xl">★★★★★</span>
                                <span id="rating-text" class="text-slate-900 font-bold">4.5/5</span>
                            </div>
                    </div>
                    <button onclick="switchTab('booking')" class="w-full mt-6 px-5 py-3 bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 text-white font-bold rounded-xl transition-all hover:scale-[1.02] shadow-lg shadow-cyan-500/20">
                        🎟️ Pesan Tiket Sekarang
                    </button>
                </div>
        </div>

    <!-- ========== TAB: STREET VIEW 360° ========== -->
    <div id="tab-street-view" class="tab-pane hidden">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Street View Viewer -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-md border border-slate-100 overflow-hidden">
                    <div class="relative aspect-video bg-slate-900">
                        <!-- Loading Overlay -->
                        <div id="sv-loading" class="absolute inset-0 z-10 flex flex-col items-center justify-center bg-slate-900 transition-opacity duration-500">
                            <div class="w-14 h-14 border-4 border-cyan-500 border-t-transparent rounded-full animate-spin mb-3"></div>
                            <p class="text-slate-300 font-bold text-sm">Memuat Street View 360°...</p>
                            <p class="text-slate-500 text-xs mt-1">Menghubungkan ke Google Maps</p>
                        </div>
                        <iframe id="sv-iframe" class="w-full h-full" style="min-height: 500px; border: none;"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.9!2d106.8065!3d-6.1344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5e92efb9acb%3A0x8196c4e08040b3e8!2sKota%20Tua%20Jakarta!5e0!3m2!1sen!2sid!4v1699000000000!5m2!1sen!2sid"
                            allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            onload="document.getElementById('sv-loading').style.opacity='0'; setTimeout(()=>document.getElementById('sv-loading').style.display='none',500);">
                        </iframe>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-2xl font-black text-slate-900">🌐 Street View 360°</h2>
                            <button onclick="toggleFullscreen()" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-bold rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                                Fullscreen
                            </button>
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed mb-4">
                            Jelajahi destinasi secara interaktif dengan Street View 360°. Anda dapat melihat kondisi nyata lokasi sebelum berkunjung.
                        </p>
                        <h3 class="text-sm font-bold text-slate-900 mb-3">💡 Cara Navigasi:</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <div class="bg-slate-50 rounded-lg p-3 text-center border border-slate-100">
                                <div class="text-xl mb-1">🖱️</div>
                                <p class="text-xs font-bold text-slate-800">Drag</p>
                                <p class="text-[10px] text-slate-500">Putar pandangan</p>
                            </div>
                            <div class="bg-slate-50 rounded-lg p-3 text-center border border-slate-100">
                                <div class="text-xl mb-1">🔍</div>
                                <p class="text-xs font-bold text-slate-800">Scroll</p>
