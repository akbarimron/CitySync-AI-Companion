@extends('layouts.app')

@section('title', 'Fitur — Sivi AI')

@section('content')
<section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-cyan-950 to-emerald-950 pt-28 pb-20 text-white md:pt-32">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(34,211,238,0.18),transparent_28%),radial-gradient(circle_at_top_right,rgba(16,185,129,0.18),transparent_28%)]"></div>
    <div class="absolute left-8 top-10 h-64 w-64 rounded-full bg-cyan-400/20 blur-3xl"></div>
    <div class="absolute right-10 top-24 h-72 w-72 rounded-full bg-emerald-400/20 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex flex-wrap items-center gap-3 text-sm text-cyan-100/80">
            <a href="{{ url('/') }}" class="rounded-full bg-white/5 px-4 py-2 font-semibold ring-1 ring-white/10 transition-colors hover:bg-white/10">Beranda</a>
            <span class="text-cyan-200">/</span>
            <span class="rounded-full bg-cyan-400/10 px-4 py-2 font-semibold text-cyan-100 ring-1 ring-cyan-300/20">Fitur</span>
        </div>

        <div class="grid gap-10 lg:grid-cols-[minmax(0,1.1fr)_minmax(0,0.9fr)] lg:items-center">
            <div class="space-y-6">
                <div class="inline-flex items-center gap-2 rounded-full border border-cyan-300/20 bg-cyan-400/10 px-4 py-2 text-xs font-black uppercase tracking-[0.24em] text-cyan-100">
                    Platform features
                </div>
                <h1 class="max-w-4xl text-4xl font-black leading-[1.05] sm:text-5xl lg:text-6xl">Satu halaman khusus untuk semua fitur Sivi AI</h1>
                <p class="max-w-3xl text-base leading-8 text-slate-200 sm:text-lg">
                    Lima pillar produk kini ditarik langsung dari SQL, sehingga tampilan home, dashboard, dan halaman fitur punya sumber data yang sama.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ url('/destinations') }}" class="rounded-full bg-white px-5 py-3 text-sm font-black text-slate-900 transition-transform hover:-translate-y-0.5">Jelajahi Destinasi</a>
                    <a href="{{ url('/destinations/1#ai-monitor') }}" class="rounded-full border border-white/20 bg-white/5 px-5 py-3 text-sm font-black text-white transition-colors hover:bg-white/10">Lihat Dashboard Destinasi</a>
                </div>
            </div>

            <div class="rounded-[2rem] border border-white/10 bg-white/10 p-6 shadow-2xl backdrop-blur-xl">
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-4 lg:grid-cols-2">
                    <div class="rounded-3xl bg-white/5 p-4 ring-1 ring-white/10">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-300">Destinasi</p>
                        <p class="mt-2 text-3xl font-black text-white">{{ $pageStats['destinations'] ?? 0 }}</p>
                    </div>
                    <div class="rounded-3xl bg-white/5 p-4 ring-1 ring-white/10">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-300">Kategori</p>
                        <p class="mt-2 text-3xl font-black text-white">{{ $pageStats['categories'] ?? 0 }}</p>
                    </div>
                    <div class="rounded-3xl bg-white/5 p-4 ring-1 ring-white/10">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-300">Perangkat aktif</p>
                        <p class="mt-2 text-3xl font-black text-white">{{ $pageStats['devices'] ?? 0 }}</p>
                    </div>
                    <div class="rounded-3xl bg-white/5 p-4 ring-1 ring-white/10">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-300">Signal</p>
                        <p class="mt-2 text-3xl font-black text-white">{{ $pageStats['signals'] ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-[linear-gradient(180deg,#f8fcff_0%,#f3f8fd_100%)] py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-12 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-3xl space-y-4">
                <p class="text-xs font-black uppercase tracking-[0.24em] text-cyan-700">Pillar Produk</p>
                <h2 class="text-3xl font-black text-slate-900 sm:text-4xl">Fitur disusun dari data SQL, bukan hardcode halaman</h2>
                <p class="text-base leading-8 text-slate-600">Setiap kartu di bawah bisa dipakai ulang di home, halaman fitur, dan section highlight lain tanpa menggandakan isi manual.</p>
            </div>
            <a href="#destinations-highlight" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-black text-slate-700 shadow-sm transition-colors hover:bg-slate-50">
                Lihat destinasi terkait
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        @php
            $featureStyles = [
                'cyan' => ['wrapper' => 'bg-cyan-100 text-cyan-600', 'label' => 'text-cyan-600'],
                'emerald' => ['wrapper' => 'bg-emerald-100 text-emerald-600', 'label' => 'text-emerald-600'],
                'teal' => ['wrapper' => 'bg-teal-100 text-teal-600', 'label' => 'text-teal-600'],
                'blue' => ['wrapper' => 'bg-blue-100 text-blue-600', 'label' => 'text-blue-600'],
                'violet' => ['wrapper' => 'bg-violet-100 text-violet-600', 'label' => 'text-violet-600'],
                'rose' => ['wrapper' => 'bg-rose-100 text-rose-600', 'label' => 'text-rose-600'],
            ];
        @endphp

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-5">
            @foreach ($features as $feature)
                @php
                    $featureStyle = $featureStyles[$feature['accent_color']] ?? $featureStyles['cyan'];
                @endphp

                <article class="group flex h-full flex-col rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-[0_20px_60px_rgba(15,23,42,0.06)] transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_24px_80px_rgba(15,23,42,0.1)]">
                    <div class="mb-6 flex h-14 w-14 items-center justify-center rounded-2xl {{ $featureStyle['wrapper'] }}">
                        @switch($feature['icon_key'])
                            @case('assistant')
                                <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/></svg>
                                @break
                            @case('crowd')
                                <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-13c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z"/></svg>
                                @break
                            @case('preview')
                                <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-13a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6z"/></svg>
                                @break
                            @case('booking')
                                <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-5-9h10v2H7z"/></svg>
                                @break
                            @default
                                <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-13c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zm0 8c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z"/></svg>
                        @endswitch
                    </div>

                    <div class="flex-1 space-y-4">
                        <div>
                            <p class="text-xs font-black uppercase tracking-[0.22em] text-slate-400">Feature {{ str_pad((string) ($feature['sort_order'] ?? 0), 2, '0', STR_PAD_LEFT) }}</p>
                            <h3 class="mt-2 text-xl font-black text-slate-900">{{ $feature['name'] }}</h3>
                        </div>
                        <p class="text-sm leading-7 text-slate-600">{{ $feature['description'] }}</p>
                    </div>

                    <div class="mt-6 border-t border-slate-100 pt-4">
                        <span class="text-xs font-black uppercase tracking-[0.2em] {{ $featureStyle['label'] }}">Online layer</span>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section id="destinations-highlight" class="py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-12 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-3xl space-y-4">
                <p class="text-xs font-black uppercase tracking-[0.24em] text-cyan-700">Destinasi Terkait</p>
                <h2 class="text-3xl font-black text-slate-900 sm:text-4xl">Fitur terasa nyata ketika terhubung ke destinasi yang aktif</h2>
                <p class="text-base leading-8 text-slate-600">Contoh destinasi di bawah juga ditarik dari SQL yang sama, sehingga layer preview, booking, dan monitor selalu sinkron.</p>
            </div>
            <a href="{{ url('/destinations') }}" class="inline-flex items-center gap-2 rounded-full bg-slate-950 px-5 py-3 text-sm font-black text-white transition-transform hover:-translate-y-0.5">
                Buka daftar destinasi
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
            @foreach ($featuredDestinations as $destination)
                <article class="group overflow-hidden rounded-[1.75rem] border border-slate-200 bg-white shadow-[0_20px_60px_rgba(15,23,42,0.06)]">
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ $destination['image_url'] }}" alt="{{ $destination['name'] }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4 flex items-end justify-between gap-3">
                            <div>
                                <p class="text-xs font-black uppercase tracking-[0.22em] text-cyan-100">{{ $destination['category'] }}</p>
                                <h3 class="mt-1 text-xl font-black text-white">{{ $destination['name'] }}</h3>
                            </div>
                            <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-black text-white ring-1 ring-white/20">{{ $destination['rating'] }}</span>
                        </div>
                    </div>
                    <div class="space-y-4 p-5">
                        <p class="text-sm leading-7 text-slate-600">{{ $destination['preview_copy'] }}</p>
                        <div class="flex items-center justify-between text-sm font-semibold text-slate-500">
                            <span>{{ $destination['area'] }}</span>
                            <span>{{ $destination['price'] > 0 ? 'Rp ' . number_format($destination['price'], 0, ',', '.') : 'Gratis' }}</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-gradient-to-r from-cyan-600 to-emerald-600 py-16 text-white">
    <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
        <h2 class="text-3xl font-black sm:text-4xl">Siap memakai semua fitur dari data SQL</h2>
        <p class="mx-auto mt-4 max-w-2xl text-cyan-100 leading-8">Home, fitur, street view, AI monitor, dan dashboard destinasi sekarang bisa membaca dataset yang sama dari MySQL.</p>
        <div class="mt-8 flex flex-col justify-center gap-4 sm:flex-row">
            <a href="{{ url('/destinations') }}" class="rounded-full bg-white px-6 py-3 text-sm font-black text-cyan-700 transition-transform hover:-translate-y-0.5">Mulai dari Destinasi</a>
            <a href="{{ url('/destinations/1#ai-monitor') }}" class="rounded-full border border-white/30 bg-white/10 px-6 py-3 text-sm font-black text-white transition-colors hover:bg-white/15">Lihat Dashboard Terpadu</a>
        </div>
    </div>
</section>
@endsection
