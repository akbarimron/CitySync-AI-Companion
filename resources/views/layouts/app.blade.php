<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="dicoding:email" content="ryanyanuarpradana@gmail.com">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sivi Companion — Smart tourism OS powered by AI for Jakarta.">
    <title>@yield('title', 'Sivi Companion')</title>

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

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .glass {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.75);
        }

        .nav-glow {
            box-shadow: 0 10px 30px rgba(2, 132, 199, 0.08);
        }
    </style>
</head>

<body class="min-h-screen overflow-x-hidden bg-[#f7fbff] text-slate-900">

    {{-- NAVBAR --}}
    <header class="fixed top-0 z-50 w-full border-b border-white/60 glass nav-glow">
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

            {{-- BRAND --}}
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-cyan-500 to-emerald-500"></div>
                <div class="leading-tight">
                    <div class="text-sm font-black">Sivi</div>
                    <div class="text-xs text-slate-500">Smart Tourism OS</div>
                </div>
            </a>

            {{-- NAV LINKS --}}
            <div class="hidden items-center gap-2 lg:flex">
                @php
                    $nav = [
                        ['/', 'Beranda'],
                        ['/features', 'Fitur'],
                        ['/destinations', 'Destinasi'],
                        ['/scheduling', 'Planner'],
                        ['/#faq', 'FAQ'],
                        ['/#kontak', 'Kontak'],
                    ];
                @endphp

                @foreach ($nav as [$link, $label])
                    <a href="{{ url($link) }}"
                       class="rounded-full px-4 py-2 text-sm font-semibold transition
                       {{ request()->fullUrlIs(url($link))
                            ? 'bg-cyan-500 text-white shadow-md'
                            : 'text-slate-600 hover:bg-cyan-50 hover:text-cyan-700' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            {{-- USER AREA --}}
            <div class="flex items-center gap-3">

                <div class="hidden items-center gap-2 lg:flex">
                    <div class="h-9 w-9 rounded-full bg-gradient-to-br from-cyan-500 to-emerald-500"></div>
                    <div class="text-xs leading-tight">
                        <div class="font-semibold text-slate-800">Username</div>
                        <div class="text-red-500 font-semibold">Logout</div>
                    </div>
                </div>

            </div>

        </nav>
    </header>

    {{-- CONTENT --}}
    <main class="pt-18">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="mt-24 border-t border-slate-200 bg-white py-14">
        <div class="mx-auto grid max-w-7xl gap-10 px-6 md:grid-cols-4">

            <div>
                <div class="text-lg font-black">Sivi</div>
                <p class="mt-2 text-sm text-slate-500">
                    Smart tourism OS berbasis AI untuk pengalaman kota modern yang lebih cerdas dan terhubung.
                </p>
            </div>

            <div>
                <div class="mb-3 text-xs font-bold uppercase tracking-widest text-slate-900">Menu</div>
                <ul class="space-y-2 text-sm text-slate-500">
                    <li><a href="/" class="hover:text-cyan-600">Beranda</a></li>
                    <li><a href="/features" class="hover:text-cyan-600">Fitur</a></li>
                    <li><a href="/destinations" class="hover:text-cyan-600">Destinasi</a></li>
                </ul>
            </div>

            <div>
                <div class="mb-3 text-xs font-bold uppercase tracking-widest text-slate-900">Platform</div>
                <ul class="space-y-2 text-sm text-slate-500">
                    <li><a href="/street-view" class="hover:text-cyan-600">Street View</a></li>
                    <li><a href="/ai-route" class="hover:text-cyan-600">AI Route Planner</a></li>
                </ul>
            </div>

            <div id="kontak">
                <div class="mb-3 text-xs font-bold uppercase tracking-widest text-slate-900">Kontak</div>
                <div class="space-y-2 text-sm text-slate-500">
                    <div>support@sivi.id</div>
                    <div>+62 811 1234 5678</div>
                    <div>Jakarta, Indonesia</div>
                </div>
            </div>

        </div>

        <div class="mt-12 border-t border-slate-100 pt-6 text-center text-xs text-slate-400">
            © {{ date('Y') }} Sivi Companion. All rights reserved.
        </div>
    </footer>

</body>
</html>
