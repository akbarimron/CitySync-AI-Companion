@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-base-200 p-8">

    <div class="text-center mb-10">
        <h1 class="text-4xl font-bold">AI Route & Crowd Optimizer</h1>
        <p class="text-gray-500 mt-2">Smart navigation powered by AI</p>
    </div>

    <div class="grid md:grid-cols-2 gap-6">

        <!-- ROUTE -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-primary mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V6.618a1 1 0 011.447-.894L9 8m0 12l6-3m-6 3V8m6 9l5.447 2.724A1 1 0 0021 20.382V10.618a1 1 0 00-1.447-.894L15 12m0 0V3m0 9l-6-3"/>
                </svg>
                <h2 class="card-title">Route Optimizer</h2>
                <p>Find the fastest and most efficient travel routes.</p>
                <div class="card-actions justify-end">
                    <a href="/ai-route/optimizer" class="btn btn-primary">Start</a>
                </div>
            </div>
        </div>

        <!-- CROWD -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-primary mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5V4H2v16h5m10 0v-6a4 4 0 00-8 0v6m8 0H9"/>
                </svg>
                <h2 class="card-title">Crowd Analyzer</h2>
                <p>Monitor and avoid crowded areas in real-time.</p>
                <div class="card-actions justify-end">
                    <a href="/ai-route/crowd" class="btn btn-primary">Analyze</a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection