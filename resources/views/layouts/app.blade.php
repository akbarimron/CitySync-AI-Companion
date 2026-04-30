<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CitySync AI Companion — Smart tourism OS powered by AI for Jakarta.">
    <title>@yield('title', 'CitySync AI Companion')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Leaflet CSS for Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Alpine.js for interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="min-h-screen overflow-x-hidden"
    style="background: radial-gradient(circle at 15% 8%, rgba(14,165,233,.14), transparent 26rem), radial-gradient(circle at 92% 22%, rgba(16,185,129,.14), transparent 26rem), #f7fbff; color: #0f172a;">

    {{-- ── NAVBAR ──────────────────────────────────────────── --}}
    <header class="cs-navbar" id="cs-navbar">
        <nav class="cs-nav-inner relative">
            {{-- Brand --}}
            <a href="{{ url('/') }}" class="flex items-center gap-3 group" id="brand-logo-link">
                <span
                    class="flex h-11 w-11 items-center justify-center rounded-2xl text-white shadow-lg shadow-cyan-500/25 transition-transform duration-300 group-hover:-rotate-6 group-hover:scale-105"
                    style="background: linear-gradient(135deg, #0ea5e9, #10b981);">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </span>
                <span class="leading-tight">
                    <span class="block text-sm font-black tracking-tight text-slate-950">CitySync AI</span>
                    <span class="block text-xs font-semibold text-slate-500">Smart tourism OS</span>
                </span>
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden items-center justify-center gap-1 lg:flex flex-1" id="desktop-nav">
                <a href="{{ url('/') }}"
                    class="rounded-full px-4 py-2 text-sm font-bold text-slate-600 transition-colors duration-200 hover:bg-cyan-50 hover:text-cyan-700">Beranda</a>
                <a href="{{ url('/#features') }}"
                    class="rounded-full px-4 py-2 text-sm font-bold text-slate-600 transition-colors duration-200 hover:bg-cyan-50 hover:text-cyan-700">Fitur</a>
                <a href="{{ url('/#manfaat') }}"
                    class="rounded-full px-4 py-2 text-sm font-bold text-slate-600 transition-colors duration-200 hover:bg-cyan-50 hover:text-cyan-700">Manfaat</a>
                <a href="{{ url('/#faq') }}"
                    class="rounded-full px-4 py-2 text-sm font-bold text-slate-600 transition-colors duration-200 hover:bg-cyan-50 hover:text-cyan-700">FAQ</a>
                <a href="{{ url('/#kontak') }}"
                    class="rounded-full px-4 py-2 text-sm font-bold text-slate-600 transition-colors duration-200 hover:bg-cyan-50 hover:text-cyan-700">Kontak</a>
                <a href="{{ url('/destinations') }}"
                    class="rounded-full px-4 py-2 text-sm font-bold text-slate-600 transition-colors duration-200 hover:bg-cyan-50 hover:text-cyan-700">Destinasi</a>
            </div>

            {{-- Mobile Toggle --}}
            <button id="mobile-menu-btn" type="button" aria-label="Toggle menu" aria-expanded="false"
                class="absolute right-4 top-1/2 inline-flex h-11 w-11 -translate-y-1/2 items-center justify-center rounded-2xl text-white transition-transform duration-300 hover:scale-105 lg:hidden"
                style="background: #0f172a;">
                <svg id="menu-icon-open" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="menu-icon-close" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </nav>

        {{-- Mobile Menu --}}
        <div id="mobile-menu"
            class="hidden mt-3 mx-auto max-w-[80rem] rounded-2xl border border-white/80 p-3 shadow-2xl backdrop-blur-2xl"
            style="background: rgba(255,255,255,0.92);">
            <a href="{{ url('/') }}"
                class="block rounded-xl px-4 py-3 text-sm font-bold text-slate-700 transition-colors hover:bg-cyan-50">Beranda</a>
            <a href="{{ url('/#features') }}"
                class="block rounded-xl px-4 py-3 text-sm font-bold text-slate-700 transition-colors hover:bg-cyan-50">Fitur</a>
            <a href="{{ url('/#manfaat') }}"
                class="block rounded-xl px-4 py-3 text-sm font-bold text-slate-700 transition-colors hover:bg-cyan-50">Manfaat</a>
            <a href="{{ url('/#faq') }}"
                class="block rounded-xl px-4 py-3 text-sm font-bold text-slate-700 transition-colors hover:bg-cyan-50">FAQ</a>
            <a href="{{ url('/#kontak') }}"
                class="block rounded-xl px-4 py-3 text-sm font-bold text-slate-700 transition-colors hover:bg-cyan-50">Kontak</a>
            <a href="{{ url('/destinations') }}"
                class="block rounded-xl px-4 py-3 text-sm font-bold text-slate-700 transition-colors hover:bg-cyan-50">Destinasi</a>
        </div>
    </header>

    {{-- ── CONTENT ─────────────────────────────────────────── --}}
    <main>
        @yield('content')
    </main>

    @stack('scripts')

    <footer class="mt-20 border-t border-slate-200 bg-white pt-16 pb-8 shadow-[0_-10px_40px_rgba(0,0,0,0.02)]">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-[1.5fr_1fr_1fr_1fr]">
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <span
                            class="flex h-12 w-12 items-center justify-center rounded-2xl text-white shadow-lg shadow-cyan-500/25"
                            style="background: linear-gradient(135deg, #0ea5e9, #10b981);">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </span>
                        <div>
                            <p class="text-lg font-black text-slate-900 tracking-tight">CitySync AI</p>
                            <p class="text-xs font-bold uppercase tracking-widest text-slate-400">Smart tourism OS</p>
                        </div>
                    </div>
                    <p class="max-w-md text-sm leading-7 text-slate-500 font-medium">
                        Platform pariwisata cerdas untuk Jakarta. Menyatukan AI, data IoT, dan sistem booking dalam satu
                        ekosistem interaktif dan responsif berbasis MySQL.
                    </p>
                </div>

                <div>
                    <p class="mb-6 text-xs font-black uppercase tracking-[0.2em] text-slate-900">Jelajah</p>
                    <ul class="space-y-4 text-sm font-semibold text-slate-500">
                        <li><a class="hover:text-cyan-600 transition-colors" href="{{ url('/') }}">Beranda</a>
                        </li>
                        <li><a class="hover:text-cyan-600 transition-colors" href="{{ url('/features') }}">Fitur
                                Unggulan</a></li>
                        <li><a class="hover:text-cyan-600 transition-colors" href="{{ url('/destinations') }}">Daftar
                                Destinasi</a></li>
                    </ul>
                </div>

                <div>
                    <p class="mb-6 text-xs font-black uppercase tracking-[0.2em] text-slate-900">Platform</p>
                    <ul class="space-y-4 text-sm font-semibold text-slate-500">
                        <li><a class="hover:text-cyan-600 transition-colors" href="{{ url('/street-view') }}">Street
                                View 360</a></li>
                        <li><a class="hover:text-cyan-600 transition-colors"
                                href="{{ url('/destinations/1') }}">Dashboard Destinasi</a></li>
                        <li><a class="hover:text-cyan-600 transition-colors" href="{{ url('/ai-route') }}">AI Route
                                Planner</a></li>
                    </ul>
                </div>

                <div id="kontak">
                    <p class="mb-6 text-xs font-black uppercase tracking-[0.2em] text-slate-900">Kontak Kami</p>
                    <ul class="space-y-4 text-sm font-semibold text-slate-500">
                        <li class="flex items-center gap-3">
                            <svg class="h-4 w-4 text-cyan-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            support@citysync.id
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="h-4 w-4 text-emerald-600" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            +62 811 1234 5678
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="h-4 w-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Jakarta Selatan, ID
                        </li>
                    </ul>
                </div>
            </div>

            <div
                class="mt-16 flex flex-col gap-4 border-t border-slate-100 pt-8 text-xs font-semibold text-slate-400 sm:flex-row sm:items-center sm:justify-between">
                <p>&copy; {{ date('Y') }} CitySync AI Companion. All rights reserved.</p>
                <div class="flex items-center gap-4">
                    <span>Powered by Laravel</span>
                    <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                    <span>Tailwind CSS</span>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
