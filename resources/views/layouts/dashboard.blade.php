@extends('layouts.app')
@section('content')
<div class="flex min-h-[75vh]">
    <!-- Sidebar -->
    <aside class="w-64 bg-[#07101a] text-gray-200 p-6">
        <div class="mb-6">
            <h2 class="text-lg font-bold">Admin</h2>
            <p class="text-sm text-gray-400">{{ session('user_name') ?? (isset($user) ? $user->name : '') }}</p>
        </div>
        <nav class="flex flex-col gap-2">
            <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded hover:bg-[#0b1724]">Dashboard</a>
            <a href="{{ route('dashboard.plumbers') }}" class="px-3 py-2 rounded hover:bg-[#0b1724]">Plumbers</a>
            <a href="{{ route('requests.index') }}" class="px-3 py-2 rounded hover:bg-[#0b1724]">Requests</a>
            <form method="POST" action="{{ route('auth.logout') }}">@csrf <button class="w-full text-left px-3 py-2 rounded hover:bg-[#0b1724]">Logout</button></form>
        </nav>
    </aside>

    <!-- Content -->
    <main class="flex-1 p-6 bg-[#0b1220] text-white">
        @yield('dashboard-content')
    </main>
</div>
@endsection
