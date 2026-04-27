<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Tourism</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-100">

    <div class="navbar bg-base-100 shadow-md px-6">
        <div class="flex-1">
            <a href="/" class="text-xl font-bold">SmartTour</a>
        </div>
        <div class="flex gap-2">
            <a href="/immersive" class="btn btn-ghost btn-sm">Immersive</a>
            <a href="/ai-route" class="btn btn-ghost btn-sm">AI Route</a>
            <a href="/personalization" class="btn btn-ghost btn-sm">Personalization</a>
        </div>
    </div>
    <main>
        @yield('content')
    </main>

</body>
</html>