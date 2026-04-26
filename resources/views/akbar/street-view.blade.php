<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akbar Street View Demo</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100">
<main class="mx-auto w-full max-w-[1600px] p-4 md:p-6 lg:p-8">
    <header class="mb-6 rounded-xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-900">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold">Akbar - Google Street View</h1>
                <p class="mt-2 text-sm text-slate-600 dark:text-slate-300">
                    Versi sederhana menggunakan Google Maps Embed (iframe), tanpa Maps JavaScript API kompleks.
                </p>
            </div>
            <a href="{{ route('akbar.ai-monitor.index') }}" class="inline-flex rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                Buka AI Monitor
            </a>
        </div>
    </header>

    <section class="grid grid-cols-1 gap-4 xl:grid-cols-12">
        <article class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-900 xl:col-span-3">
            <h2 class="mb-4 text-lg font-semibold">Pengaturan Embed</h2>
            <label for="street-view-location" class="mb-2 block text-sm font-medium">Contoh Street View</label>
            <select
                id="street-view-location"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800"
                aria-label="Pilih contoh embed street view"
            >
                @foreach ($locations as $location)
                    <option value="{{ $location['embed_url'] }}">
                        {{ $location['name'] }}
                    </option>
                @endforeach
            </select>

            <label for="street-view-embed-url" class="mt-4 mb-2 block text-sm font-medium">
                URL Embed (iframe src)
            </label>
            <textarea
                id="street-view-embed-url"
                rows="6"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-slate-600 dark:bg-slate-800"
                aria-label="URL embed street view"
            >{{ $defaultLocation['embed_url'] }}</textarea>

            <button
                id="apply-embed-url"
                type="button"
                class="mt-4 inline-flex w-full items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                aria-label="Terapkan URL embed"
            >
                Terapkan Embed
            </button>

            <p id="street-view-status" class="mt-3 text-sm text-slate-600 dark:text-slate-300" role="status" aria-live="polite">
                Siap menampilkan street view embed.
            </p>

            <p class="mt-5 rounded-lg bg-amber-50 p-3 text-xs text-amber-800 dark:bg-amber-900/40 dark:text-amber-200">
                Gunakan URL dari atribut `src` pada iframe Google Maps Embed.
                Contoh format: `https://www.google.com/maps/embed?pb=...`
            </p>
        </article>

        <article class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-700 dark:bg-slate-900 xl:col-span-9">
            <h2 class="mb-4 text-lg font-semibold">Viewer</h2>
            <div id="street-view-error" class="mb-3 hidden rounded-lg bg-red-50 px-3 py-2 text-sm text-red-700 dark:bg-red-900/40 dark:text-red-200"></div>
            <iframe
                id="akbar-street-view"
                class="h-[65vh] min-h-[520px] w-full rounded-lg border border-slate-200 dark:border-slate-700 xl:h-[78vh] xl:min-h-[760px]"
                src="{{ $defaultLocation['embed_url'] }}"
                style="border:0;"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                title="Google Street View Embed"
            ></iframe>
        </article>
    </section>
</main>

<script>
    (function () {
        const exampleSelect = document.getElementById('street-view-location');
        const embedInput = document.getElementById('street-view-embed-url');
        const applyButton = document.getElementById('apply-embed-url');
        const frame = document.getElementById('akbar-street-view');
        const errorEl = document.getElementById('street-view-error');
        const statusEl = document.getElementById('street-view-status');

        function setError(message) {
            if (!message) {
                errorEl.classList.add('hidden');
                errorEl.textContent = '';
                return;
            }

            errorEl.textContent = message;
            errorEl.classList.remove('hidden');
        }

        function applyEmbed() {
            const url = embedInput.value.trim();

            if (!url.startsWith('https://www.google.com/maps/embed')) {
                setError('URL tidak valid. Gunakan URL iframe Google Maps Embed.');
                statusEl.textContent = 'Gagal memuat embed.';
                return;
            }

            setError('');
            frame.src = url;
            statusEl.textContent = 'Street view embed berhasil diperbarui.';
        }

        exampleSelect.addEventListener('change', function () {
            embedInput.value = exampleSelect.value;
        });

        applyButton.addEventListener('click', applyEmbed);
    })();
</script>
</body>
</html>
