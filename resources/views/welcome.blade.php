@extends('layouts.app')

@section('content')
<div class="bg-base-100">

    <!-- HERO -->
    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content text-center">
            <div class="max-w-2xl">
                <h1 class="text-5xl font-bold leading-tight">
                    Smart Tourism with AI Technology
                </h1>
                <p class="py-6 text-gray-500">
                    Jelajahi pengalaman wisata masa depan dengan teknologi AI yang membantu Anda merencanakan perjalanan lebih cerdas, efisien, dan personal.
                </p>
                <a href="#features" class="btn btn-primary">
                    Explore Features
                </a>
            </div>
        </div>
    </div>

    <!-- FEATURES -->
    <div id="features" class="py-20 px-6 bg-base-100">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold">Our Technologies</h2>
            <p class="text-gray-500 mt-2">Solusi pintar untuk pengalaman wisata terbaik</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

            <!-- 1 -->
            <div class="card bg-base-200 shadow-lg hover:shadow-xl transition">
                <div class="card-body">

                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M4 6h7a2 2 0 012 2v8a2 2 0 01-2 2H4V6z"/>
                        </svg>
                    </div>

                    <h3 class="font-semibold text-lg">
                        Immersive Real-Time Preview
                    </h3>

                    <p class="text-sm text-gray-500">
                        Tur virtual menggunakan AR, VR, dan live camera. Pantau cuaca dan kepadatan secara real-time dengan Computer Vision.
                    </p>

                    <div class="card-actions justify-end mt-4">
                        <a href="/immersive" class="btn btn-primary btn-sm">
                            Explore
                        </a>
                    </div>

                </div>
            </div>

            <!-- 2 -->
            <div class="card bg-base-200 shadow-lg hover:shadow-xl transition">
                <div class="card-body">

                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 20l-5.447-2.724A1 1 0 013 16.382V6.618a1 1 0 011.447-.894L9 8m0 12l6-3m-6 3V8m6 9l5.447 2.724A1 1 0 0021 20.382V10.618a1 1 0 00-1.447-.894L15 12m0 0V3m0 9l-6-3"/>
                        </svg>
                    </div>

                    <h3 class="font-semibold text-lg">
                        AI Route & Crowd Optimizer
                    </h3>

                    <p class="text-sm text-gray-500">
                        AI menyusun jadwal perjalanan otomatis berdasarkan prediksi kepadatan dan kondisi real-time.
                    </p>

                    <div class="card-actions justify-end mt-4">
                        <a href="/ai-route" class="btn btn-primary btn-sm">
                            Explore
                        </a>
                    </div>

                </div>
            </div>

            <!-- 3 -->
            <div class="card bg-base-200 shadow-lg hover:shadow-xl transition">
                <div class="card-body">

                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>

                    <h3 class="font-semibold text-lg">
                        Smart Personalization
                    </h3>

                    <p class="text-sm text-gray-500">
                        Rekomendasi wisata berbasis preferensi dan AI chat interaktif yang memahami kebutuhan Anda.
                    </p>

                    <div class="card-actions justify-end mt-4">
                        <a href="/personalization" class="btn btn-primary btn-sm">
                            Explore
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection