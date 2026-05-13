<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Plumber Service') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Minimal splash-specific styles for a centered animation */
        .splash-root { min-height: 100vh; display:flex; align-items:center; justify-content:center; background:#FDFDFC; }
        .splash-card { background: white; border-radius:12px; padding:2.5rem; display:flex; flex-direction:column; align-items:center; gap:1.25rem; box-shadow:0 8px 30px rgba(0,0,0,0.08); }
        .logo { width:96px; height:96px; display:flex; align-items:center; justify-content:center; border-radius:9999px; background:#FDFDFC; }
        .app-name { font-weight:700; font-size:1.125rem; }
        .loader { width:72px; height:8px; background:#eee; border-radius:999px; overflow:hidden; position:relative; }
        .loader::after { content:''; position:absolute; left:-40%; top:0; width:40%; height:100%; background:linear-gradient(90deg,#f53003,#ff8a66); animation:load 1s infinite; }
        @keyframes load { to { left:100%; } }
        .btn { background:#F53003; color:white; padding:0.5rem 1rem; border-radius:8px; text-decoration:none; font-weight:600; }
    </style>
</head>
<body class="splash-root">
    <div class="splash-card">
        <div class="logo" aria-hidden>
            <!-- simple wrench SVG for plumber theme -->
            <svg width="56" height="56" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 3l-6 6" stroke="#F53003" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14 3l7 7-4 1-7-7 4-1z" stroke="#F53003" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M10 13l-7 7 4-1 7-7-4 1z" stroke="#F53003" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="app-name">{{ config('app.name', 'Plumber Service') }}</div>
        <div class="loader" role="status" aria-label="Loading animation"></div>
        <a href="{{ route('login') }}" class="btn">Get Started</a>
    </div>
</body>
</html>
