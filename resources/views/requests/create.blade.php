@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">New Service Request</h2>

    <form method="POST" action="{{ route('requests.store') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-sm">Title</label>
            <input name="title" required class="w-full border rounded px-3 py-2" />
        </div>
        <div class="mb-4">
            <label class="block text-sm">Service (optional)</label>
            <input name="service" class="w-full border rounded px-3 py-2" />
        </div>
        <div class="mb-4">
            <label class="block text-sm">Details</label>
            <textarea name="details" class="w-full border rounded px-3 py-2"></textarea>
        </div>
        <div class="flex gap-2">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Submit</button>
            <a href="{{ url('/') }}" class="px-4 py-2 border rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection
