@extends('layouts.app')
@section('content')
<div class="flex min-h-[75vh]">
    <!-- Sidebar -->
    <aside class="w-64 bg-[#07101a] text-gray-200 p-6 shadow-inner">
        <div class="mb-6 flex items-center gap-3">
            <div class="w-12 h-12 bg-emerald-600 rounded flex items-center justify-center">
                <img src="/images/plumber-logo.svg" alt="logo" class="w-8 h-8" />
            </div>
            <div>
                <div class="font-bold text-white">Plumber Services</div>
                <div class="text-sm text-slate-300">{{ session('user_name') ?? (isset($user) ? $user->name : 'Admin User') }}</div>
            </div>
        </div>
        <nav class="flex flex-col gap-2">
            <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded hover:bg-slate-800">Dashboard</a>
            <a href="{{ route('dashboard.plumbers') }}" class="px-3 py-2 rounded hover:bg-slate-800">Plumbers</a>
            <a href="{{ route('dashboard.bookings') }}" class="px-3 py-2 rounded hover:bg-slate-800">Requests</a>
            <form method="POST" action="{{ route('auth.logout') }}">@csrf <button class="w-full text-left px-3 py-2 rounded hover:bg-slate-800">Logout</button></form>
        </nav>
    </aside>

    <!-- Content -->
    <main class="flex-1 p-6 bg-black text-slate-200">
        <div class="max-w-7xl mx-auto">
            @yield('dashboard-content')
        </div>
    </main>
</div>
@endsection
