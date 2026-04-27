@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-base-200 p-8">

    <div class="text-center mb-10">
        <h1 class="text-4xl font-bold">Smart Personalization</h1>
        <p class="text-gray-500 mt-2">AI-powered personalized experience</p>
    </div>

    <div class="grid md:grid-cols-2 gap-6">

        <!-- GUIDE -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-primary mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 20h9M12 4h9M4 9h16M4 15h16"/>
                </svg>
                <h2 class="card-title">Smart Guide</h2>
                <p>Personalized recommendations based on your preferences.</p>
                <div class="card-actions justify-end">
                    <a href="/personalization/guide" class="btn btn-primary">Explore</a>
                </div>
            </div>
        </div>

        <!-- DYNAMIC -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-primary mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h2 class="card-title">Dynamic Live Guide</h2>
                <p>Real-time guidance adapting to your journey.</p>
                <div class="card-actions justify-end">
                    <a href="/personalization/dynamic" class="btn btn-primary">Start</a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection