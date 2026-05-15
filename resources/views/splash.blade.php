<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Smart Home Services — Find Trusted Home Service Experts Near You</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Tailwind CDN fallback for quick dev preview if Vite isn't running -->
    <script src="https://cdn.tailwindcss.com"></script>
        <style>
            html { scroll-behavior: smooth; }
            /* page-specific styles */
            .hero-bg { background: radial-gradient(1200px 600px at 10% 10%, rgba(37,99,235,0.18), transparent), linear-gradient(180deg,#071035 0%,#04102a 100%); }
            .glass { background: rgba(255,255,255,0.04); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.06); }
            .card-hover { transition: transform .28s ease, box-shadow .28s ease; }
            .card-hover:hover { transform: translateY(-8px); box-shadow: 0 10px 30px rgba(2,6,23,0.6); }
            .btn-anim { transition: transform .18s ease, box-shadow .18s ease; }
            .btn-anim:hover { transform: translateY(-4px); box-shadow: 0 8px 22px rgba(2,6,23,0.5); }
            /* splash overlay */
            #splash { position:fixed; inset:0; display:flex; align-items:center; justify-content:center; z-index:60; background:linear-gradient(180deg,#021025 0%,#04102a 100%); }
            .splash-logo { animation: splashPop .9s ease forwards; opacity:0; }
            @keyframes splashPop { 0% { transform: scale(.9); opacity:0 } 60% { transform: scale(1.06); opacity:1 } 100% { transform: scale(1); opacity:1 } }
            .fade-out { animation: fadeOut .6s ease forwards; }
            @keyframes fadeOut { to { opacity:0; visibility:hidden } }
            /* feature card hover */
            .feature-hover { transition: transform .28s cubic-bezier(.2,.9,.2,1), box-shadow .28s cubic-bezier(.2,.9,.2,1); }
            .feature-hover:hover { transform: translateY(-8px) scale(1.02); box-shadow: 0 18px 40px rgba(2,6,23,0.6); }
        </style>
    </head>
    <body class="min-h-screen hero-bg text-white">

        <!-- Splash overlay (2.2s) -->
        <div id="splash">
            <div class="text-center">
                <div class="mx-auto w-24 h-24 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center splash-logo">
                    <svg class="w-12 h-12 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 21v-2a4 4 0 014-4h10a4 4 0 014 4v2" stroke="rgba(255,255,255,0.9)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 7l8-4 2 8-8 4-2-8z" stroke="rgba(255,255,255,0.9)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div class="mt-4 text-sm text-gray-200 opacity-90">Smart Home Services</div>
            </div>
        </div>

        <!-- Main content -->
        <header class="py-6">
            <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center font-bold">SH</div>
                    <div>
                        <div class="font-semibold">Smart Home Services</div>
                        <div class="text-xs text-blue-200">Trusted local experts</div>
                    </div>
                </div>
                <nav class="hidden md:flex items-center gap-6 text-blue-100">
                    <a href="#" class="hover:text-white">Home</a>
                    <a href="#services" class="hover:text-white">Services</a>
                    <a href="#about" class="hover:text-white">About</a>
                    <a href="#contact" class="hover:text-white">Contact</a>
                    @if(Route::has('login'))
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-md bg-white bg-opacity-8 text-white">Login</a>
                    @endif
                </nav>
                <div class="hidden md:flex items-center gap-6">
                    <div class="text-sm text-blue-100">Call us: <a href="tel:+919876543210" class="font-semibold text-white">+91 98765 43210</a></div>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto px-6 pb-16">
            <section class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                <div class="space-y-6">
                    <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">Find Trusted Home Service Experts Near You</h1>
                    <p class="text-blue-100 max-w-xl">Book plumbers, electricians, wiremen, AC technicians, carpenters and more with one click. Fast, verified and nearby professionals at your service.</p>

                    <div class="flex flex-wrap gap-4 mt-4">
                        <a href="{{ route('login') }}" class="btn-anim inline-flex items-center gap-2 px-6 py-3 rounded-md bg-gradient-to-br from-blue-500 to-indigo-600 font-semibold">Get Started</a>
                        <a href="#services" class="btn-anim inline-flex items-center gap-2 px-6 py-3 rounded-md bg-white bg-opacity-8 text-white">Explore Services</a>
                    </div>

                    <div class="mt-8 grid grid-cols-2 sm:grid-cols-3 gap-4">
                        <div class="glass p-4 rounded-lg text-center card-hover">
                            <div class="mx-auto w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center mb-2">🔧</div>
                            <div class="font-semibold">Plumbing</div>
                        </div>
                        <div class="glass p-4 rounded-lg text-center card-hover">
                            <div class="mx-auto w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center mb-2">💡</div>
                            <div class="font-semibold">Electrician</div>
                        </div>
                        <div class="glass p-4 rounded-lg text-center card-hover">
                            <div class="mx-auto w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center mb-2">🔌</div>
                            <div class="font-semibold">Wireman</div>
                        </div>
                        <div class="glass p-4 rounded-lg text-center card-hover">
                            <div class="mx-auto w-10 h-10 bg-teal-600 rounded-full flex items-center justify-center mb-2">❄️</div>
                            <div class="font-semibold">AC Repair</div>
                        </div>
                    </div>
                </div>

                <aside class="glass p-6 rounded-xl">
                    <h3 class="text-xl font-semibold mb-3">Why Choose Us</h3>
                    <ul class="space-y-3 text-blue-100">
                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">✓</div>
                            <div>
                                <div class="font-medium">Verified Professionals</div>
                                <div class="text-sm text-blue-200">Background-checked and rated service providers.</div>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-indigo-500 rounded-full flex items-center justify-center">⚡</div>
                            <div>
                                <div class="font-medium">Fast Booking</div>
                                <div class="text-sm text-blue-200">Book within seconds and confirm slots instantly.</div>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-teal-500 rounded-full flex items-center justify-center">📍</div>
                            <div>
                                <div class="font-medium">Nearby Services</div>
                                <div class="text-sm text-blue-200">Find experts close to your location.</div>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">💬</div>
                            <div>
                                <div class="font-medium">WhatsApp Support</div>
                                <div class="text-sm text-blue-200">Message providers directly for quick coordination.</div>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-rose-500 rounded-full flex items-center justify-center">⏱</div>
                            <div>
                                <div class="font-medium">24×7 Availability</div>
                                <div class="text-sm text-blue-200">Support and emergency services round the clock.</div>
                            </div>
                        </li>
                    </ul>
                </aside>
            </section>

            <!-- Features Section -->
            <section id="services" class="mt-12">
                <div class="text-center mb-8">
                        <h2 class="text-3xl font-extrabold">Powerful Features</h2>
                        <p class="text-blue-100 max-w-2xl mx-auto mt-2">Everything you need to find, contact and book the right plumber fast.</p>
                    </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Feature card -->
                    <div class="glass feature-hover p-6 rounded-xl">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-emerald-500 rounded-lg flex items-center justify-center text-white text-2xl">📍</div>
                            <div>
                                <h3 class="font-semibold text-lg">Nearby Service Search</h3>
                                <p class="text-sm text-blue-100 mt-1">Find local plumbers near your location quickly with distance sorting.</p>
                            </div>
                        </div>
                    </div>

                    <div class="glass feature-hover p-6 rounded-xl">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center text-white text-2xl">💬</div>
                            <div>
                                <h3 class="font-semibold text-lg">WhatsApp Contact</h3>
                                <p class="text-sm text-blue-100 mt-1">Message providers directly for faster coordination and quotes.</p>
                            </div>
                        </div>
                    </div>

                    <div class="glass feature-hover p-6 rounded-xl">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-indigo-500 rounded-lg flex items-center justify-center text-white text-2xl">⚡</div>
                            <div>
                                <h3 class="font-semibold text-lg">Fast Booking</h3>
                                <p class="text-sm text-blue-100 mt-1">Request and confirm bookings in seconds with instant notifications.</p>
                            </div>
                        </div>
                    </div>

                    <div class="glass feature-hover p-6 rounded-xl">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-rose-500 rounded-lg flex items-center justify-center text-white text-2xl">👥</div>
                            <div>
                                <h3 class="font-semibold text-lg">Multiple Service Providers</h3>
                                <p class="text-sm text-blue-100 mt-1">Choose from several verified providers for competitive pricing.</p>
                            </div>
                        </div>
                    </div>

                    <div class="glass feature-hover p-6 rounded-xl">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-teal-500 rounded-lg flex items-center justify-center text-white text-2xl">⏱️</div>
                            <div>
                                <h3 class="font-semibold text-lg">Real-time Availability</h3>
                                <p class="text-sm text-blue-100 mt-1">See live availability and book the next available slot nearby.</p>
                            </div>
                        </div>
                    </div>

                    <div class="glass feature-hover p-6 rounded-xl">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-slate-600 rounded-lg flex items-center justify-center text-white text-2xl">🔒</div>
                            <div>
                                <h3 class="font-semibold text-lg">Secure Login System</h3>
                                <p class="text-sm text-blue-100 mt-1">Secure authentication and role-based access for admins and providers.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Contact Section -->
            <section id="contact" class="mt-12">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-extrabold">Contact & Support</h2>
                    <p class="text-blue-100 max-w-2xl mx-auto mt-2">Reach out to us or contact a nearby plumber directly.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                    <div class="md:col-span-2 bg-white/4 glass p-6 rounded-xl">
                        <div class="flex flex-col md:flex-row gap-6">
                            <div class="w-40 h-40 flex-shrink-0 bg-white rounded-lg overflow-hidden">
                                <img src="/images/plumber-logo.svg" alt="plumber" class="w-full h-full object-cover" />
                            </div>
                            <div class="flex-1 text-blue-100">
                                <h3 class="text-xl font-semibold text-white">Plumber Services Office</h3>
                                <p class="mt-2 text-sm">We coordinate local providers and support booking & customer service.</p>

                                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                                    <div class="space-y-1">
                                        <div class="font-medium">Phone</div>
                                        <div>+91 98765 43210</div>
                                    </div>
                                    <div class="space-y-1">
                                        <div class="font-medium">Email</div>
                                        <div>support@plumberservices.example</div>
                                    </div>
                                    <div class="space-y-1">
                                        <div class="font-medium">Address</div>
                                        <div>123 Service Lane, Pune, Maharashtra</div>
                                    </div>
                                    <div class="space-y-1">
                                        <div class="font-medium">WhatsApp</div>
                                        <div><a href="https://wa.me/919876543210" target="_blank" class="inline-flex items-center gap-2 px-3 py-2 bg-green-600 text-white rounded">WhatsApp</a></div>
                                    </div>
                                </div>

                                <div class="mt-6 flex gap-3">
                                    <a href="#" class="w-10 h-10 rounded flex items-center justify-center bg-blue-500">F</a>
                                    <a href="#" class="w-10 h-10 rounded flex items-center justify-center bg-sky-500">T</a>
                                    <a href="#" class="w-10 h-10 rounded flex items-center justify-center bg-pink-500">I</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/4 glass p-6 rounded-xl">
                        <h3 class="text-lg font-semibold text-white">Get in touch</h3>
                        <form action="/contact" method="POST" class="mt-4 space-y-3">
                            @csrf
                            <input name="name" placeholder="Your name" class="w-full p-3 rounded bg-black/20 placeholder-blue-100 text-white" />
                            <input name="email" placeholder="Email" class="w-full p-3 rounded bg-black/20 placeholder-blue-100 text-white" />
                            <textarea name="message" rows="4" placeholder="Message" class="w-full p-3 rounded bg-black/20 placeholder-blue-100 text-white"></textarea>
                            <div class="flex justify-end">
                                <button class="px-4 py-2 bg-emerald-600 rounded text-white">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>

        <footer class="py-6">
            <div class="max-w-7xl mx-auto px-6 text-center text-sm text-blue-200">© {{ date('Y') }} Smart Home Services — Built with care</div>
        </footer>

        <script>
            // splash hide after ~2200ms
            window.addEventListener('load', function(){
                setTimeout(function(){
                    var s = document.getElementById('splash');
                    if(!s) return; s.classList.add('fade-out');
                    setTimeout(function(){ s.style.display='none'; }, 700);
                }, 2200);
            });
        </script>
    </body>
</html>
