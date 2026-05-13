@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Available Plumbers</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($plumbers as $plumber)
            <div class="border rounded p-4">
                <h2 class="font-semibold">{{ $plumber->name }}</h2>
                <p class="text-sm text-gray-600">{{ $plumber->location }}</p>
                <p class="text-sm">Services: {{ implode(', ', (array)$plumber->services) }}</p>
                <p class="text-sm">Rating: {{ $plumber->rating }}</p>
                <div class="mt-2 flex gap-2">
                    <a href="{{ route('plumbers.show', $plumber) }}" class="px-3 py-1 bg-[#F53003] text-white rounded">View</a>
                        <a href="https://wa.me/{{ preg_replace('/\D+/', '', $plumber->phone) }}?text={{ urlencode('Hi ' . $plumber->name . ' I need plumbing help') }}" target="_blank" class="px-3 py-1 border rounded">WhatsApp</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-6">{{ $plumbers->links() }}</div>
</div>
@endsection
