@extends('layouts.app')

@section('content')
    <!-- HERO SECTION -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-slate-900 via-blue-900 to-cyan-900">
        <!-- Background blobs -->
        <div class="absolute top-20 left-10 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-40 right-10 w-96 h-96 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>

        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 w-full">
            <div class="text-center mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500/10 border border-blue-500/30 rounded-full backdrop-blur-sm mb-4">
                    <svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"></path>
                    </svg>
                    <span class="text-xs font-bold text-blue-300 uppercase tracking-widest">Live 360° Preview</span>
                </div>
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-white leading-tight mb-4">
                    Street View 360°
                </h1>
                <p class="text-lg sm:text-xl text-slate-300 max-w-2xl mx-auto">
                    Pratinjau destinasi wisata dengan Google Street View yang interaktif dan immersive sebelum Anda berkunjung
                </p>
            </div>

            <!-- Main Street View Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Street View Container -->
                <div class="lg:col-span-2">
                    <div class="card bg-slate-800 shadow-2xl overflow-hidden">
                        <div class="card-body p-0">
                            <!-- Google Street View Embed -->
                            <div class="w-full h-96 md:h-[600px] bg-slate-900 relative group">
                                <iframe 
                                    class="w-full h-full"
                                    src="https://www.google.com/maps/embed?pb=!4v1682003424445!6m8!1m7!1sJJ8CRV0dHKYAAAGU6xCVDA!2m2!1d-7.0!2d110.0!3f0!4f0!5f0.7820865974627469" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade"
                                    title="Street View 360°">
                                </iframe>
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                            </div>

                            <!-- Location Info -->
                            <div class="p-6 border-t border-slate-700">
                                <h2 class="text-2xl font-black text-white mb-2" id="street-view-title">Candi Borobudur</h2>
                                <p class="text-slate-400 text-sm mb-4" id="street-view-location">Magelang, Jawa Tengah</p>
                                
                                <!-- Coordinates -->
                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    <div class="bg-slate-700/50 rounded-lg p-4">
                                        <p class="text-xs text-slate-400 mb-1">Latitude</p>
                                        <p class="text-lg font-bold text-blue-400" id="street-view-lat">-7.6079°</p>
                                    </div>
                                    <div class="bg-slate-700/50 rounded-lg p-4">
                                        <p class="text-xs text-slate-400 mb-1">Longitude</p>
                                        <p class="text-lg font-bold text-cyan-400" id="street-view-lng">110.2037°</p>
                                    </div>
                                </div>

                                <!-- Description -->
                                <p class="text-slate-300 text-sm leading-relaxed" id="street-view-desc">
                                    Candi Borobudur adalah sebuah candi Buddha monumental abad ke-8 yang terletak di Magelang, Jawa Tengah. Dengan arsitektur yang menakjubkan, candi ini merupakan monumen Buddhis terbesar di dunia.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Destination Selector -->
                    <div class="card bg-slate-800 shadow-xl mb-6 sticky top-24">
                        <div class="card-body">
                            <h3 class="card-title text-white text-lg mb-4">Pilih Destinasi</h3>
                            <div class="space-y-2">
                                <button onclick="updateStreetView(1, 'Candi Borobudur', 'Magelang, Jawa Tengah', '-7.6079', '110.2037', 'Candi Buddha monumental abad ke-8')" class="w-full text-left p-3 bg-blue-600 hover:bg-blue-700 rounded-lg text-white font-semibold transition-colors text-sm">
                                    🏛️ Candi Borobudur
                                </button>
                                <button onclick="updateStreetView(2, 'Gunung Bromo', 'Probolinggo, Jawa Timur', '-7.9427', '112.9527', 'Gunung berapi aktif yang indah dengan pemandangan Sunrise')" class="w-full text-left p-3 bg-slate-700 hover:bg-slate-600 rounded-lg text-white font-semibold transition-colors text-sm">
                                    🏔️ Gunung Bromo
                                </button>
                                <button onclick="updateStreetView(3, 'Kota Tua Jakarta', 'Jakarta, DKI Jakarta', '-6.1353', '106.8120', 'Kawasan bersejarah dengan bangunan kolonial Belanda')" class="w-full text-left p-3 bg-slate-700 hover:bg-slate-600 rounded-lg text-white font-semibold transition-colors text-sm">
                                    🏢 Kota Tua Jakarta
                                </button>
                                <button onclick="updateStreetView(4, 'Pantai Kuta', 'Denpasar, Bali', '-8.7211', '115.1694', 'Pantai terindah dengan pasir putih dan sunset memukau')" class="w-full text-left p-3 bg-slate-700 hover:bg-slate-600 rounded-lg text-white font-semibold transition-colors text-sm">
                                    🏖️ Pantai Kuta
                                </button>
                                <button onclick="updateStreetView(5, 'Puncak Jaya', 'Papua, Indonesia', '-4.0847', '137.1718', 'Puncak tertinggi Indonesia dengan pemandangan menakjubkan')" class="w-full text-left p-3 bg-slate-700 hover:bg-slate-600 rounded-lg text-white font-semibold transition-colors text-sm">
                                    ⛰️ Puncak Jaya
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="card bg-gradient-to-br from-blue-900/50 to-cyan-900/50 border border-blue-500/30">
                        <div class="card-body">
                            <h3 class="card-title text-white text-lg mb-3">💡 Tips</h3>
                            <ul class="space-y-2 text-sm text-slate-300">
                                <li class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-blue-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Gunakan mouse untuk rotate panorama</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-blue-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Scroll untuk zoom in/out</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-blue-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Pilih destinasi untuk melihat preview</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="mt-16 bg-gradient-to-r from-blue-600/20 to-cyan-600/20 border border-blue-500/30 rounded-2xl p-8 text-center">
                <h3 class="text-2xl font-black text-white mb-3">Tertarik dengan destinasi ini?</h3>
                <p class="text-slate-300 mb-6">Lihat informasi lengkap, monitor kondisi cuaca real-time, dan pesan tiket Anda sekarang!</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/ai-monitor" class="btn btn-md bg-cyan-600 hover:bg-cyan-700 border-0 text-white font-bold">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                        </svg>
                        AI Monitor
                    </a>
                    <a href="/destinations" class="btn btn-md btn-outline border-cyan-400 text-cyan-300 hover:bg-cyan-500/10">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        Lihat Destinasi
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style>
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
    </style>

    <script>
        function updateStreetView(id, name, location, lat, lng, desc) {
            document.getElementById('street-view-title').textContent = name;
            document.getElementById('street-view-location').textContent = location;
            document.getElementById('street-view-lat').textContent = lat + '°';
            document.getElementById('street-view-lng').textContent = lng + '°';
            document.getElementById('street-view-desc').textContent = desc;

            // Update street view iframe (simplified - in production would use actual API)
            const iframe = document.querySelector('iframe');
            if (iframe) {
                iframe.src = `https://www.google.com/maps/embed?pb=!4v1682003424445!6m8!1m7!1sJJ8CRV0dHKYAAAGU6xCVDA!2m2!1d${parseFloat(lat)}!2d${parseFloat(lng)}!3f0!4f0!5f0.7820865974627469`;
            }
        }
    </script>
@endsection
