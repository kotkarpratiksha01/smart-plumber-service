<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - {{ config('app.name', 'Smart Home Services') }}</title>
            @vite(['resources/css/app.css'])
            <!-- Tailwind CDN fallback: ensures classes work if Vite/dev build isn't available -->
            <script src="https://cdn.tailwindcss.com"></script>
            <style>
                /* Minimal fallback styles in case CDN or Vite CSS is blocked */
                body { min-height:100vh; color:#e6eef8; font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; }
                .bg-white\/6 { background: rgba(255,255,255,0.06); }
                                @keyframes floatY {
                                    0% { transform: translateY(0); }
                                    50% { transform: translateY(-8px); }
                                    100% { transform: translateY(0); }
                                }
                                @keyframes popIn {
                                    from { opacity: 0; transform: translateY(8px) scale(.985); }
                                    to { opacity: 1; transform: translateY(0) scale(1); }
                                }
                                @keyframes stripeSlide { from{ transform: translateX(-30%);} to{ transform: translateX(30%);} }

                                .page-overlay { position:fixed; inset:0; z-index:60; pointer-events:none; display:flex; align-items:center; justify-content:center; }
                                .page-overlay .overlay-bg { position:absolute; inset:0; background: linear-gradient(135deg, rgba(15,23,42,0.9), rgba(11,18,32,0.9)); transform: translateY(8%); opacity:0; transition:transform .48s cubic-bezier(.2,.9,.2,1), opacity .48s; }
                                .page-overlay.show .overlay-bg { transform: translateY(0%); opacity:1; pointer-events:auto; }
                                .page-overlay .overlay-stripe { position:absolute; inset:0; background:linear-gradient(90deg, rgba(99,102,241,0.08), rgba(6,182,212,0.06), rgba(99,102,241,0.06)); mix-blend-mode:overlay; opacity:0.9; transform: translateX(-20%); animation: stripeSlide 3.5s linear infinite; }
                                .page-overlay .overlay-center { position:relative; z-index:62; color:#fff; font-weight:600; letter-spacing:0.4px; opacity:0.06 }

                                .card-anim { opacity:0; transform:translateY(12px) scale(.99); }
                                .ill-anim { opacity:0; transform:translateY(-8px) scale(.995); }
                                .card-anim.animate-in { animation: popIn .48s cubic-bezier(.2,.9,.2,1) forwards; }
                                .ill-anim.animate-in { animation: popIn .56s cubic-bezier(.2,.9,.2,1) forwards, floatY 4s ease-in-out 0.2s infinite; }
                                /* background subtle floating gradients */
                                body::before, body::after { content:""; position:fixed; inset:0; z-index:0; pointer-events:none; }
                                body::before { background: radial-gradient(circle at 10% 20%, rgba(99,102,241,0.12), transparent 14%), radial-gradient(circle at 80% 80%, rgba(6,182,212,0.08), transparent 18%); mix-blend-mode:overlay; filter: blur(24px); transform: scale(1); animation: bgFloat 12s ease-in-out infinite; }
                                body::after { background: linear-gradient(120deg, rgba(13,17,25,0.12), transparent 40%); mix-blend-mode:soft-light; opacity:0.65; }
                                @keyframes bgFloat { 0%{ transform:translateY(0) scale(1);} 50%{ transform:translateY(-12px) scale(1.02);} 100%{ transform:translateY(0) scale(1);} }
                                /* CTA pulse */
                                .btn-anim { transition: transform .15s ease, box-shadow .22s ease; }
                                .btn-anim.pulse { animation: pulse 2.6s infinite; }
                                @keyframes pulse { 0%{ box-shadow:0 6px 20px rgba(6,182,212,0.06);} 50%{ box-shadow:0 10px 28px rgba(6,182,212,0.09);} 100%{ box-shadow:0 6px 20px rgba(6,182,212,0.06);} }
                .w-full { width:100%; }
                .max-w-md { max-width:420px; }
                /* Page transition animations */
                .page-overlay { position:fixed; inset:0; background:linear-gradient(135deg,#0f172a, #0b1220); transform:translateY(100%); transition:transform .45s cubic-bezier(.2,.9,.2,1); z-index:60; pointer-events:none; }
                .page-overlay.show { transform:translateY(0%); pointer-events:auto; }
                .card-anim { opacity:0; transform:translateY(12px) scale(.99); transition:opacity .5s ease, transform .5s cubic-bezier(.2,.9,.2,1); }
                .ill-anim { opacity:0; transform:translateY(-8px) scale(.995); transition:opacity .6s ease, transform .6s cubic-bezier(.2,.9,.2,1); }
                /* apply when the element has both classes (ensures correct precedence) */
                .card-anim.animate-in { opacity:1; transform:none; }
                .ill-anim.animate-in { opacity:1; transform:none; }
            </style>
    </head>
    <body class="min-h-screen bg-gradient-to-br from-slate-900 via-indigo-900 to-slate-800 flex items-center">
        <div class="w-full max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center" style="position:relative; z-index:1;">
                        <!-- Illustration image -->
                                <div class="hidden md:flex items-center justify-center ill-anim" id="illustration">
                                    <div class="max-w-md p-6 rounded-2xl bg-white/5 backdrop-blur-md border border-white/6 shadow-lg flex items-center justify-center">
                                        <img src="/images/plumber.avif" alt="Illustration" class="w-full h-auto" />
                                    </div>
                                </div>

                <!-- Login card -->
                        <div class="mx-auto w-full max-w-md card-anim" id="loginCard">
                                        <div class="bg-white rounded-2xl p-8 shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                            <h2 class="text-2xl font-semibold text-slate-800">Welcome back</h2>
                                            <p class="text-sm text-slate-500">Sign in to continue to Plumber Service</p>
                            </div>
                                        <div class="w-12 h-12 rounded-lg bg-emerald-600 flex items-center justify-center text-white font-bold">PR</div>
                        </div>

                        <form method="POST" action="/login" class="space-y-4">
                            @csrf
                            <div>
                                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                                <input id="email" name="email" type="email" required class="w-full px-4 py-2 rounded-lg bg-slate-50 border border-slate-200 placeholder-slate-400 text-slate-800 outline-none focus:ring-2 focus:ring-emerald-300 transition" />
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                                <input id="password" name="password" type="password" required class="w-full px-4 py-2 rounded-lg bg-slate-50 border border-slate-200 placeholder-slate-400 text-slate-800 outline-none focus:ring-2 focus:ring-emerald-300 transition" />
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-indigo-500 rounded bg-white/5" />
                                    <label for="remember" class="text-sm text-slate-200/80">Remember me</label>
                                </div>
                                <a href="#" class="text-sm text-indigo-200 hover:underline">Forgot?</a>
                            </div>

                            <div>
                                <button type="submit" class="w-full py-3 rounded-lg bg-emerald-600 text-white font-semibold btn-anim">Log in</button>
                            </div>
                        </form>

                                    @if (Route::has('register'))
                                        <p class="mt-4 text-sm text-slate-500">Don't have an account? <a href="{{ route('register') }}" class="text-emerald-600 hover:underline">Register</a></p>
                                    @endif
                    </div>
                </div>
            </div>
        </div>

        <script>
            // subtle button animation class
            document.querySelectorAll('.btn-anim').forEach(btn => {
                btn.addEventListener('mouseover', () => btn.style.transform = 'translateY(-3px)');
                btn.addEventListener('mouseout', () => btn.style.transform = 'translateY(0)');
            });

            // entrance sequencing: overlay flash then pop-in with stagger
            document.addEventListener('DOMContentLoaded', function(){
                const overlay = document.getElementById('pageOverlay');
                // quick overlay flash to accent the transition
                setTimeout(()=>{ overlay.classList.add('show'); }, 40);
                setTimeout(()=>{ overlay.classList.remove('show'); }, 380);
                // staggered pop-in
                setTimeout(()=> document.getElementById('illustration')?.classList.add('animate-in'), 420);
                setTimeout(()=> document.getElementById('loginCard')?.classList.add('animate-in'), 540);
                // enable subtle CTA pulse after visible
                setTimeout(()=> document.querySelectorAll('.btn-anim').forEach(b=>b.classList.add('pulse')), 900);
            });

            // intercept internal link navigation to play exit overlay
            function navigateWithOverlay(url){
                const overlay = document.getElementById('pageOverlay');
                overlay.classList.add('show');
                setTimeout(()=> window.location.href = url, 420);
            }

            document.querySelectorAll('a').forEach(a=>{
                const href = a.getAttribute('href');
                if(!href) return;
                // only intercept internal navigations
                if(href.startsWith('/') || href.startsWith(window.location.origin)){
                    a.addEventListener('click', function(e){
                        // allow ctrl/cmd clicks
                        if(e.metaKey||e.ctrlKey||a.target==='_blank') return;
                        e.preventDefault();
                        navigateWithOverlay(href.startsWith('/') ? href : href);
                    });
                }
            });
        </script>
        <div id="pageOverlay" class="page-overlay"></div>
    </body>
</html>
