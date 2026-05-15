<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - {{ config('app.name', 'Smart Home Services') }}</title>
    @vite(['resources/css/app.css'])
    <!-- Tailwind CDN fallback -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      body { min-height:100vh; color:#e6eef8; font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; }
      .bg-white\/6 { background: rgba(255,255,255,0.06); }
      .border-white\/8 { border: 1px solid rgba(255,255,255,0.08); }
      .backdrop-blur-lg { backdrop-filter: blur(6px); }
      .btn-anim { transition: transform .15s ease; }
      input, select { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06); color: #fff; padding: 8px 12px; border-radius: 8px; width:100%; box-sizing:border-box; }
      .w-full { width:100%; }
      .max-w-md { max-width:480px; }
  .page-overlay { position:fixed; inset:0; background:linear-gradient(135deg,#0f172a, #0b1220); transform:translateY(100%); transition:transform .45s cubic-bezier(.2,.9,.2,1); z-index:60; pointer-events:none; }
  .page-overlay.show { transform:translateY(0%); pointer-events:auto; }
  .card-anim { opacity:0; transform:translateY(12px) scale(.99); transition:opacity .5s ease, transform .5s cubic-bezier(.2,.9,.2,1); }
  .ill-anim { opacity:0; transform:translateY(-8px) scale(.995); transition:opacity .6s ease, transform .6s cubic-bezier(.2,.9,.2,1); }
  .card-anim.animate-in { opacity:1; transform:none; }
  .ill-anim.animate-in { opacity:1; transform:none; }
    </style>
  </head>
  <body class="min-h-screen bg-gradient-to-br from-slate-900 via-indigo-900 to-slate-800 flex items-center">
    <div class="w-full max-w-7xl mx-auto px-6 py-12">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
        <!-- Illustration -->
  <div class="hidden md:flex items-center justify-center ill-anim" id="illustration">
          <div class="max-w-md p-6 rounded-2xl bg-white/5 backdrop-blur-md border border-white/6 shadow-lg">
            <svg viewBox="0 0 600 400" class="w-full h-auto" xmlns="http://www.w3.org/2000/svg" aria-hidden>
              <defs>
                <linearGradient id="g2" x1="0" x2="1">
                  <stop offset="0%" stop-color="#06b6d4" />
                  <stop offset="100%" stop-color="#6366f1" />
                </linearGradient>
              </defs>
              <rect x="40" y="40" width="520" height="320" rx="20" fill="url(#g2)" opacity="0.06"/>
              <g transform="translate(80,80)">
                <rect x="0" y="0" width="440" height="18" rx="8" fill="#fff" opacity="0.06"/>
                <rect x="0" y="36" width="380" height="12" rx="6" fill="#fff" opacity="0.04"/>
              </g>
            </svg>
          </div>
        </div>

        <!-- Register card -->
        <div class="mx-auto w-full max-w-md card-anim" id="registerCard">
          <div class="bg-white rounded-2xl p-8 shadow-lg">
            <div class="flex items-center justify-between mb-4">
              <div>
                <h2 class="text-2xl font-semibold text-slate-800">Create an account</h2>
                <p class="text-sm text-slate-500">Join Plumber Service — quick and secure</p>
              </div>
              <div class="w-12 h-12 rounded-lg bg-emerald-600 flex items-center justify-center text-white font-bold">PR</div>
            </div>

            <form method="POST" action="/register" class="space-y-4">
              @csrf

              <div>
                <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Full name</label>
                <input id="name" name="name" type="text" required class="w-full px-4 py-2 rounded-lg placeholder-slate-400 bg-slate-50 border border-slate-200 text-slate-800 outline-none focus:ring-2 focus:ring-emerald-300 transition" />
              </div>

              <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                <input id="email" name="email" type="email" required class="w-full px-4 py-2 rounded-lg placeholder-slate-400 bg-slate-50 border border-slate-200 text-slate-800 outline-none focus:ring-2 focus:ring-emerald-300 transition" />
              </div>

              <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                <input id="password" name="password" type="password" required class="w-full px-4 py-2 rounded-lg placeholder-slate-400 bg-slate-50 border border-slate-200 text-slate-800 outline-none focus:ring-2 focus:ring-emerald-300 transition" />
              </div>

              <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-2">Confirm password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required class="w-full px-4 py-2 rounded-lg placeholder-slate-400 bg-slate-50 border border-slate-200 text-slate-800 outline-none focus:ring-2 focus:ring-emerald-300 transition" />
              </div>

              <!-- optional role selection for admin-created users -->
              <div>
                <label for="role" class="block text-sm font-medium text-slate-700 mb-2">Register as</label>
                <select id="role" name="role" class="w-full px-4 py-2 rounded-lg bg-slate-50 border border-slate-200 text-slate-800 outline-none">
                  <option value="user">Customer</option>
                  <option value="plumber">Plumber</option>
                </select>
              </div>

              <div>
        <button type="submit" class="w-full py-3 rounded-lg bg-emerald-600 text-white font-semibold btn-anim">Create account</button>
              </div>
            </form>

      <p class="mt-4 text-sm text-slate-500">Already have an account? <a href="{{ route('login') }}" class="text-emerald-600 hover:underline">Sign in</a></p>
          </div>
        </div>
      </div>
    </div>

    <script>
      document.querySelectorAll('.btn-anim').forEach(btn => {
        btn.addEventListener('mouseover', () => btn.style.transform = 'translateY(-3px)');
        btn.addEventListener('mouseout', () => btn.style.transform = 'translateY(0)');
      });

      document.addEventListener('DOMContentLoaded', function(){
        setTimeout(()=>{
          document.getElementById('registerCard')?.classList.add('animate-in');
          document.getElementById('illustration')?.classList.add('animate-in');
        }, 60);
      });

      function navigateWithOverlay(url){
        const overlay = document.getElementById('pageOverlay');
        overlay.classList.add('show');
        setTimeout(()=> window.location.href = url, 420);
      }

      document.querySelectorAll('a').forEach(a=>{
        const href = a.getAttribute('href');
        if(!href) return;
        if(href.startsWith('/') || href.startsWith(window.location.origin)){
          a.addEventListener('click', function(e){
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
