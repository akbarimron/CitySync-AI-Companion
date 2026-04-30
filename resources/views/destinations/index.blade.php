@extends('layouts.app')

@section('title', 'Destinations - Sivi AI')

@section('content')
<div class="bg-base-100 min-h-screen">

    <!-- HERO SECTION -->
    <section class="relative py-14 md:py-20 bg-gradient-to-br from-cyan-50 via-slate-50 to-emerald-50 overflow-hidden">
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-20 left-10 w-72 h-72 bg-cyan-200 rounded-full mix-blend-multiply filter blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-72 h-72 bg-emerald-200 rounded-full mix-blend-multiply filter blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-[2rem] border border-white/70 bg-white/80 p-6 shadow-[0_20px_80px_rgba(15,23,42,0.08)] backdrop-blur-xl md:p-10">
                <div class="text-center space-y-5">
                    <div class="inline-flex items-center gap-2 rounded-full bg-cyan-100 px-4 py-2">
                        <span class="text-xs font-black uppercase tracking-[0.22em] text-cyan-700">Destinasi Curated</span>
                    </div>
                    <h1 class="text-4xl font-black leading-tight tracking-tight sm:text-5xl lg:text-6xl">
                        <span class="block bg-gradient-to-r from-cyan-600 via-blue-600 to-emerald-600 bg-clip-text text-transparent">
                            Jelajahi Destinasi Wisata
                        </span>
                        <span class="mt-2 block text-slate-900">Jakarta Bersama AI</span>
                    </h1>

                    <p class="mx-auto max-w-3xl text-lg leading-relaxed text-slate-600">
                        Temukan destinasi impian dengan preview 360, cuaca real-time, analisis kepadatan, dan booking demo yang lebih rapi.
                    </p>

                    <!-- Search Bar -->
                    <div class="mx-auto max-w-2xl pt-2">
                        <div class="flex flex-col gap-3 rounded-[1.5rem] border border-slate-200 bg-white p-3 shadow-sm sm:flex-row">
                            <input
                                type="text"
                                id="search-input"
                                placeholder="🔍 Cari destinasi favorit..."
                                class="flex-1 rounded-full border-0 bg-slate-50 px-6 py-3 focus:ring-2 focus:ring-cyan-400"
                            />
                            <button
                                id="search-btn"
                                class="btn btn-primary h-12 rounded-full px-8 font-bold gap-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Cari
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FILTER SECTION -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 class="text-sm font-bold text-slate-600 uppercase tracking-widest mb-4">Kategori</h2>
        <div class="flex flex-wrap gap-3">
            <button class="filter-btn btn btn-sm btn-outline rounded-full transition-all hover:scale-105" data-filter="all">
                ✓ Semua (12)
            </button>
            <button class="filter-btn btn btn-sm btn-outline rounded-full transition-all hover:scale-105" data-filter="budaya">
                🏛️ Budaya (4)
            </button>
            <button class="filter-btn btn btn-sm btn-outline rounded-full transition-all hover:scale-105" data-filter="alam">
                🌿 Alam (3)
            </button>
            <button class="filter-btn btn btn-sm btn-outline rounded-full transition-all hover:scale-105" data-filter="modern">
                🏢 Modern (3)
            </button>
            <button class="filter-btn btn btn-sm btn-outline rounded-full transition-all hover:scale-105" data-filter="hiburan">
                🎢 Hiburan (2)
            </button>
        </div>
    </section>

    <!-- DESTINATIONS GRID -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div id="destinations-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            <!-- Cards akan dimuat via JavaScript -->
        </div>

        <!-- Empty State -->
        <div id="empty-state" class="hidden text-center py-16">
            <div class="inline-block p-4 bg-slate-100 rounded-full mb-6">
                <svg class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-700 mb-2">Destinasi Tidak Ditemukan</h3>
            <p class="text-slate-500">Coba ubah filter atau cari dengan kata kunci yang berbeda</p>
        </div>
    </section>

</div>

<!-- MODAL: Booking -->
<dialog id="booking-modal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box w-full max-w-sm">
        <form method="dialog">
            <button type="button" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>

        <h2 class="font-bold text-2xl mb-6" id="modal-destination-name">Nama Destinasi</h2>

        <!-- Destination Preview -->
        <div class="mb-6 pb-6 border-b">
            <img id="modal-destination-image" src="" alt="" class="w-full h-40 object-cover rounded-xl mb-4" />
            <p id="modal-destination-description" class="text-sm text-slate-600 mb-3 line-clamp-2"></p>
            <div class="flex justify-between items-center">
                <span class="text-2xl font-black text-cyan-600">
                    Rp <span id="modal-base-price">0</span>
                </span>
                <span id="modal-category" class="badge badge-primary badge-lg text-white"></span>
            </div>
        </div>

        <!-- Booking Form -->
        <form class="space-y-5">
            <!-- Tanggal -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-bold">Tanggal Kunjungan</span>
                </label>
                <input type="date" id="booking-date" class="input input-bordered w-full focus:outline-none focus:ring-2 focus:ring-cyan-400" required />
            </div>

            <!-- Jumlah Tiket -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-bold">Jumlah Tiket</span>
                </label>
                <div class="flex items-center justify-center gap-6 bg-slate-100 p-4 rounded-xl">
                    <button type="button" id="decrease-ticket" class="btn btn-circle btn-sm btn-outline">−</button>
                    <span id="ticket-count" class="text-3xl font-black text-slate-900">1</span>
                    <button type="button" id="increase-ticket" class="btn btn-circle btn-sm btn-outline">+</button>
                </div>
            </div>

            <!-- Price Summary -->
            <div class="bg-gradient-to-br from-cyan-50 to-blue-50 p-5 rounded-xl border border-cyan-200">
                <div class="space-y-2 mb-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-600">Harga Satuan</span>
                        <span class="font-bold text-slate-900">Rp <span id="unit-price">0</span></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-600">Jumlah</span>
                        <span class="font-bold text-slate-900"><span id="qty-display">1</span> tiket</span>
                    </div>
                </div>
                <div class="border-t border-cyan-200 pt-3">
                    <div class="flex justify-between">
                        <span class="font-bold text-slate-900">Total</span>
                        <span class="text-2xl font-black text-cyan-600">Rp <span id="total-price">0</span></span>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text text-sm">Catatan Khusus (Opsional)</span>
                </label>
                <textarea id="booking-notes" class="textarea textarea-bordered text-sm" placeholder="Misal: grup wisata, kebutuhan khusus, dll" rows="3"></textarea>
            </div>
        </form>

        <!-- Action Buttons -->
        <div class="modal-action mt-8">
            <form method="dialog">
                <button class="btn btn-ghost">Batal</button>
            </form>
            <button id="confirm-booking" class="btn btn-primary text-white">Konfirmasi Booking</button>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button type="button">close</button>
    </form>
</dialog>

<script>
// Sample Data
const destinations = [
    {
        id: 1,
        name: 'Kota Tua Jakarta',
        category: 'budaya',
        description: 'Jelajahi sejarah Jakarta melalui bangunan bersejarah dan arsitektur kolonial yang megah.',
        basePrice: 75000,
        image: 'https://images.unsplash.com/photo-1570129477492-45a003537e90?w=500&h=400&fit=crop',
        latitude: -6.1344,
        longitude: 106.8065,
        rating: 4.5,
        visitors: '2.5K+',
        crowdLevel: 'Tinggi',
        weather: '28°C, Cerah'
    },
    {
        id: 2,
        name: 'Taman Mini Indonesia Indah',
        category: 'alam',
        description: 'Taman tematik dengan miniatur berbagai budaya Indonesia di satu tempat.',
        basePrice: 100000,
        image: 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=500&h=400&fit=crop',
        latitude: -6.2961,
        longitude: 106.8941,
        rating: 4.3,
        visitors: '1.8K+',
        crowdLevel: 'Sedang',
        weather: '27°C, Mendung'
    },
    {
        id: 3,
        name: 'Jakarta Aquarium',
        category: 'hiburan',
        description: 'Akuarium terbesar di Asia Tenggara dengan ratusan spesies laut.',
        basePrice: 120000,
        image: 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=500&h=400&fit=crop',
        latitude: -6.1752,
        longitude: 106.8249,
        rating: 4.6,
        visitors: '3.1K+',
        crowdLevel: 'Sangat Tinggi',
        weather: '29°C, Cerah'
    },
    {
        id: 4,
        name: 'Monumen Nasional',
        category: 'budaya',
        description: 'Monumen ikonik Indonesia yang mewakili kemerdekaan dan persatuan.',
        basePrice: 50000,
        image: 'https://images.unsplash.com/photo-1512207736139-e8c07a4b0a8e?w=500&h=400&fit=crop',
        latitude: -6.1751,
        longitude: 106.8270,
        rating: 4.4,
        visitors: '4.2K+',
        crowdLevel: 'Tinggi',
        weather: '28°C, Cerah'
    },
    {
        id: 5,
        name: 'Atlantis Jakarta',
        category: 'modern',
        description: 'Mall modern dengan fasilitas world-class dan berbagai pilihan belanja dan kuliner.',
        basePrice: 0,
        image: 'https://images.unsplash.com/photo-1555636222-cff0eb3f5e14?w=500&h=400&fit=crop',
        latitude: -6.1765,
        longitude: 106.6288,
        rating: 4.5,
        visitors: '5.0K+',
        crowdLevel: 'Sangat Tinggi',
        weather: '29°C, Cerah'
    },
    {
        id: 6,
        name: 'Kepulauan Seribu',
        category: 'alam',
        description: 'Kepulauan dengan pantai pasir putih dan air laut yang jernih.',
        basePrice: 250000,
        image: 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=500&h=400&fit=crop',
        latitude: -5.9910,
        longitude: 106.6019,
        rating: 4.7,
        visitors: '1.2K+',
        crowdLevel: 'Rendah',
        weather: '30°C, Cerah'
    },
    {
        id: 7,
        name: 'Museum Nasional Indonesia',
        category: 'budaya',
        description: 'Museum terbesar di Asia Tenggara dengan koleksi arkeologi dan etnografi lengkap.',
        basePrice: 30000,
        image: 'https://images.unsplash.com/photo-1564399579883-451a5ddf9c51?w=500&h=400&fit=crop',
        latitude: -6.1925,
        longitude: 106.8235,
        rating: 4.4,
        visitors: '2.0K+',
        crowdLevel: 'Sedang',
        weather: '28°C, Cerah'
    },
    {
        id: 8,
        name: 'Dunia Fantasi (DUFAN)',
        category: 'hiburan',
        description: 'Taman hiburan terbesar di Indonesia dengan wahana seru untuk seluruh keluarga.',
        basePrice: 180000,
        image: 'https://images.unsplash.com/photo-1540932239986-310128078ceb?w=500&h=400&fit=crop',
        latitude: -6.2557,
        longitude: 106.8195,
        rating: 4.6,
        visitors: '3.5K+',
        crowdLevel: 'Sangat Tinggi',
        weather: '28°C, Cerah'
    },
    {
        id: 9,
        name: 'Taman Lansekap Nasional',
        category: 'alam',
        description: 'Taman dengan koleksi tanaman langka dan pemandangan alam yang indah.',
        basePrice: 40000,
        image: 'https://images.unsplash.com/photo-1469090217138-fab0db261e75?w=500&h=400&fit=crop',
        latitude: -6.2744,
        longitude: 106.8057,
        rating: 4.3,
        visitors: '1.0K+',
        crowdLevel: 'Rendah',
        weather: '27°C, Mendung'
    },
    {
        id: 10,
        name: 'Grand Indonesia Shopping Center',
        category: 'modern',
        description: 'Pusat perbelanjaan premium dengan brand internasional dan fasilitas lengkap.',
        basePrice: 0,
        image: 'https://images.unsplash.com/photo-1555636222-cff0eb3f5e14?w=500&h=400&fit=crop',
        latitude: -6.1970,
        longitude: 106.8218,
        rating: 4.4,
        visitors: '4.8K+',
        crowdLevel: 'Sangat Tinggi',
        weather: '29°C, Cerah'
    },
    {
        id: 11,
        name: 'Pulau Tidung',
        category: 'alam',
        description: 'Pulau dengan pantai indah, air jernih, dan aktivitas water sports yang seru.',
        basePrice: 200000,
        image: 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=500&h=400&fit=crop',
        latitude: -5.8800,
        longitude: 106.6000,
        rating: 4.6,
        visitors: '1.5K+',
        crowdLevel: 'Rendah',
        weather: '30°C, Cerah'
    },
    {
        id: 12,
        name: 'Senayan City',
        category: 'modern',
        description: 'Mal dengan konsep modern dengan berbagai restoran, kafe, dan toko fashion.',
        basePrice: 0,
        image: 'https://images.unsplash.com/photo-1555636222-cff0eb3f5e14?w=500&h=400&fit=crop',
        latitude: -6.2267,
        longitude: 106.7899,
        rating: 4.3,
        visitors: '3.2K+',
        crowdLevel: 'Tinggi',
        weather: '28°C, Cerah'
    }
];

let filteredDestinations = [...destinations];
let currentFilter = 'all';

function formatCurrency(value) {
    return new Intl.NumberFormat('id-ID').format(value);
}

function renderDestinations() {
    const grid = document.getElementById('destinations-grid');
    const emptyState = document.getElementById('empty-state');

    if (filteredDestinations.length === 0) {
        grid.innerHTML = '';
        emptyState.classList.remove('hidden');
        return;
    }

    emptyState.classList.add('hidden');
    grid.innerHTML = filteredDestinations.map(dest => `
        <div class="destination-card group card bg-white shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden cursor-pointer" data-id="${dest.id}">
            <figure class="relative overflow-hidden h-48 bg-gradient-to-br from-slate-200 to-slate-300">
                <img src="${dest.image}" alt="${dest.name}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                <div class="absolute top-3 right-3 bg-white/95 backdrop-blur rounded-full px-3 py-1 flex items-center gap-1 shadow-lg">
                    <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <span class="font-bold text-sm text-slate-800">${dest.rating}</span>
                </div>
                <div class="absolute bottom-3 left-3">
                    <span class="badge badge-sm font-bold">${dest.category}</span>
                </div>
            </figure>

            <div class="card-body p-4">
                <h3 class="card-title text-lg font-bold line-clamp-2">${dest.name}</h3>
                <p class="text-sm text-slate-600 line-clamp-2 mb-3">${dest.description}</p>

                <!-- Info Row -->
                <div class="space-y-2 mb-4 py-3 border-y border-slate-100">
                    <div class="flex items-center justify-between text-xs">
                        <span class="flex items-center gap-1 text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 6a3 3 0 11-6 0 3 3 0 016 0zM6 20h12v-2a9 9 0 00-12 0v2z"></path>
                            </svg>
                            ${dest.visitors}
                        </span>
                        <span class="font-bold text-cyan-600">${dest.crowdLevel}</span>
                    </div>
                    <div class="flex items-center gap-1 text-xs text-slate-600">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        ${dest.weather}
                    </div>
                </div>

                <!-- Price & Action -->
                <div class="card-actions justify-between items-center">
                    ${dest.basePrice > 0 ? `
                        <div>
                            <p class="text-xs text-slate-500">Mulai dari</p>
                            <p class="text-xl font-black text-cyan-600">Rp ${formatCurrency(dest.basePrice)}</p>
                        </div>
                    ` : `
                        <div class="text-sm font-bold text-emerald-600">Akses Gratis</div>
                    `}
                    <div class="flex gap-2">
                        <button class="btn btn-sm btn-ghost gap-1 book-btn" data-id="${dest.id}" title="Pesan tiket" onclick="event.stopPropagation()">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m-4 4v2m4-4v2m4 0a2 2 0 11-4 0m-4 0a2 2 0 11-4 0m4 0v2m4-4v2"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `).join('');

    attachEventListeners();
}

document.getElementById('search-input').addEventListener('keyup', function(e) {
    const query = e.target.value.toLowerCase();
    filteredDestinations = destinations.filter(dest =>
        dest.name.toLowerCase().includes(query) ||
        dest.description.toLowerCase().includes(query)
    );
    renderDestinations();
});

document.getElementById('search-btn').addEventListener('click', function() {
    document.getElementById('search-input').dispatchEvent(new Event('keyup'));
});

document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('btn-active'));
        this.classList.add('btn-active');

        currentFilter = this.dataset.filter;
        filteredDestinations = currentFilter === 'all'
            ? [...destinations]
            : destinations.filter(dest => dest.category === currentFilter);
        renderDestinations();
    });
});

function attachEventListeners() {
    // Click card to view destination
    document.querySelectorAll('.destination-card').forEach(card => {
        card.addEventListener('click', function() {
            const id = this.dataset.id;
            window.location.href = `/destinations/${id}`;
        });
    });

    // Book button (stop propagation to prevent card click)
    document.querySelectorAll('.book-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const id = this.dataset.id;
            const dest = destinations.find(d => d.id === parseInt(id));
            openBookingModal(dest);
        });
    });
}

function openBookingModal(destination) {
    const modal = document.getElementById('booking-modal');

    document.getElementById('modal-destination-name').textContent = destination.name;
    document.getElementById('modal-destination-image').src = destination.image;
    document.getElementById('modal-destination-description').textContent = destination.description;
    document.getElementById('modal-base-price').textContent = formatCurrency(destination.basePrice);
    document.getElementById('modal-category').textContent = destination.category;

    document.getElementById('unit-price').textContent = `Rp ${formatCurrency(destination.basePrice)}`;
    updateTotalPrice(destination.basePrice, 1);

    document.getElementById('booking-date').value = '';
    document.getElementById('ticket-count').textContent = '1';
    document.getElementById('booking-notes').value = '';

    let ticketCount = 1;

    document.getElementById('increase-ticket').onclick = function(e) {
        e.preventDefault();
        ticketCount++;
        document.getElementById('ticket-count').textContent = ticketCount;
        document.getElementById('qty-display').textContent = ticketCount + ' tiket';
        updateTotalPrice(destination.basePrice, ticketCount);
    };

    document.getElementById('decrease-ticket').onclick = function(e) {
        e.preventDefault();
        if (ticketCount > 1) {
            ticketCount--;
            document.getElementById('ticket-count').textContent = ticketCount;
            document.getElementById('qty-display').textContent = ticketCount + ' tiket';
            updateTotalPrice(destination.basePrice, ticketCount);
        }
    };

    document.getElementById('confirm-booking').onclick = function() {
        const date = document.getElementById('booking-date').value;
        const tickets = parseInt(document.getElementById('ticket-count').textContent);
        const notes = document.getElementById('booking-notes').value;

        if (!date) {
            alert('Silakan pilih tanggal terlebih dahulu');
            return;
        }

        const total = parseInt(document.getElementById('total-price').textContent.replace(/\D/g, ''));
        alert(`✅ Booking Dikonfirmasi!\n\nDestinasi: ${destination.name}\nTanggal: ${date}\nJumlah Tiket: ${tickets}\nTotal: Rp ${formatCurrency(total)}`);
        modal.close();
    };

    modal.showModal();
}

function updateTotalPrice(basePrice, quantity) {
    const total = basePrice * quantity;
    document.getElementById('total-price').textContent = formatCurrency(total);
}

renderDestinations();
</script>
