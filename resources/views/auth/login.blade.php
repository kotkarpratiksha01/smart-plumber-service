<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - {{ config('app.name', 'Plumber Service') }}</title>
    @vite(['resources/css/app.css'])
    <style>
        body { min-height:100vh; display:flex; align-items:center; justify-content:center; background:#FDFDFC; }
        .card { background:white; padding:2rem; border-radius:12px; box-shadow:0 8px 30px rgba(0,0,0,0.06); width:360px; }
        .field { display:flex; flex-direction:column; gap:0.5rem; margin-bottom:1rem; }
        .input { padding:0.5rem 0.75rem; border-radius:8px; border:1px solid #e6e6e6; }
        .submit { background:#F53003; color:#fff; padding:0.6rem; border-radius:8px; text-align:center; display:inline-block; text-decoration:none; font-weight:600; }
    </style>
</head>
<body>
    <div class="card">
        <h2 style="margin:0 0 1rem 0">Sign in</h2>
        <form method="POST" action="/login">
            @csrf
            <div class="field">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" class="input" required />
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" class="input" required />
            </div>
            <button type="submit" class="submit">Log in</button>
        </form>
        @if (Route::has('register'))
            <p style="margin-top:1rem;font-size:0.9rem;color:#706f6c">Don't have an account? <a href="{{ route('register') }}">Register</a></p>
        @endif
    </div>
</body>
</html>
