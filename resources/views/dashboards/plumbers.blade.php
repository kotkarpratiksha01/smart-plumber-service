@extends('layouts.dashboard')

@section('dashboard-content')
<div class="py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold">Nearby Plumbers</h1>
        @if(isset($user) && $user->role === 'admin')
            <a href="{{ route('dashboard.plumbers.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded">Create Plumber</a>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($plumbers as $plumber)
            @php
                $services = $plumber->services;
                if (is_string($services)) {
                    $servicesArr = json_decode($services, true) ?: [];
                } elseif (is_array($services)) {
                    $servicesArr = $services;
                } else {
                    $servicesArr = [];
                }
                $servicesText = implode(', ', $servicesArr);
                $phoneDigits = $plumber->phone ? preg_replace('/\D+/', '', $plumber->phone) : null;
            @endphp

            <div class="bg-slate-900 rounded-lg shadow p-5 border border-slate-800">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-white">{{ $plumber->name }}</h2>
                        <p class="text-sm text-slate-400">{{ $plumber->location }}</p>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-emerald-400 font-semibold">Rating</div>
                        <div class="text-lg font-bold text-white">{{ $plumber->rating ?? 'N/A' }}</div>
                    </div>
                </div>

                <p class="mt-3 text-sm text-slate-400">Services: {{ $servicesText ?: '—' }}</p>

                <div class="mt-4 flex items-center gap-3">
                    <a href="{{ route('plumbers.show', $plumber) }}" class="px-4 py-2 bg-emerald-600 text-white rounded">View</a>
                    @if($phoneDigits)
                        <a href="https://wa.me/{{ $phoneDigits }}?text={{ urlencode('Hi ' . $plumber->name . ' I need plumbing help') }}" target="_blank" class="px-4 py-2 border rounded text-slate-200 border-slate-700">WhatsApp</a>
                    @endif
                    @if(isset($user) && $user->role === 'admin')
                        <a href="{{ route('dashboard.plumbers.edit', $plumber) }}" class="px-3 py-1 bg-amber-500 text-white rounded">Edit</a>
                        <form action="{{ route('dashboard.plumbers.destroy', $plumber) }}" method="POST" class="inline" onsubmit="return confirm('Delete plumber?');">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 text-white rounded">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-slate-500">No plumbers found.</div>
        @endforelse
    </div>

    <div class="mt-8">{{ $plumbers->links() }}</div>
</div>
@endsection
