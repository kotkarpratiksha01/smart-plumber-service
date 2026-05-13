<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Plumber Service') }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#FDFDFC] text-[#1b1b18]">
    <nav class="p-4 bg-white shadow">
        <div class="w-full flex justify-between items-center px-6">
            <a href="/" class="font-bold">{{ config('app.name', 'Plumber Service') }}</a>
            <div class="flex gap-3">
                <a href="{{ route('plumbers.index') }}">Plumbers</a>
                @if(Route::has('login'))
                    <a href="{{ route('login') }}">Login</a>
                @endif
            </div>
        </div>
    </nav>
    <main class="mx-auto p-4 max-w-full">
        @if(session('success'))
            <div class="p-3 bg-green-100 border border-green-200 rounded mb-4">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>
