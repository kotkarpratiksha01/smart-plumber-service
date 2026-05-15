@extends('layouts.dashboard')

@section('content')
<div class="p-6">
    <div class="max-w-3xl mx-auto bg-slate-800 p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-4 text-white">Edit Plumber</h2>

        @if ($errors->any())
            <div class="mb-4 text-sm text-red-400">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dashboard.plumbers.update', $plumber) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm text-slate-300">Name</label>
                <input name="name" value="{{ old('name', $plumber->name) }}" class="mt-1 block w-full rounded bg-slate-900 border border-slate-700 text-white p-2" required />
            </div>
            <div>
                <label class="block text-sm text-slate-300">Phone</label>
                <input name="phone" value="{{ old('phone', $plumber->phone) }}" class="mt-1 block w-full rounded bg-slate-900 border border-slate-700 text-white p-2" />
            </div>
            <div>
                <label class="block text-sm text-slate-300">Location</label>
                <input name="location" value="{{ old('location', $plumber->location) }}" class="mt-1 block w-full rounded bg-slate-900 border border-slate-700 text-white p-2" />
            </div>
            <div>
                <label class="block text-sm text-slate-300">Services (comma separated)</label>
                @php
                    $__services_val = old('services', $plumber->services);
                    if (is_array($__services_val)) {
                        $__services_val = implode(', ', $__services_val);
                    }
                @endphp
                <textarea name="services" rows="3" class="mt-1 block w-full rounded bg-slate-900 border border-slate-700 text-white p-2">{{ $__services_val }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-slate-300">Rating</label>
                    <input name="rating" value="{{ old('rating', $plumber->rating) }}" class="mt-1 block w-full rounded bg-slate-900 border border-slate-700 text-white p-2" />
                </div>
                <div>
                    <label class="block text-sm text-slate-300">Experience (years)</label>
                    <input name="experience_years" value="{{ old('experience_years', $plumber->experience_years) }}" class="mt-1 block w-full rounded bg-slate-900 border border-slate-700 text-white p-2" />
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <label class="flex items-center text-sm text-slate-300">
                    <input type="checkbox" name="available" value="1" {{ $plumber->available ? 'checked' : '' }} class="mr-2" /> Available
                </label>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('dashboard.plumbers') }}" class="px-4 py-2 rounded bg-slate-700 text-white mr-2">Cancel</a>
                <button class="px-4 py-2 rounded bg-indigo-600 text-white">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
