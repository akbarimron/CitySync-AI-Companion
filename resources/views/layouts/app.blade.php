<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CitySync AI Companion — Smart tourism OS powered by AI for Jakarta.">
    <title>@yield('title', 'CitySync AI Companion')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen overflow-x-hidden" style="background: radial-gradient(circle at 15% 8%, rgba(14,165,233,.14), transparent 26rem), radial-gradient(circle at 92% 22%, rgba(16,185,129,.14), transparent 26rem), #f7fbff; color: #0f172a;">

    {{-- ── NAVBAR ──────────────────────────────────────────── --}}
    <header class="cs-navbar" id="cs-navbar">
        <nav class="cs-nav-inner">
            {{-- Brand --}}
            <a href="{{ url('/') }}" class="flex items-center gap-3 group" id="brand-logo-link">
                <span class="flex h-11 w-11 items-center justify-center rounded-2xl text-white shadow-lg shadow-cyan-500/25 transition-transform duration-300 group-hover:-rotate-6 group-hover:scale-105"
                      style="background: linear-gradient(135deg, #0ea5e9, #10b981);">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </span>
                <span class="leading-tight">
                    <span class="block text-sm font-black tracking-tight text-slate-950">CitySync AI</span>
                    <span class="block text-xs font-semibold text-slate-500">Smart tourism OS</span>
                </span>
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden items-center gap-1 lg:flex" id="desktop-nav">
                <a href="{{ url('/') }}" class="rounded-full px-4 py-2 text-sm font-bold text-slate-600 transition-colors duration-200 hover:bg-cyan-50 hover:text-cyan-700">Home</a>
                <a href="{{ url('/#features') }}" class="rounded-full px-4 py-2 text-sm font-bold text-slate-600 transition-colors duration-200 hover:bg-cyan-50 hover:text-cyan-700">Features</a>
                <a href="{{ url('/destinations') }}" class="rounded-full px-4 py-2 text-sm font-bold text-slate-600 transition-colors duration-200 hover:bg-cyan-50 hover:text-cyan-700">Destinations</a>
                <a href="{{ url('/street-view') }}" class="rounded-full px-4 py-2 text-sm font-bold text-slate-600 transition-colors duration-200 hover:bg-cyan-50 hover:text-cyan-700">Street View</a>
                <a href="{{ url('/ai-monitor') }}" class="rounded-full px-4 py-2 text-sm font-bold text-slate-600 transition-colors duration-200 hover:bg-cyan-50 hover:text-cyan-700">AI Monitor</a>
                <a href="{{ url('/immersive') }}" class="rounded-full px-4 py-2 text-sm font-bold text-slate-600 transition-colors duration-200 hover:bg-cyan-50 hover:text-cyan-700">Immersive</a>
                <a href="{{ url('/ai-route') }}" class="rounded-full px-4 py-2 text-sm font-bold text-slate-600 transition-colors duration-200 hover:bg-cyan-50 hover:text-cyan-700">AI Route</a>
            </div>

            {{-- Actions --}}
            <div class="hidden items-center gap-3 sm:flex">
                <a href="{{ route('akbar.street-view.index') }}"
                   class="flex items-center gap-2 rounded-full px-5 py-2.5 text-sm font-black text-white shadow-xl shadow-cyan-950/15 transition-transform duration-300 hover:-translate-y-0.5"
                   style="background: #0f172a;">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M4 6h7a2 2 0 012 2v8a2 2 0 01-2 2H4V6z"/>
                    </svg>
                    Live 360°
                </a>
            </div>

            {{-- Mobile Toggle --}}
            <button id="mobile-menu-btn" type="button" aria-label="Toggle menu" aria-expanded="false"
                    class="inline-flex h-11 w-11 items-center justify-center rounded-2xl text-white transition-transform duration-300 hover:scale-105 lg:hidden"
                    style="background: #0f172a;">
                <svg id="menu-icon-open" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="menu-icon-close" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </nav>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden mt-3 mx-auto max-w-[80rem] rounded-2xl border border-white/80 p-3 shadow-2xl backdrop-blur-2xl" style="background: rgba(255,255,255,0.92);">
            <a href="{{ url('/') }}" class="block rounded-xl px-4 py-3 text-sm font-bold text-slate-700 transition-colors hover:bg-cyan-50">Home</a>
            <a href="{{ url('/#features') }}" class="block rounded-xl px-4 py-3 text-sm font-bold text-slate-700 transition-colors hover:bg-cyan-50">Features</a>
            <a href="{{ url('/destinations') }}" class="block rounded-xl px-4 py-3 text-sm font-bold text-slate-700 transition-colors hover:bg-cyan-50">Destinations</a>
            <a href="{{ url('/street-view') }}" class="block rounded-xl px-4 py-3 text-sm font-bold text-slate-700 transition-colors hover:bg-cyan-50">Street View</a>
            <a href="{{ url('/ai-monitor') }}" class="block rounded-xl px-4 py-3 text-sm font-bold text-slate-700 transition-colors hover:bg-cyan-50">AI Monitor</a>
            <a href="{{ url('/immersive') }}" class="block rounded-xl px-4 py-3 text-sm font-bold text-slate-700 transition-colors hover:bg-cyan-50">Immersive</a>
            <a href="{{ url('/ai-route') }}" class="block rounded-xl px-4 py-3 text-sm font-bold text-slate-700 transition-colors hover:bg-cyan-50">AI Route</a>
            <a href="{{ route('akbar.street-view.index') }}" class="mt-2 flex w-full items-center justify-center gap-2 rounded-full py-3 text-sm font-black text-white" style="background:#0f172a;">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M4 6h7a2 2 0 012 2v8a2 2 0 01-2 2H4V6z"/>
                </svg>
                Live 360°
            </a>
        </div>
    </header>

    {{-- ── CONTENT ─────────────────────────────────────────── --}}
    <main>
        @yield('content')
    </main>

    {{-- ── MOBILE MENU JS ──────────────────────────────────── --}}
    <script>
        (function () {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            const iconOpen = document.getElementById('menu-icon-open');
            const iconClose = document.getElementById('menu-icon-close');
            btn.addEventListener('click', function () {
                const isOpen = !menu.classList.contains('hidden');
                menu.classList.toggle('hidden', isOpen);
                iconOpen.classList.toggle('hidden', !isOpen);
                iconClose.classList.toggle('hidden', isOpen);
                btn.setAttribute('aria-expanded', String(!isOpen));
            });
            // Close on link click
            menu.querySelectorAll('a').forEach(function (a) {
                a.addEventListener('click', function () {
                    menu.classList.add('hidden');
                    iconOpen.classList.remove('hidden');
                    iconClose.classList.add('hidden');
                    btn.setAttribute('aria-expanded', 'false');
                });
            });
        })();
    </script>

    @stack('scripts')
</body>
</html>