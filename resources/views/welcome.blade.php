@extends('layouts.app')

@section('content')
    <!-- HERO SECTION -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-slate-900 via-cyan-900 to-emerald-900">
        <!-- Animated background blobs -->
        <div class="absolute top-20 left-10 w-72 h-72 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-40 right-10 w-72 h-72 bg-emerald-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
        
        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
            <div class="text-center space-y-8">
                <!-- Kicker -->
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-cyan-500/10 border border-cyan-500/30 rounded-full backdrop-blur-sm">
                    <svg class="w-4 h-4 text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-xs font-bold text-cyan-300 uppercase tracking-widest">AI-Powered Travel Experience</span>
                </div>

                <!-- Main Headline -->
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-white leading-tight">
                        Jelajahi Destinasi
                        <span class="block bg-gradient-to-r from-cyan-400 via-emerald-400 to-blue-400 text-transparent bg-clip-text">
                            dengan Teknologi AI
                        </span>
                    </h1>
                    <p class="text-lg sm:text-xl text-slate-300 max-w-2xl mx-auto leading-relaxed">
                        Temukan pengalaman wisata yang dipersonalisasi dengan street view 360°, monitoring real-time, dan AI travel assistant yang memahami preferensi Anda.
                    </p>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center pt-8">
                    <a href="/destinations" class="btn btn-lg bg-cyan-500 hover:bg-cyan-600 border-0 text-white font-bold rounded-full px-8 shadow-lg shadow-cyan-500/50">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        Jelajahi Destinasi
                    </a>
                    <a href="/street-view" class="btn btn-lg btn-outline border-cyan-400 text-cyan-300 hover:bg-cyan-500/10 rounded-full px-8">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                        </svg>
                        Lihat Street View 360°
                    </a>
                </div>

                <!-- Stats -->
                <div class="flex flex-col sm:flex-row gap-8 justify-center pt-16 border-t border-cyan-500/20">
                    <div class="text-center">
                        <div class="text-3xl sm:text-4xl font-black text-cyan-400">500+</div>
                        <p class="text-slate-400 text-sm mt-2">Destinasi Terpilih</p>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl sm:text-4xl font-black text-emerald-400">100K+</div>
                        <p class="text-slate-400 text-sm mt-2">Pengguna Aktif</p>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl sm:text-4xl font-black text-blue-400">24/7</div>
                        <p class="text-slate-400 text-sm mt-2">Real-time Monitoring</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES SECTION - FIVE PLATFORM PILLARS -->
    <section class="py-24 px-4 sm:px-6 lg:px-8 bg-slate-50">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="space-y-6 mb-20">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-cyan-100 rounded-full">
                    <span class="text-sm font-bold text-cyan-700 uppercase tracking-widest">🏛️ FIVE PLATFORM PILLARS</span>
                </div>
                <div class="max-w-3xl">
                    <h2 class="text-5xl lg:text-6xl font-black text-slate-900 leading-tight mb-6">
                        A tourism assistant that thinks like a city command center.
                    </h2>
                    <p class="text-lg text-slate-600 leading-relaxed">
                        Each interaction blends personal travel planning, live operations, predictive analytics, and secure access into one calm, trustworthy experience.
                    </p>
                </div>
            </div>

            <!-- Feature Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                <!-- Pillar 1: Contextual AI Assistant -->
                <div class="group card bg-white border border-slate-200 hover:border-cyan-400 hover:shadow-lg transition-all duration-300 h-full">
                    <div class="card-body p-8 flex flex-col">
                        <div class="w-16 h-16 bg-cyan-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-cyan-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Contextual AI Assistant</h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6 flex-1">
                            GPT-4 Powered Travel Guide untuk hyper-personalized routing dan recommendations based on preferences.
                        </p>
                        <div class="pt-4 border-t border-slate-100">
                            <span class="text-xs font-bold text-cyan-600 uppercase tracking-widest">LAYER 01 · ONLINE</span>
                        </div>
                    </div>
                </div>

                <!-- Pillar 2: Proactive Crowd Optimizer -->
                <div class="group card bg-white border border-slate-200 hover:border-emerald-400 hover:shadow-lg transition-all duration-300 h-full">
                    <div class="card-body p-8 flex flex-col">
                        <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-13c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Proactive Crowd Optimizer</h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6 flex-1">
                            LSTM & Ant Colony algorithm untuk avoid peak hours dan traffic dengan predictive crowd analytics.
                        </p>
                        <div class="pt-4 border-t border-slate-100">
                            <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest">LAYER 02 · ONLINE</span>
                        </div>
                    </div>
                </div>

                <!-- Pillar 3: Immersive Real-Time Preview -->
                <div class="group card bg-white border border-slate-200 hover:border-teal-400 hover:shadow-lg transition-all duration-300 h-full">
                    <div class="card-body p-8 flex flex-col">
                        <div class="w-16 h-16 bg-teal-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-teal-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-13c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Immersive Real-Time Preview</h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6 flex-1">
                            Live IoT 360° Cams dan AR/VR destination previews untuk informed decisions sebelum visit.
                        </p>
                        <div class="pt-4 border-t border-slate-100">
                            <span class="text-xs font-bold text-teal-600 uppercase tracking-widest">LAYER 03 · ONLINE</span>
                        </div>
                    </div>
                </div>

                <!-- Pillar 4: Smart Booking & Dynamic Pricing -->
                <div class="group card bg-white border border-slate-200 hover:border-blue-400 hover:shadow-lg transition-all duration-300 h-full">
                    <div class="card-body p-8 flex flex-col">
                        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-5-9h10v2H7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Smart Booking & Dynamic Pricing</h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6 flex-1">
                            Automated booking dengan AI-driven dynamic pricing berdasarkan demand, supply, dan traveler profile.
                        </p>
                        <div class="pt-4 border-t border-slate-100">
                            <span class="text-xs font-bold text-blue-600 uppercase tracking-widest">LAYER 04 · ONLINE</span>
                        </div>
                    </div>
                </div>

                <!-- Pillar 5: Unified Payment & Access -->
                <div class="group card bg-white border border-slate-200 hover:border-violet-400 hover:shadow-lg transition-all duration-300 h-full">
                    <div class="card-body p-8 flex flex-col">
                        <div class="w-16 h-16 bg-violet-100 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-violet-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-13c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">Unified Payment & Access</h3>
                        <p class="text-slate-600 text-sm leading-relaxed mb-6 flex-1">
                            Ticketless entry via Biometric Facial Recognition dan secure payment integration untuk seamless experience.
                        </p>
                        <div class="pt-4 border-t border-slate-100">
                            <span class="text-xs font-bold text-violet-600 uppercase tracking-widest">LAYER 05 · ONLINE</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURED DESTINATIONS SECTION -->
    <section class="py-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center space-y-4 mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-cyan-100 rounded-full">
                    <span class="text-sm font-bold text-cyan-700 uppercase tracking-widest">🎯 DESTINASI UNGGULAN</span>
                </div>
                <h2 class="text-4xl sm:text-5xl font-black text-slate-900">
                    Destinasi Wisata Terpilih
                </h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                    Jelajahi koleksi destinasi wisata terbaik di Indonesia yang telah dikurasi khusus untuk pengalaman tak terlupakan
                </p>
            </div>

            <!-- Featured Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <!-- Card 1: Budaya -->
                <div class="group card image-full shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden h-80" style="background-image: url('https://images.pexels.com/photos/3764119/pexels-photo-3764119.jpeg?auto=compress&cs=tinysrgb&w=600');">
                    <div class="bg-gradient-to-t from-black via-transparent to-transparent"></div>
                    <div class="card-body flex flex-col justify-between">
                        <div>
                            <h2 class="card-title text-2xl font-black text-white">Candi Borobudur</h2>
                            <p class="text-cyan-200 text-sm font-semibold">Magelang, Jawa Tengah</p>
                        </div>
                        <div class="card-actions justify-between items-center">
                            <div class="badge badge-sm badge-primary">Budaya</div>
                            <button class="btn btn-sm btn-primary text-white" onclick="window.location.href='/destinations'">Lihat Detail</button>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Alam -->
                <div class="group card image-full shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden h-80" style="background-image: url('https://images.pexels.com/photos/1619317/pexels-photo-1619317.jpeg?auto=compress&cs=tinysrgb&w=600');">
                    <div class="bg-gradient-to-t from-black via-transparent to-transparent"></div>
                    <div class="card-body flex flex-col justify-between">
                        <div>
                            <h2 class="card-title text-2xl font-black text-white">Gunung Bromo</h2>
                            <p class="text-cyan-200 text-sm font-semibold">Probolinggo, Jawa Timur</p>
                        </div>
                        <div class="card-actions justify-between items-center">
                            <div class="badge badge-sm badge-success">Alam</div>
                            <button class="btn btn-sm btn-primary text-white" onclick="window.location.href='/destinations'">Lihat Detail</button>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Modern -->
                <div class="group card image-full shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden h-80" style="background-image: url('https://images.pexels.com/photos/2230052/pexels-photo-2230052.jpeg?auto=compress&cs=tinysrgb&w=600');">
                    <div class="bg-gradient-to-t from-black via-transparent to-transparent"></div>
                    <div class="card-body flex flex-col justify-between">
                        <div>
                            <h2 class="card-title text-2xl font-black text-white">Jakarta Tower</h2>
                            <p class="text-cyan-200 text-sm font-semibold">Jakarta, DKI Jakarta</p>
                        </div>
                        <div class="card-actions justify-between items-center">
                            <div class="badge badge-sm badge-info">Modern</div>
                            <button class="btn btn-sm btn-primary text-white" onclick="window.location.href='/destinations'">Lihat Detail</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="bg-gradient-to-r from-cyan-600 to-emerald-600 rounded-2xl p-8 md:p-12 text-center">
                <h3 class="text-3xl sm:text-4xl font-black text-white mb-4">
                    Siap untuk Petualangan Berikutnya?
                </h3>
                <p class="text-cyan-100 text-lg mb-8 max-w-2xl mx-auto">
                    Jelajahi lebih dari 500 destinasi wisata terpilih dengan rekomendasi AI yang dipersonalisasi khusus untuk Anda
                </p>
                <a href="/destinations" class="btn btn-lg btn-white text-cyan-600 hover:bg-slate-100 font-bold rounded-full px-8 shadow-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    Jelajahi Semua Destinasi
                </a>
            </div>
        </div>
    </section>

    <!-- CITY COMPANION AI SECTION -->
    <section class="py-24 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left Side: Content -->
                <div class="space-y-8">
                    <div>
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 rounded-full mb-6">
                            <span class="text-sm font-bold text-blue-700 uppercase tracking-widest">🧠 DISTILBERT NLP ENGINE</span>
                        </div>
                        <h2 class="text-5xl lg:text-6xl font-black text-slate-900 leading-tight mb-6">
                            Understands intent, urgency, and traveler emotion.
                        </h2>
                        <p class="text-lg text-slate-600 leading-relaxed">
                            The companion detects whether a traveler is excited, stressed, time-limited, or crowd-sensitive, then adjusts recommendations using live public service signals.
                        </p>
                    </div>

                    <!-- Features Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-6 bg-slate-50 rounded-xl border border-slate-200">
                            <div class="flex items-start gap-3 mb-3">
                                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-13c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z"></path>
                                </svg>
                                <div>
                                    <h4 class="font-bold text-slate-900 mb-1">Emotion-aware planning</h4>
                                    <p class="text-sm text-slate-600">Reads soft preferences and mood cues.</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 bg-slate-50 rounded-xl border border-slate-200">
                            <div class="flex items-start gap-3 mb-3">
                                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-13c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z"></path>
                                </svg>
                                <div>
                                    <h4 class="font-bold text-slate-900 mb-1">IoT signal fusion</h4>
                                    <p class="text-sm text-slate-600">Blends crowd, traffic, and weather data.</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 bg-slate-50 rounded-xl border border-slate-200">
                            <div class="flex items-start gap-3 mb-3">
                                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-13c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z"></path>
                                </svg>
                                <div>
                                    <h4 class="font-bold text-slate-900 mb-1">Trusted access</h4>
                                    <p class="text-sm text-slate-600">Keeps identity and payment flows secure.</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 bg-slate-50 rounded-xl border border-slate-200">
                            <div class="flex items-start gap-3 mb-3">
                                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-13c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z"></path>
                                </svg>
                                <div>
                                    <h4 class="font-bold text-slate-900 mb-1">Eco-priority routing</h4>
                                    <p class="text-sm text-slate-600">Prioritizes transit and low-emission paths.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Chat Demo -->
                <div class="relative">
                    <div class="bg-slate-900 rounded-2xl p-6 shadow-2xl overflow-hidden">
                        <!-- Header -->
                        <div class="flex items-center justify-between gap-3 mb-6 pb-6 border-b border-slate-700">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-emerald-500/20 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-13c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-white">City Companion AI</p>
                                    <p class="text-xs text-emerald-400">Live operations aware</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-emerald-500/20 text-emerald-400 text-xs font-bold rounded-full">Secure demo</span>
                        </div>

                        <!-- Chat Messages -->
                        <div class="space-y-4 mb-6 h-80 overflow-y-auto">
                            <!-- User Message -->
                            <div class="flex justify-end">
                                <div class="max-w-xs bg-cyan-500 text-white rounded-xl px-4 py-3 rounded-br-none text-sm">
                                    I want to visit a theme park but avoid the crowds today.
                                </div>
                            </div>

                            <!-- AI Response -->
                            <div class="flex justify-start">
                                <div class="max-w-sm bg-slate-800 text-slate-200 rounded-xl px-4 py-3 rounded-bl-none text-sm">
                                    I found a lower-crowd route. Dufan is heavy now, so I recommend a delayed entry window with a waterfront stop first.
                                </div>
                            </div>

                            <!-- Generated Route -->
                            <div class="flex justify-start mt-6">
                                <div class="max-w-sm bg-slate-800 border border-slate-700 rounded-xl p-4 text-sm">
                                    <div class="flex items-center justify-between mb-4">
                                        <h4 class="font-bold text-white">GENERATED ROUTE</h4>
                                        <span class="px-2 py-1 bg-emerald-500/20 text-emerald-400 text-xs font-bold rounded">92% match</span>
                                    </div>
                                    <h3 class="text-lg font-bold text-white mb-4">Eco Loop to Ancol · Crowd-safe</h3>
                                    
                                    <div class="space-y-3 mb-4">
                                        <div class="flex items-start gap-3">
                                            <div class="w-12 h-12 bg-slate-700 rounded-lg flex items-center justify-center flex-shrink-0 text-white font-bold text-xs">09:40</div>
                                            <div>
                                                <p class="font-semibold text-white">MRT + shuttle</p>
                                                <p class="text-xs text-emerald-400">Low traffic</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-3">
                                            <div class="w-12 h-12 bg-slate-700 rounded-lg flex items-center justify-center flex-shrink-0 text-white font-bold text-xs">10:25</div>
                                            <div>
                                                <p class="font-semibold text-white">Seaside lunch</p>
                                                <p class="text-xs text-emerald-400">Crowd 31%</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-3">
                                            <div class="w-12 h-12 bg-slate-700 rounded-lg flex items-center justify-center flex-shrink-0 text-white font-bold text-xs">13:10</div>
                                            <div>
                                                <p class="font-semibold text-white">Dufan entry</p>
                                                <p class="text-xs text-emerald-400">Crowd 54%</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pt-3 border-t border-slate-700">
                                        <p class="text-xs text-slate-400">✈️ Estimated total journey: 4h 20m · 27 minutes saved versus direct route.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Input -->
                        <div class="flex gap-2">
                            <input type="text" placeholder="Ask about routes, tickets, weather, or access..." class="flex-1 bg-slate-800 border border-slate-700 rounded-lg px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-cyan-500" />
                            <button class="px-4 py-3 bg-cyan-500 hover:bg-cyan-600 text-white font-bold rounded-lg transition-colors">
                                Send
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- INTERACTIVE PREVIEW SECTION -->
    <section class="py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-slate-50 to-cyan-50">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center space-y-4 mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-cyan-100 rounded-full">
                    <span class="text-sm font-bold text-cyan-700 uppercase tracking-widest">🗺️ DALAM SATU ALUR</span>
                </div>
                <h2 class="text-4xl sm:text-5xl font-black text-slate-900">
                    Wisatawan bisa memilih destinasi Jakarta
                </h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                    Lihat peta interaktif, preview 360°, memilih paket tiket, dan mendapatkan konfirmasi booking demo tanpa pembayaran asli.
                </p>
            </div>

            <!-- Interactive Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Side: Destination List -->
                <div class="lg:col-span-1">
                    <!-- Demo Badge -->
                    <div class="flex items-center gap-2 px-4 py-3 bg-emerald-100 border border-emerald-300 rounded-lg mb-6">
                        <div class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></div>
                        <span class="font-bold text-emerald-900 text-sm">Demo booking aktif</span>
                        <p class="text-xs text-emerald-700">Tanpa pembayaran asli</p>
                    </div>

                    <!-- Destination Cards -->
                    <div class="space-y-4">
                        <!-- Destination 1: Dufan -->
                        <div class="destination-preview-card cursor-pointer p-4 bg-white rounded-xl shadow-md hover:shadow-lg hover:border-cyan-500 transition-all duration-300 border-2 border-transparent" onclick="updatePreview('dufan')">
                            <div class="flex gap-4 items-start">
                                <img src="https://images.unsplash.com/photo-1540932239986-310128078ceb?w=100&h=100&fit=crop" alt="Dufan" class="w-20 h-20 object-cover rounded-lg flex-shrink-0" />
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h3 class="font-bold text-slate-900">Dufan Ancol</h3>
                                        <span class="flex items-center gap-1 text-yellow-500 text-xs font-bold">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            4.8
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-500 flex items-center gap-1 mb-3">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a1 1 0 111.414 1.414L5.414 7H15a2 2 0 012 2v4a2 2 0 01-2 2H5.414l1.05 1.05a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 111.414 1.414L5.414 11H15V9H5.414l1.636 1.636a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3z" clip-rule="evenodd"></path></svg>
                                        Jakarta Utara
                                    </p>
                                    <div class="grid grid-cols-3 gap-2 text-center">
                                        <div>
                                            <p class="text-xs text-slate-500">Crowd</p>
                                            <p class="font-bold text-slate-900 text-sm">85%</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500">ETA</p>
                                            <p class="font-bold text-slate-900 text-sm">38 min</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500">From</p>
                                            <p class="font-bold text-cyan-600 text-sm">Rp120K</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Destination 2: Kota Tua -->
                        <div class="destination-preview-card cursor-pointer p-4 bg-white rounded-xl shadow-md hover:shadow-lg hover:border-cyan-500 transition-all duration-300 border-2 border-transparent active" onclick="updatePreview('kotaTua')">
                            <div class="flex gap-4 items-start border-l-4 border-cyan-500 pl-3">
                                <img src="https://images.unsplash.com/photo-1570129477492-45a003537e90?w=100&h=100&fit=crop" alt="Kota Tua" class="w-20 h-20 object-cover rounded-lg flex-shrink-0" />
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h3 class="font-bold text-slate-900">Kota Tua</h3>
                                        <span class="flex items-center gap-1 text-yellow-500 text-xs font-bold">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            4.7
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-500 flex items-center gap-1 mb-3">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a1 1 0 111.414 1.414L5.414 7H15a2 2 0 012 2v4a2 2 0 01-2 2H5.414l1.05 1.05a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 111.414 1.414L5.414 11H15V9H5.414l1.636 1.636a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3z" clip-rule="evenodd"></path></svg>
                                        Jakarta Barat
                                    </p>
                                    <div class="grid grid-cols-3 gap-2 text-center">
                                        <div>
                                            <p class="text-xs text-slate-500">Crowd</p>
                                            <p class="font-bold text-slate-900 text-sm">52%</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500">ETA</p>
                                            <p class="font-bold text-slate-900 text-sm">24 min</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500">From</p>
                                            <p class="font-bold text-cyan-600 text-sm">Rp45K</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Destination 3: Monas -->
                        <div class="destination-preview-card cursor-pointer p-4 bg-white rounded-xl shadow-md hover:shadow-lg hover:border-cyan-500 transition-all duration-300 border-2 border-transparent" onclick="updatePreview('monas')">
                            <div class="flex gap-4 items-start">
                                <img src="https://images.unsplash.com/photo-1512207736139-e8c07a4b0a8e?w=100&h=100&fit=crop" alt="Monas" class="w-20 h-20 object-cover rounded-lg flex-shrink-0" />
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h3 class="font-bold text-slate-900">Monas</h3>
                                        <span class="flex items-center gap-1 text-yellow-500 text-xs font-bold">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                            4.6
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-500 flex items-center gap-1 mb-3">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a1 1 0 111.414 1.414L5.414 7H15a2 2 0 012 2v4a2 2 0 01-2 2H5.414l1.05 1.05a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 111.414 1.414L5.414 11H15V9H5.414l1.636 1.636a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3z" clip-rule="evenodd"></path></svg>
                                        Jakarta Pusat
                                    </p>
                                    <div class="grid grid-cols-3 gap-2 text-center">
                                        <div>
                                            <p class="text-xs text-slate-500">Crowd</p>
                                            <p class="font-bold text-slate-900 text-sm">61%</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500">ETA</p>
                                            <p class="font-bold text-slate-900 text-sm">18 min</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500">From</p>
                                            <p class="font-bold text-cyan-600 text-sm">Rp65K</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Map & Details -->
                <div class="lg:col-span-2">
                    <!-- Selected Destination Info -->
                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <div class="mb-8">
                            <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">SELECTED DESTINATION</h3>
                            <h2 id="preview-dest-name" class="text-4xl font-black text-slate-900 mb-2">Ancol Beach City</h2>
                            <p id="preview-dest-desc" class="text-slate-600 leading-relaxed">Area waterfront untuk keluarga, sunset walk, dan bundling transport menuju destinasi sekitar Ancol.</p>
                        </div>

                        <!-- Google Maps -->
                        <div class="mb-8">
                            <div class="relative">
                                <iframe id="preview-map" width="100%" height="400" style="border:none;border-radius:1rem;" src="https://www.google.com/maps/embed?pb=!1m2!1s-6.1290%2C106.7868!2z&output=embed"></iframe>
                                <button class="absolute top-4 right-4 px-4 py-2 bg-slate-900 text-white font-bold rounded-full hover:bg-slate-800 transition-colors flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1z"></path></svg>
                                    Buka Google Maps
                                </button>
                            </div>
                        </div>

                        <!-- Tabs/Options -->
                        <div class="flex flex-wrap gap-2">
                            <button class="px-4 py-2 bg-cyan-100 text-cyan-700 font-bold rounded-full hover:bg-cyan-200 transition-colors">Sunset route</button>
                            <button class="px-4 py-2 bg-slate-100 text-slate-700 font-bold rounded-full hover:bg-slate-200 transition-colors">Transport bundle</button>
                            <button class="px-4 py-2 bg-slate-100 text-slate-700 font-bold rounded-full hover:bg-slate-200 transition-colors">Family zone</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS SECTION -->
    <section class="py-24 px-4 sm:px-6 lg:px-8 bg-slate-900">
        <div class="max-w-7xl mx-auto">
            <!-- Section Header -->
            <div class="text-center space-y-4 mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-cyan-500/20 border border-cyan-500/30 rounded-full">
                    <span class="text-sm font-bold text-cyan-400 uppercase tracking-widest">⚡ CARA KERJA</span>
                </div>
                <h2 class="text-4xl sm:text-5xl font-black text-white">
                    Mulai Petualangan Dalam 4 Langkah Mudah
                </h2>
            </div>

            <!-- Steps -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Step 1 -->
                <div class="relative">
                    <div class="card bg-slate-800 border border-cyan-500/20">
                        <div class="card-body">
                            <div class="w-12 h-12 bg-cyan-500 rounded-full flex items-center justify-center text-white font-bold text-lg mb-4">1</div>
                            <h3 class="card-title text-white text-lg">Pilih Destinasi</h3>
                            <p class="text-slate-400">Browse destinasi dari katalog kami yang lengkap atau cari dengan AI assistant</p>
                        </div>
                    </div>
                    <div class="hidden lg:block absolute top-1/2 -right-4 w-8 h-8 bg-cyan-500 rounded-full transform -translate-y-1/2"></div>
                </div>

                <!-- Step 2 -->
                <div class="relative">
                    <a href="/street-view" class="card bg-slate-800 border border-cyan-500/20 hover:border-cyan-400 hover:bg-slate-700 transition-all duration-300 block group">
                        <div class="card-body">
                            <div class="w-12 h-12 bg-cyan-500 rounded-full flex items-center justify-center text-white font-bold text-lg mb-4">2</div>
                            <h3 class="card-title text-white text-lg group-hover:text-cyan-300 transition-colors">Preview 360°</h3>
                            <p class="text-slate-400">Lihat destinasi dengan street view interaktif sebelum memutuskan</p>
                            <span class="inline-flex items-center gap-1 text-xs text-cyan-400 font-bold mt-3">
                                Buka Street View
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </span>
                        </div>
                    </a>
                    <div class="hidden lg:block absolute top-1/2 -right-4 w-8 h-8 bg-cyan-500 rounded-full transform -translate-y-1/2 z-10"></div>
                </div>

                <!-- Step 3 -->
                <div class="relative">
                    <a href="/ai-monitor" class="card bg-slate-800 border border-cyan-500/20 hover:border-blue-400 hover:bg-slate-700 transition-all duration-300 block group">
                        <div class="card-body">
                            <div class="w-12 h-12 bg-cyan-500 rounded-full flex items-center justify-center text-white font-bold text-lg mb-4">3</div>
                            <h3 class="card-title text-white text-lg group-hover:text-blue-300 transition-colors">Check Kondisi</h3>
                            <p class="text-slate-400">Monitor cuaca real-time dan tingkat keramaian dengan AI Monitor</p>
                            <span class="inline-flex items-center gap-1 text-xs text-blue-400 font-bold mt-3">
                                Buka AI Monitor
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </span>
                        </div>
                    </a>
                    <div class="hidden lg:block absolute top-1/2 -right-4 w-8 h-8 bg-cyan-500 rounded-full transform -translate-y-1/2 z-10"></div>
                </div>

                <!-- Step 4 -->
                <div class="relative">
                    <div class="card bg-slate-800 border border-cyan-500/20">
                        <div class="card-body">
                            <div class="w-12 h-12 bg-cyan-500 rounded-full flex items-center justify-center text-white font-bold text-lg mb-4">4</div>
                            <h3 class="card-title text-white text-lg">Pesan & Nikmati</h3>
                            <p class="text-slate-400">Booking tiket dengan harga dinamis dan akses biometric</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA FINAL SECTION -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-cyan-600 to-emerald-600">
        <div class="max-w-4xl mx-auto text-center space-y-6">
            <h2 class="text-4xl sm:text-5xl font-black text-white">
                Saatnya Menjelajahi Indonesia
            </h2>
            <p class="text-lg text-cyan-100">
                Bergabunglah dengan ribuan traveler yang telah menemukan destinasi impian mereka
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/destinations" class="btn btn-lg btn-white text-cyan-600 hover:bg-slate-100 font-bold rounded-full">Mulai Sekarang</a>
                <a href="/street-view" class="btn btn-lg btn-outline border-white text-white hover:bg-white/10 font-bold rounded-full">Lihat Street View</a>
                <a href="/ai-monitor" class="btn btn-lg btn-outline border-white text-white hover:bg-white/10 font-bold rounded-full">AI Monitor</a>
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

        .destination-preview-card.active {
            @apply border-cyan-500 border-l-4 pl-3;
        }
    </style>

    <script>
        const previewData = {
            kotaTua: {
                name: 'Kota Tua Jakarta',
                desc: 'Jelajahi warisan sejarah Jakarta melalui arsitektur kolonial Belanda yang megah dan menawan. Kota Tua Jakarta adalah jantung sejarah kota Jakarta dengan berbagai museum bersejarah.',
                lat: -6.1344,
                lng: 106.8065,
                mapUrl: 'https://www.google.com/maps/embed?pb=!1m2!1s-6.1344%2C106.8065!2z&output=embed'
            },
            dufan: {
                name: 'Dufan Ancol',
                desc: 'Dunia Fantasi adalah taman hiburan terbesar di Indonesia dengan wahana seru untuk seluruh keluarga. Nikmati pengalaman yang tak terlupakan bersama orang-orang terkasih.',
                lat: -6.1290,
                lng: 106.7868,
                mapUrl: 'https://www.google.com/maps/embed?pb=!1m2!1s-6.1290%2C106.7868!2z&output=embed'
            },
            monas: {
                name: 'Monumen Nasional',
                desc: 'Monumen ikonik Indonesia yang mewakili kemerdekaan dan persatuan bangsa. Naik ke puncak untuk melihat pemandangan kota Jakarta yang spektakuler.',
                lat: -6.1751,
                lng: 106.8270,
                mapUrl: 'https://www.google.com/maps/embed?pb=!1m2!1s-6.1751%2C106.8270!2z&output=embed'
            }
        };

        function updatePreview(destinationId) {
            const data = previewData[destinationId];
            
            if (!data) return;

            // Update destination name and description
            document.getElementById('preview-dest-name').textContent = data.name;
            document.getElementById('preview-dest-desc').textContent = data.desc;
            
            // Update map
            document.getElementById('preview-map').src = data.mapUrl;

            // Update active card border
            document.querySelectorAll('.destination-preview-card').forEach(card => {
                card.classList.remove('active', 'border-cyan-500', 'border-l-4', 'pl-3');
            });
            
            event.currentTarget.classList.add('active', 'border-cyan-500', 'border-l-4', 'pl-3');
        }
    </script>
@endsection