<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Plumber Service') }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen antialiased bg-black text-white">
    <nav class="p-4 bg-black border-b border-slate-800">
        <div class="w-full flex justify-between items-center px-6 max-w-7xl mx-auto">
            <a href="/" class="flex items-center gap-3">
                <img src="/images/plumber-logo.svg" alt="Plumber Services" class="w-10 h-10" />
                <span class="font-bold text-slate-800 text-lg">Plumber Services</span>
            </a>
            <div class="flex gap-6 items-center">
                <a href="{{ route('plumbers.index') }}" class="text-slate-300 hover:text-emerald-400">Plumbers</a>
                @if(Route::has('login'))
                    <a href="{{ route('login') }}" class="text-slate-300 hover:text-emerald-400">Login</a>
                @endif
            </div>
        </div>
    </nav>
    <main class="mx-auto p-6 max-w-7xl">
        @if(session('success'))
            <div class="p-3 bg-emerald-600/8 border border-emerald-700 rounded mb-4 text-emerald-300">{{ session('success') }}</div>
        @endif
        @hasSection('dashboard-content')
            @yield('dashboard-content')
        @else
            @yield('content')
        @endif
    </main>
</body>
</html>
