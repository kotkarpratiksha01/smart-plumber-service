@extends('layouts.app')

@section('content')
<div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold">{{ $plumber->name }}</h1>
    <p class="text-sm text-gray-600">{{ $plumber->location }}</p>
    <p class="mt-2">Services: {{ implode(', ', (array)$plumber->services) }}</p>
    <p class="mt-1">Rating: {{ $plumber->rating }}</p>
    <p class="mt-1">Experience: {{ $plumber->experience_years }} years</p>

    <div class="mt-4 flex gap-3">
        <a href="https://wa.me/{{ preg_replace('/\\D+/', '', $plumber->phone) }}?text={{ urlencode('Hello ' . $plumber->name . ' I would like to book a service') }}" target="_blank" class="px-4 py-2 bg-green-600 text-white rounded">Contact on WhatsApp</a>
    </div>

    <div class="mt-6">
        <h2 class="text-lg font-semibold">Book a service</h2>
        <form action="{{ route('bookings.store') }}" method="POST" class="mt-3">
            @csrf
            <input type="hidden" name="plumber_id" value="{{ $plumber->id }}" />
            <div class="grid gap-3">
                <input name="user_name" placeholder="Your name" class="border rounded p-2" required />
                <input name="user_phone" placeholder="Phone" class="border rounded p-2" required />
                <input name="service" placeholder="Service required" class="border rounded p-2" required />
                <input name="scheduled_at" type="datetime-local" class="border rounded p-2" required />
                <textarea name="notes" placeholder="Notes" class="border rounded p-2"></textarea>
                <button class="px-4 py-2 bg-[#F53003] text-white rounded">Request Booking</button>
            </div>
        </form>
    </div>
</div>
@endsection
