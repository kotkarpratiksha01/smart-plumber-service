@extends('layouts.app')

@section('dashboard-content')
<div class="p-6">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-2xl font-bold">Plumbers & Services</h1>
            <p class="text-sm text-gray-400">Hello, {{ $user->name }} — find trusted plumbers and quick service below.</p>
        </div>
        @if(isset($user) && $user->role === 'admin')
            <div>
                <a href="{{ route('dashboard.plumbers.create') }}" class="inline-block px-4 py-2 bg-emerald-500 text-white rounded">Create Plumber</a>
            </div>
        @endif
    </div>

    @php
        $plumbers = \App\Models\Plumber::orderBy('rating','desc')->take(6)->get();
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($plumbers as $plumber)
            <div class="bg-slate-800 rounded-lg p-4 shadow-md">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 rounded-md bg-emerald-500 flex items-center justify-center text-white font-bold">{{ strtoupper(substr($plumber->name,0,1)) }}</div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold">{{ $plumber->name }}</h3>
                            <div class="text-sm text-amber-400">⭐ {{ number_format($plumber->rating ?? 0,1) }}</div>
                        </div>
                        @if($plumber->location)
                            <div class="text-sm text-gray-400">{{ $plumber->location }}</div>
                        @endif
                        @if($plumber->services)
                            @php
                                $servicesText = is_array($plumber->services) ? implode(', ', $plumber->services) : $plumber->services;
                            @endphp
                            <div class="mt-2 text-sm text-gray-300">Services: {{ \Illuminate\Support\Str::limit($servicesText, 80) }}</div>
                        @endif
                        @if(!empty($plumber->bio))
                            <div class="mt-2 text-sm text-gray-300">{{ \Illuminate\Support\Str::limit($plumber->bio, 100) }}</div>
                        @endif
                        <div class="mt-3 flex items-center space-x-2">
                            <a href="{{ route('plumbers.show', $plumber->id) }}" class="px-3 py-1 bg-emerald-500 text-white rounded text-sm">Info</a>
                            @if($plumber->phone)
                                <a href="tel:{{ $plumber->phone }}" class="px-3 py-1 border border-slate-700 text-sm rounded">Call</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-gray-400">No plumbers available right now.</div>
        @endforelse
    </div>

    <section class="mt-8">
        <h2 class="text-xl font-bold mb-3">Plumber Features</h2>
        <div class="mb-4">
            @if (file_exists(public_path('images/plumber-logo.svg')))
                <img src="{{ asset('images/plumber-logo.svg') }}" alt="Plumber features" class="w-40 h-auto">
            @else
                <img src="https://via.placeholder.com/400x120?text=Plumber+Features" alt="Plumber features" class="w-40 h-auto">
            @endif
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 bg-slate-800 rounded-lg">
                <h4 class="font-semibold">Fast Response</h4>
                <p class="text-sm text-gray-400">Plumbers reply quickly and reach you on time for emergencies.</p>
            </div>
            <div class="p-4 bg-slate-800 rounded-lg">
                <h4 class="font-semibold">Verified & Rated</h4>
                <p class="text-sm text-gray-400">Each plumber has ratings and a brief profile to help you choose.</p>
            </div>
            <div class="p-4 bg-slate-800 rounded-lg">
                <h4 class="font-semibold">Transparent Pricing</h4>
                <p class="text-sm text-gray-400">Estimates are visible up-front so there are no surprises.</p>
            </div>
        </div>
    </section>

</div>
@endsection
