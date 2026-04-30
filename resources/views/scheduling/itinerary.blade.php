@extends('layouts.app')

@section('title', 'AI Route Planner')

@section('content')
    <div x-data="schedulingApp()" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- HEADER --}}
        <div class="mb-10 mt-20">
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">
                AI Route Planner
            </h1>
            <p class="text-slate-500 mt-2">
                Rencanakan perjalanan optimal dengan bantuan AI
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">

            <div>
                <div class="bg-white/90 backdrop-blur rounded-2xl shadow-xl border border-slate-100 p-6 sticky top-24">

                    <h2 class="font-bold text-lg text-slate-800 mb-6 flex items-center gap-2">
                        <i class="fa-solid fa-route text-cyan-500"></i>
                        Detail Perjalanan
                    </h2>

                    <form @submit.prevent="scheduleRoute" class="space-y-5">

                        {{-- LOKASI AWAL --}}
                        <div>
                            <label class="text-sm font-semibold text-slate-600 flex items-center gap-2">
                                <i class="fa-solid fa-location-crosshairs text-cyan-500"></i>
                                Lokasi Awal
                            </label>
                            <div class="relative mt-1">
                                <input type="text" x-model="formData.currentAddress"
                                    placeholder="Contoh: Jl. Braga Bandung"
                                    class="w-full rounded-xl border border-slate-200 pl-10 pr-3 py-2 focus:ring-2 focus:ring-cyan-400 outline-none">
                                <i
                                    class="fa-solid fa-location-dot absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            </div>
                        </div>

                        {{-- TUJUAN --}}
                        <div>
                            <label class="text-sm font-semibold text-slate-600 flex items-center gap-2">
                                <i class="fa-solid fa-flag-checkered text-emerald-500"></i>
                                Tujuan
                            </label>
                            <div class="relative mt-1">
                                <input type="text" x-model="formData.destinationAddress"
                                    placeholder="Contoh: Trans Studio Bandung"
                                    class="w-full rounded-xl border border-slate-200 pl-10 pr-3 py-2 focus:ring-2 focus:ring-emerald-400 outline-none">
                                <i
                                    class="fa-solid fa-location-dot absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            </div>
                        </div>

                        {{-- DATE TIME --}}
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="text-xs text-slate-500">Tanggal</label>
                                <input type="date" x-model="formData.departureDate"
                                    class="w-full mt-1 rounded-xl border border-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-cyan-400 outline-none">
                            </div>
                            <div>
                                <label class="text-xs text-slate-500">Waktu</label>
                                <input type="time" x-model="formData.departureTime"
                                    class="w-full mt-1 rounded-xl border border-slate-200 px-3 py-2 text-sm focus:ring-2 focus:ring-cyan-400 outline-none">
                            </div>
                        </div>

                        {{-- TRANSPORT --}}
                        <div>
                            <p class="text-sm font-semibold text-slate-600 mb-2 flex items-center gap-2">
                                <i class="fa-solid fa-car text-cyan-500"></i>
                                Transportasi
                            </p>

                            <div class="grid grid-cols-2 gap-3">
                                <template x-for="option in transitOptions" :key="option.value">
                                    <button type="button" @click="formData.transitType = option.value"
                                        :class="formData.transitType === option.value ?
                                            'bg-gradient-to-r from-cyan-500 to-emerald-500 text-white shadow' :
                                            'bg-slate-100 text-slate-600 hover:bg-slate-200'"
                                        class="rounded-xl p-3 text-sm font-semibold transition flex items-center justify-center gap-2">

                                        <i :class="option.icon"></i>
                                        <span x-text="option.label"></span>
                                    </button>
                                </template>
                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-cyan-500 to-emerald-500 text-white py-3 rounded-xl font-bold shadow-lg hover:scale-[1.02] transition"
                            :disabled="isProcessing">
                            Buat Rute
                            <span x-text="isProcessing ? 'Memproses...' : 'Generate Rute'"></span>
                        </button>

                    </form>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- MAP --}}
                <div class="bg-white rounded-2xl shadow overflow-hidden">
                    <div id="map" class="h-96"></div>
                </div>

                {{-- RESULT --}}
                <div x-show="scheduleResult" class="bg-white rounded-2xl shadow p-6">

                    <h3 class="font-bold text-lg mb-4">Ringkasan</h3>

                    {{-- SUMMARY --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

                        <div class="bg-cyan-500 text-white p-4 rounded-xl">
                            <p class="text-xs">Jarak</p>
                            <p class="font-bold" x-text="scheduleResult.distance"></p>
                        </div>

                        <div class="bg-emerald-500 text-white p-4 rounded-xl">
                            <p class="text-xs">Durasi</p>
                            <p class="font-bold" x-text="scheduleResult.duration"></p>
                        </div>

                        <div class="bg-orange-500 text-white p-4 rounded-xl">
                            <p class="text-xs">Biaya</p>
                            <p class="font-bold" x-text="scheduleResult.cost"></p>
                        </div>

                        <div class="bg-slate-800 text-white p-4 rounded-xl">
                            <p class="text-xs">Kepadatan</p>
                            <p class="font-bold" x-text="scheduleResult.crowdLevel"></p>
                        </div>
                    </div>

                    {{-- STEPS --}}
                    <template x-for="step in scheduleResult.steps">
                        <div class="flex gap-3 mb-3">
                            <i :class="step.icon"></i>
                            <div>
                                <p x-text="step.title"></p>
                                <p class="text-sm text-slate-500" x-text="step.description"></p>
                            </div>
                        </div>
                    </template>

                    {{-- EXPORT --}}
                    <button @click="exportPDF" class="mt-6 bg-slate-900 text-white px-4 py-2 rounded-xl">
                        Export PDF
                    </button>

                </div>
            </div>
        </div>
    </div>

    {{-- JS LIB --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
        function schedulingApp() {
            return {
                formData: {
                    currentAddress: '',
                    destinationAddress: '',
                    departureDate: new Date().toISOString().split('T')[0],
                    departureTime: '08:00',
                    transitType: 'car',
                },

                transitOptions: [{
                        value: 'car',
                        label: 'Mobil',
                        icon: 'fa-solid fa-car'
                    },
                    {
                        value: 'motor',
                        label: 'Motor',
                        icon: 'fa-solid fa-motorcycle'
                    },
                    {
                        value: 'bus',
                        label: 'Bus',
                        icon: 'fa-solid fa-bus'
                    },
                    {
                        value: 'train',
                        label: 'Kereta',
                        icon: 'fa-solid fa-train'
                    }
                ],

                map: null,
                markers: [],
                routeLayer: null,
                scheduleResult: null,

                init() {
                    this.map = L.map('map').setView([-6.9, 107.6], 13);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(this.map);
                },

                async scheduleRoute() {
                    const start = await this.geocode(this.formData.currentAddress);
                    const end = await this.geocode(this.formData.destinationAddress);

                    const route = await this.getRoute(start, end);
                    const trip = this.calculateTrip(route);

                    this.scheduleResult = {
                        ...trip,
                        crowdLevel: 'Sedang',
                        steps: [{
                                title: 'Mulai',
                                description: this.formData.currentAddress,
                                icon: 'fa-solid fa-location-dot'
                            },
                            {
                                title: 'Perjalanan',
                                description: 'Ikuti rute terbaik',
                                icon: 'fa-solid fa-route'
                            },
                            {
                                title: 'Sampai',
                                description: this.formData.destinationAddress,
                                icon: 'fa-solid fa-flag-checkered'
                            }
                        ]
                    };

                    this.updateMap(start, end, route.geometry);
                },

                calculateTrip(route) {
                    const km = route.distance / 1000;

                    let costPerKm = 3000;
                    let speedFactor = 1;

                    if (this.formData.transitType === 'motor') {
                        costPerKm = 1500;
                        speedFactor = 0.8;
                    }

                    return {
                        distance: km.toFixed(1) + ' km',
                        duration: Math.round((route.duration / 60) * speedFactor) + ' menit',
                        cost: 'Rp ' + Math.round(km * costPerKm).toLocaleString('id-ID'),
                    };
                },

                async geocode(q) {
                    const res = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${q}`);
                    const data = await res.json();
                    return [data[0].lat, data[0].lon];
                },

                async getRoute(start, end) {
                    const res = await fetch(
                        `https://router.project-osrm.org/route/v1/driving/${start[1]},${start[0]};${end[1]},${end[0]}?overview=full&geometries=geojson`
                    );
                    const data = await res.json();
                    return data.routes[0];
                },

                updateMap(start, end, geometry) {
                    this.markers.forEach(m => this.map.removeLayer(m));

                    const startMarker = L.marker(start).addTo(this.map);
                    const endMarker = L.marker(end).addTo(this.map);

                    this.markers = [startMarker, endMarker];

                    this.routeLayer && this.map.removeLayer(this.routeLayer);

                    this.routeLayer = L.geoJSON(geometry).addTo(this.map);
                    this.map.fitBounds(this.routeLayer.getBounds());
                },

                exportPDF() {
                    const {
                        jsPDF
                    } = window.jspdf;
                    const doc = new jsPDF();

                    doc.text("AI Route Planner", 10, 10);
                    doc.text(`Dari: ${this.formData.currentAddress}`, 10, 20);
                    doc.text(`Ke: ${this.formData.destinationAddress}`, 10, 30);

                    doc.text(`Jarak: ${this.scheduleResult.distance}`, 10, 50);
                    doc.text(`Durasi: ${this.scheduleResult.duration}`, 10, 60);
                    doc.text(`Biaya: ${this.scheduleResult.cost}`, 10, 70);

                    doc.save("route.pdf");
                }
            }
        }
    </script>
@endsection
