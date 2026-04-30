@extends('layouts.app')

@section('title', 'Street View 360° — Sivi AI')

@section('content')
@php
    $streetViewCards = [];
    foreach ($destinations as $destination) {
        $streetViewCards[$destination['slug']] = $destination;
    }

    $activeDestination = $defaultDestination ?? $destinations->first();
@endphp

<section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-cyan-950 to-emerald-950 pt-28 pb-20 text-white md:pt-32">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(34,211,238,0.18),transparent_28%),radial-gradient(circle_at_top_right,rgba(16,185,129,0.18),transparent_28%)]"></div>
    <div class="absolute left-8 top-10 h-64 w-64 rounded-full bg-cyan-400/20 blur-3xl"></div>
    <div class="absolute right-10 top-24 h-72 w-72 rounded-full bg-emerald-400/20 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <a href="{{ url('/') }}" class="mb-8 inline-flex items-center gap-2 text-sm font-bold text-cyan-300 transition-colors hover:text-cyan-200">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Beranda
        </a>

        <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-cyan-500/30 bg-cyan-500/10 px-4 py-2 backdrop-blur-sm">
            <svg class="h-4 w-4 text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-xs font-bold uppercase tracking-widest text-cyan-300">Live 360° Street View</span>
        </div>

        <div class="grid gap-10 lg:grid-cols-[minmax(0,1.1fr)_minmax(0,0.9fr)] lg:items-center">
            <div class="space-y-6">
                <h1 class="text-4xl font-black leading-tight text-white sm:text-5xl lg:text-6xl">
                    Jelajahi destinasi
                    <span class="block bg-gradient-to-r from-cyan-400 via-emerald-400 to-blue-400 bg-clip-text text-transparent">
                        dengan Street View 360°
                    </span>
                </h1>
                <p class="max-w-2xl text-lg leading-8 text-slate-300">
                    Pilih destinasi dari database yang sama dengan home dan dashboard destinasi, lalu lihat tampilan lokasi secara interaktif sebelum berkunjung.
                </p>

                <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
                        <div class="text-3xl font-black text-cyan-400">{{ number_format($destinations->count()) }}</div>
                        <p class="text-sm text-slate-400">Destinasi aktif</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
                        <div class="text-3xl font-black text-emerald-400">{{ number_format($destinations->where('is_featured', true)->count()) }}</div>
                        <p class="text-sm text-slate-400">Featured</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
                        <div class="text-3xl font-black text-blue-400">{{ number_format($activeDestination['crowd'] ?? 0) }}%</div>
                        <p class="text-sm text-slate-400">Crowd default</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
                        <div class="text-3xl font-black text-violet-400">{{ number_format($activeDestination['rating'] ?? 0, 1) }}</div>
                        <p class="text-sm text-slate-400">Rating awal</p>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-[2rem] border border-white/10 bg-slate-950/70 shadow-2xl backdrop-blur-xl">
                <div class="flex items-center justify-between border-b border-white/10 px-5 py-4">
                    <div class="flex items-center gap-2 text-xs font-black uppercase tracking-[0.22em] text-cyan-100/80">
                        <span class="h-2 w-2 rounded-full bg-emerald-300"></span>
                        Street View stack
                    </div>
                    <span class="rounded-full bg-white/10 px-3 py-1 text-[10px] font-black uppercase tracking-[0.22em] text-white">SQL synced</span>
                </div>
                <div class="space-y-4 p-5">
                    <div class="rounded-3xl bg-gradient-to-br from-cyan-500/15 to-emerald-500/15 p-5 ring-1 ring-white/10">
                        <p class="text-xs font-black uppercase tracking-[0.22em] text-cyan-100/80">Active location</p>
                        <p id="hero-selected-name" class="mt-3 text-xl font-black text-white">{{ $activeDestination['name'] ?? 'Street View 360' }}</p>
                        <p id="hero-selected-desc" class="mt-2 text-sm leading-7 text-slate-300">{{ $activeDestination['preview_copy'] ?? '' }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="rounded-3xl bg-white/5 p-4 ring-1 ring-white/10">
                            <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-300">Area</p>
                            <p id="hero-selected-area" class="mt-2 text-sm font-bold text-white">{{ $activeDestination['area'] ?? '' }}</p>
                        </div>
                        <div class="rounded-3xl bg-white/5 p-4 ring-1 ring-white/10">
                            <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-300">Best time</p>
                            <p id="hero-selected-best-time" class="mt-2 text-sm font-bold text-white">{{ $activeDestination['best_time'] ?? '' }}</p>
                        </div>
                    </div>
                    <a href="#street-view-viewer" class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-white px-5 py-3 text-sm font-black text-slate-900 transition-transform hover:-translate-y-0.5">
                        Lihat preview 360 lengkap
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-slate-50 py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[minmax(0,0.9fr)_minmax(0,1.1fr)]">
            <aside class="space-y-4">
                <div class="flex items-center gap-2 rounded-2xl border border-emerald-300 bg-emerald-100 px-4 py-3">
                    <span class="h-3 w-3 flex-shrink-0 rounded-full bg-emerald-500 animate-pulse"></span>
                    <div>
                        <p class="text-sm font-bold leading-tight text-emerald-900">Street View aktif</p>
                        <p class="text-xs text-emerald-700">Klik destinasi untuk memindahkan preview</p>
                    </div>
                </div>

                <div class="space-y-3" id="dest-list">
                    @foreach ($destinations as $destination)
                        <button
                            onclick="selectDestination('{{ $destination['slug'] }}', this)"
                            data-dest="{{ $destination['slug'] }}"
                            class="street-destination-card w-full rounded-2xl border-2 border-transparent bg-white p-4 text-left shadow-md transition-all duration-300 hover:border-cyan-400 hover:shadow-lg {{ $loop->first ? 'active border-cyan-500 border-l-4 pl-3' : '' }}">
                            <div class="flex items-start gap-3">
                                <img src="{{ $destination['image_url'] }}" alt="{{ $destination['name'] }}" class="h-16 w-16 flex-shrink-0 rounded-xl object-cover transition-transform group-hover:scale-105">
                                <div class="min-w-0 flex-1">
                                    <div class="mb-1 flex items-center justify-between gap-3">
                                        <h3 class="truncate text-sm font-black text-slate-900">{{ $destination['name'] }}</h3>
                                        <span class="rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-black uppercase tracking-[0.18em] text-slate-600">{{ $destination['rating'] }}</span>
                                    </div>
                                    <p class="mb-2 text-xs text-slate-500">{{ $destination['area'] }}</p>
                                    <p class="line-clamp-2 text-sm leading-6 text-slate-600">{{ $destination['preview_copy'] }}</p>
                                    <div class="mt-3 flex items-center gap-2 text-xs font-bold text-slate-500">
                                        <span class="rounded-full bg-emerald-100 px-2 py-0.5 text-emerald-700">Crowd {{ $destination['crowd'] }}%</span>
                                        <span>{{ $destination['weather'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>

                <a href="{{ url('/destinations/' . ($activeDestination['id'] ?? 1)) }}" class="flex items-center justify-center gap-2 rounded-2xl bg-slate-900 px-4 py-3 text-sm font-black text-white shadow-lg transition-colors hover:bg-slate-800">
                    Buka dashboard destinasi
                    <svg class="h-4 w-4 text-cyan-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </aside>

            <main id="street-view-viewer" class="space-y-6">
                <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-lg">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <div class="mb-2 flex items-center gap-3">
                                <h2 id="sv-dest-name" class="text-2xl font-black text-slate-900">{{ $activeDestination['name'] ?? '' }}</h2>
                                <span id="sv-crowd-badge" class="rounded-full px-3 py-1 text-xs font-black uppercase tracking-[0.18em] bg-emerald-100 text-emerald-700">Crowd {{ $activeDestination['crowd'] ?? 0 }}%</span>
                            </div>
                            <p id="sv-dest-location" class="flex items-center gap-1 text-sm text-slate-500">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                                {{ $activeDestination['address'] ?? '' }}
                            </p>
                        </div>
                        <div class="flex flex-wrap items-center gap-3">
                            <a id="sv-maps-link" href="{{ $activeDestination['street_view_url'] ?? '#' }}" target="_blank" rel="noreferrer" class="inline-flex items-center gap-2 rounded-xl bg-cyan-500 px-4 py-2 text-sm font-bold text-white transition-colors hover:bg-cyan-600">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                Buka Street View
                            </a>
                            <div class="rounded-lg bg-slate-100 px-3 py-2 text-xs font-bold text-slate-700">
                                <span class="inline-flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                Live Preview
                            </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-900 shadow-2xl relative">
                    <div class="flex items-center justify-between border-b border-slate-700 bg-slate-800 px-5 py-3">
                        <div class="flex items-center gap-2">
                            <div class="h-3 w-3 rounded-full bg-red-500"></div>
                            <div class="h-3 w-3 rounded-full bg-yellow-500"></div>
                            <div class="h-3 w-3 rounded-full bg-emerald-500"></div>
                        </div>
                        <div class="flex max-w-[16rem] items-center gap-2 rounded-lg border border-slate-600 bg-slate-700 px-3 py-1.5">
                            <svg class="h-3.5 w-3.5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            <span id="sv-iframe-url" class="truncate font-mono text-xs text-slate-300">{{ $activeDestination['street_view_url'] ?? '' }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs font-bold text-slate-400">
                            <span class="h-2 w-2 rounded-full bg-cyan-400 animate-pulse"></span>
                            360° ACTIVE
                        </div>
                    </div>

                    <div id="sv-loading" class="absolute inset-0 top-12 z-10 flex flex-col items-center justify-center bg-slate-900 transition-opacity duration-500">
                        <div class="mb-4 h-16 w-16 animate-spin rounded-full border-4 border-cyan-500 border-t-transparent"></div>
                        <p class="font-bold text-slate-400">Memuat Street View...</p>
                        <p class="mt-1 text-sm text-slate-500">Menghubungkan ke Google Street View</p>
                    </div>

                    <iframe
                        id="sv-iframe"
                        class="block w-full"
                        style="height: 70vh; min-height: 520px; border: none;"
                        src="{{ isset($activeDestination['street_view_url']) ? $activeDestination['street_view_url'] . '&output=svembed' : '' }}"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Google Street View"
                        onload="document.getElementById('sv-loading').style.opacity='0'; setTimeout(() => document.getElementById('sv-loading').style.display='none', 500);"
                    ></iframe>
                </div>

                <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                    <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow">
                        <p class="mb-2 text-xs font-black uppercase tracking-widest text-slate-500">Koordinat GPS</p>
                        <p id="sv-coords" class="font-mono text-lg font-bold text-emerald-700">{{ $activeDestination ? $activeDestination['lat'] . '°, ' . $activeDestination['lng'] . '°' : '-' }}</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow">
                        <p class="mb-2 text-xs font-black uppercase tracking-widest text-slate-500">Alamat</p>
                        <p id="sv-address" class="text-sm font-semibold text-slate-900">{{ $activeDestination['address'] ?? '' }}</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow">
                        <p class="mb-2 text-xs font-black uppercase tracking-widest text-slate-500">Jam buka</p>
                        <p id="sv-opening-hours" class="text-sm font-semibold text-slate-900">{{ $activeDestination['opening_hours'] ?? '' }}</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow">
                        <p class="mb-2 text-xs font-black uppercase tracking-widest text-slate-500">Waktu terbaik</p>
                        <p id="sv-best-time" class="text-sm font-semibold text-slate-900">{{ $activeDestination['best_time'] ?? '' }}</p>
                    </div>
                </div>

                <div class="grid gap-4 xl:grid-cols-[minmax(0,1.1fr)_minmax(0,0.9fr)]">
                    <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow">
                        <p class="mb-2 text-xs font-black uppercase tracking-widest text-slate-500">Ringkasan destinasi</p>
                        <h3 id="sv-summary-title" class="text-2xl font-black text-slate-900">{{ $activeDestination['name'] ?? '' }}</h3>
                        <p id="sv-summary-copy" class="mt-3 leading-8 text-slate-600">{{ $activeDestination['preview_copy'] ?? '' }}</p>
                    </div>
                    <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow">
                        <p class="mb-2 text-xs font-black uppercase tracking-widest text-slate-500">Tips singkat</p>
                        <p id="sv-tip" class="leading-8 text-slate-700">{{ $activeDestination['tip'] ?? '' }}</p>
                        <div class="mt-5 flex flex-wrap gap-3">
                            <a href="{{ url('/destinations/' . ($activeDestination['id'] ?? 1)) }}" class="inline-flex items-center gap-2 rounded-full bg-slate-950 px-5 py-3 text-sm font-black text-white transition-transform hover:-translate-y-0.5">
                                Lihat dashboard destinasi
                            </a>
                            <a href="{{ url('/features') }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-black text-slate-700 transition-colors hover:bg-slate-50">
                                Buka fitur
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</section>

<script>
    const streetViewData = @json($streetViewCards);

    function selectDestination(destinationId, cardElement) {
        const data = streetViewData[destinationId];

        if (!data) {
            return;
        }

        document.getElementById('sv-dest-name').textContent = data.name;
        document.getElementById('sv-dest-location').textContent = data.address || data.area || '';
        document.getElementById('sv-crowd-badge').textContent = `Crowd ${data.crowd ?? 0}%`;
        document.getElementById('sv-iframe').src = data.street_view_url ? data.street_view_url + '&output=svembed' : '';
        document.getElementById('sv-iframe-url').textContent = data.street_view_url || '';
        document.getElementById('sv-coords').textContent = `${Number(data.lat).toFixed(4)}°, ${Number(data.lng).toFixed(4)}°`;
        document.getElementById('sv-address').textContent = data.address || '';
        document.getElementById('sv-opening-hours').textContent = data.opening_hours || '';
        document.getElementById('sv-best-time').textContent = data.best_time || '';
        document.getElementById('sv-summary-title').textContent = data.name;
        document.getElementById('sv-summary-copy').textContent = data.preview_copy || data.description || '';
        document.getElementById('sv-tip').textContent = data.tip || '';
        document.getElementById('sv-maps-link').href = data.street_view_url || '#';
        document.getElementById('sv-loading').style.display = 'flex';
        document.getElementById('sv-loading').style.opacity = '1';

        const crowd = Number(data.crowd ?? 0);
        const badge = document.getElementById('sv-crowd-badge');
        badge.classList.remove('bg-emerald-100', 'text-emerald-700', 'bg-amber-100', 'text-amber-700', 'bg-red-100', 'text-red-700');

        if (crowd >= 80) {
            badge.classList.add('bg-red-100', 'text-red-700');
        } else if (crowd >= 60) {
            badge.classList.add('bg-amber-100', 'text-amber-700');
        } else {
            badge.classList.add('bg-emerald-100', 'text-emerald-700');
        }

        document.querySelectorAll('.street-destination-card').forEach((card) => {
            card.classList.remove('active', 'border-cyan-500', 'border-l-4', 'pl-3');
        });

        if (cardElement) {
            cardElement.classList.add('active', 'border-cyan-500', 'border-l-4', 'pl-3');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const initialCard = document.querySelector('.street-destination-card.active') || document.querySelector('.street-destination-card');
        const initialId = initialCard?.dataset.dest;

        if (initialId) {
            selectDestination(initialId, initialCard);
        }
    });
</script>
@endsection
