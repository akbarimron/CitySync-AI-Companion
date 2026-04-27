@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-base-200 p-8">

    <div class="text-center mb-10">
        <h1 class="text-4xl font-bold">Immersive Real-Time Preview</h1>
        <p class="text-gray-500 mt-2">Experience destinations with AR, VR, and Live Camera</p>
    </div>

    <div class="grid md:grid-cols-3 gap-6">

        <!-- AR -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body items-center text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M4 6h7a2 2 0 012 2v8a2 2 0 01-2 2H4V6z"/>
                </svg>
                <h2 class="card-title">Augmented Reality</h2>
                <p>Preview locations in real-world environments using AR technology.</p>
                <div class="card-actions">
                    <a href="/immersive/ar" class="btn btn-primary">Explore</a>
                </div>
            </div>
        </div>

        <!-- VR -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body items-center text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.75 17L9 21l3-2 3 2-.75-4M4.5 6h15M6 6v12h12V6"/>
                </svg>
                <h2 class="card-title">Virtual Reality</h2>
                <p>Explore destinations with immersive 360° virtual experience.</p>
                <div class="card-actions">
                    <a href="/immersive/vr" class="btn btn-primary">Explore</a>
                </div>
            </div>
        </div>

        <!-- LIVE CAM -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body items-center text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M4 6h7a2 2 0 012 2v8a2 2 0 01-2 2H4V6z"/>
                </svg>
                <h2 class="card-title">Live Camera</h2>
                <p>Monitor locations in real-time through live camera feeds.</p>
                <div class="card-actions">
                    <a href="/immersive/live-cam" class="btn btn-primary">View</a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection