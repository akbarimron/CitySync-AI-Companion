@extends('layouts.app')

@section('content')
    <!-- HERO SECTION -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-slate-900 via-emerald-900 to-teal-900">
        <!-- Background blobs -->
        <div class="absolute top-20 left-10 w-96 h-96 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-40 right-10 w-96 h-96 bg-teal-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>

        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 w-full">
            <div class="text-center mb-12">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500/10 border border-emerald-500/30 rounded-full backdrop-blur-sm mb-4">
                    <svg class="w-4 h-4 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                    </svg>
                    <span class="text-xs font-bold text-emerald-300 uppercase tracking-widest">Real-Time Analytics</span>
                </div>
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-white leading-tight mb-4">
                    AI Monitor
                </h1>
                <p class="text-lg sm:text-xl text-slate-300 max-w-2xl mx-auto">
                    Pantau kondisi real-time di setiap destinasi dengan weather data, crowd analytics, dan IoT metrics yang akurat
                </p>
            </div>

            <!-- Main Monitoring Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                <!-- Weather Section -->
                <div class="lg:col-span-2">
                    <div class="card bg-slate-800 shadow-2xl mb-8">
                        <div class="card-body">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="card-title text-white text-2xl">🌤️ Cuaca Real-Time</h2>
                                <span class="badge badge-success">Live</span>
                            </div>

                            <!-- Weather Grid -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl p-6 text-white">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-semibold">Suhu</span>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 11.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.031.884l-2 4A1 1 0 0113 16h-2v2a1 1 0 11-2 0v-2H9a1 1 0 01-.968-.726l-2-4a1 1 0 01-.031-.884l1.738-5.42-1.233-.616a1 1 0 01.894-1.79l1.599.8L9 4.323V3a1 1 0 011-1h0z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-3xl font-black">28°C</p>
                                    <p class="text-blue-200 text-sm mt-1">Terasa 26°C</p>
                                </div>

                                <div class="bg-gradient-to-br from-cyan-600 to-cyan-700 rounded-xl p-6 text-white">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-semibold">Kelembaban</span>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.4 14.899L10 9.545l5.6 5.354a1 1 0 11-1.4 1.428l-1.04-1.004-.856 2.568a1 1 0 11-1.902-.475l1.325-3.976a1 1 0 111.857-.752l1.04 1.004 1.4-1.339a1 1 0 111.4 1.428l-5.6 5.354a1 1 0 01-1.4 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="text-3xl font-black">65%</p>
                                    <p class="text-cyan-200 text-sm mt-1">Sedang</p>
                                </div>

                                <div class="bg-gradient-to-br from-teal-600 to-teal-700 rounded-xl p-6 text-white">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-semibold">Angin</span>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-3xl font-black">12 km/h</p>
                                    <p class="text-teal-200 text-sm mt-1">Tenang</p>
                                </div>

                                <div class="bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-xl p-6 text-white">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-semibold">UV Index</span>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M13.5 2a.5.5 0 00-.5.5V5H7V2.5a.5.5 0 00-1 0v6a.5.5 0 001 0V6h6v2.5a.5.5 0 001 0v-6a.5.5 0 00-.5-.5zM4.5 9.5a.5.5 0 00-.5.5v4a.5.5 0 001 0v-4a.5.5 0 00-.5-.5zm11 0a.5.5 0 00-.5.5v4a.5.5 0 001 0v-4a.5.5 0 00-.5-.5z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="text-3xl font-black">5/10</p>
                                    <p class="text-indigo-200 text-sm mt-1">Sedang</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Crowd Analytics -->
                    <div class="card bg-slate-800 shadow-2xl">
                        <div class="card-body">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="card-title text-white text-2xl">👥 Analitik Keramaian</h2>
                                <span class="badge badge-warning">Update Setiap 5 Menit</span>
                            </div>

                            <!-- Current Crowd Level -->
                            <div class="mb-8">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-lg font-bold text-white">Tingkat Keramaian Saat Ini</span>
                                    <span class="text-2xl font-black text-emerald-400">2,450</span>
                                </div>
                                <div class="w-full bg-slate-700 rounded-full h-3 overflow-hidden">
                                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 h-full" style="width: 45%"></div>
                                </div>
                                <p class="text-slate-400 text-sm mt-2">45% kapasitas destinasi</p>
                            </div>

                            <!-- Hourly Predictions -->
                            <div class="bg-slate-700/50 rounded-lg p-6">
                                <h3 class="text-white font-bold mb-4">📈 Prediksi Per Jam</h3>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <div class="text-center p-3 bg-slate-600 rounded-lg">
                                        <p class="text-slate-300 text-sm mb-1">08:00</p>
                                        <p class="text-2xl font-bold text-cyan-400">1,200</p>
                                        <div class="w-full bg-slate-500 rounded h-1 mt-2" style="width: 25%"></div>
                                    </div>
                                    <div class="text-center p-3 bg-slate-600 rounded-lg">
                                        <p class="text-slate-300 text-sm mb-1">10:00</p>
                                        <p class="text-2xl font-bold text-blue-400">1,800</p>
                                        <div class="w-full bg-slate-500 rounded h-1 mt-2" style="width: 35%"></div>
                                    </div>
                                    <div class="text-center p-3 bg-emerald-600 rounded-lg">
                                        <p class="text-slate-200 text-sm mb-1">12:00</p>
                                        <p class="text-2xl font-bold text-white">2,450</p>
                                        <div class="w-full bg-emerald-500 rounded h-1 mt-2" style="width: 45%"></div>
                                    </div>
                                    <div class="text-center p-3 bg-slate-600 rounded-lg">
                                        <p class="text-slate-300 text-sm mb-1">14:00</p>
                                        <p class="text-2xl font-bold text-orange-400">3,100</p>
                                        <div class="w-full bg-slate-500 rounded h-1 mt-2" style="width: 60%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Destination Selector -->
                    <div class="card bg-slate-800 shadow-xl mb-6">
                        <div class="card-body">
                            <h3 class="card-title text-white text-lg mb-4">Pilih Destinasi</h3>
                            <div class="space-y-2">
                                <button class="w-full text-left p-3 bg-emerald-600 hover:bg-emerald-700 rounded-lg text-white font-semibold transition-colors text-sm">
                                    🏛️ Candi Borobudur
                                </button>
                                <button class="w-full text-left p-3 bg-slate-700 hover:bg-slate-600 rounded-lg text-white font-semibold transition-colors text-sm">
                                    🏔️ Gunung Bromo
                                </button>
                                <button class="w-full text-left p-3 bg-slate-700 hover:bg-slate-600 rounded-lg text-white font-semibold transition-colors text-sm">
                                    🏢 Kota Tua Jakarta
                                </button>
                                <button class="w-full text-left p-3 bg-slate-700 hover:bg-slate-600 rounded-lg text-white font-semibold transition-colors text-sm">
                                    🏖️ Pantai Kuta
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Real-time Status -->
                    <div class="card bg-gradient-to-br from-emerald-900/50 to-teal-900/50 border border-emerald-500/30 shadow-xl mb-6">
                        <div class="card-body">
                            <h3 class="card-title text-white text-lg mb-4">⚡ Status Real-time</h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-300">Operasional</span>
                                    <span class="badge badge-success gap-1">
                                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                        Buka
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-300">Jam Buka</span>
                                    <span class="text-white font-semibold">08:00 - 17:00</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-300">Kapasitas</span>
                                    <span class="text-white font-semibold">45%</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-300">Kondisi</span>
                                    <span class="badge badge-warning">Normal</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- IoT Devices -->
                    <div class="card bg-slate-800 shadow-xl">
                        <div class="card-body">
                            <h3 class="card-title text-white text-lg mb-4">📡 IoT Devices</h3>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                    <div class="flex-1">
                                        <p class="text-sm text-white font-semibold">Camera 1</p>
                                        <p class="text-xs text-slate-400">Entrance</p>
                                    </div>
                                    <span class="badge badge-sm badge-success">OK</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                    <div class="flex-1">
                                        <p class="text-sm text-white font-semibold">Camera 2</p>
                                        <p class="text-xs text-slate-400">Main Area</p>
                                    </div>
                                    <span class="badge badge-sm badge-success">OK</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                    <div class="flex-1">
                                        <p class="text-sm text-white font-semibold">Weather Station</p>
                                        <p class="text-xs text-slate-400">Monitoring</p>
                                    </div>
                                    <span class="badge badge-sm badge-success">OK</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                    <div class="flex-1">
                                        <p class="text-sm text-white font-semibold">Sensor Angin</p>
                                        <p class="text-xs text-slate-400">Terrace</p>
                                    </div>
                                    <span class="badge badge-sm badge-success">OK</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Feed Section -->
            <div class="card bg-slate-800 shadow-2xl mb-12">
                <div class="card-body">
                    <h2 class="card-title text-white text-2xl mb-6">🎥 Live Video Feed (Demo)</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative bg-slate-900 rounded-lg overflow-hidden aspect-video group">
                            <video width="100%" height="100%" controls class="w-full h-full object-cover">
                                <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="absolute top-4 left-4 badge badge-success gap-1">
                                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                Live
                            </div>
                        </div>
                        <div class="relative bg-slate-900 rounded-lg overflow-hidden aspect-video group">
                            <video width="100%" height="100%" controls class="w-full h-full object-cover">
                                <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="absolute top-4 left-4 badge badge-success gap-1">
                                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                Live
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recommendations -->
            <div class="bg-gradient-to-r from-emerald-600/20 to-teal-600/20 border border-emerald-500/30 rounded-2xl p-8">
                <h3 class="text-2xl font-black text-white mb-6">🤖 AI Recommendations</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-slate-800/50 rounded-lg p-6">
                        <div class="flex items-start gap-3 mb-3">
                            <svg class="w-6 h-6 text-emerald-400 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <h4 class="font-bold text-white mb-1">Waktu Terbaik</h4>
                                <p class="text-slate-300 text-sm">Kunjungi antara pukul 08:00-10:00 untuk menghindari keramaian</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-800/50 rounded-lg p-6">
                        <div class="flex items-start gap-3 mb-3">
                            <svg class="w-6 h-6 text-blue-400 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm0 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zm0 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z"></path>
                            </svg>
                            <div>
                                <h4 class="font-bold text-white mb-1">Persiapan Pakaian</h4>
                                <p class="text-slate-300 text-sm">Bawa payung dan sunscreen - UV index sedang dengan kelembaban 65%</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-800/50 rounded-lg p-6">
                        <div class="flex items-start gap-3 mb-3">
                            <svg class="w-6 h-6 text-cyan-400 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l4 4v-4h3a2 2 0 002-2V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h1v4l4-4h3V5a2 2 0 002-2zm-5-4H7a1 1 0 000 2h6a1 1 0 100-2z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <h4 class="font-bold text-white mb-1">Informasi Tambahan</h4>
                                <p class="text-slate-300 text-sm">Destinasi sedang beroperasi normal dengan kapasitas 45%</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-800/50 rounded-lg p-6">
                        <div class="flex items-start gap-3 mb-3">
                            <svg class="w-6 h-6 text-emerald-400 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 01.22 1.97l-.612.341a1 1 0 01-1.196-1.196l.341-.612A1 1 0 015 12zm5-9a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0V7h-1a1 1 0 110-2h1V4a1 1 0 011-1zm5 0a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0V7h-1a1 1 0 110-2h1V4a1 1 0 011-1zm0 10a1 1 0 01.22 1.97l-.612.341a1 1 0 11-1.196-1.196l.341-.612A1 1 0 0115 12z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <h4 class="font-bold text-white mb-1">Prediksi Cuaca</h4>
                                <p class="text-slate-300 text-sm">Peluang hujan 20% - cuaca akan cerah sepanjang hari</p>
                            </div>
                        </div>
                    </div>
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
@endsection
