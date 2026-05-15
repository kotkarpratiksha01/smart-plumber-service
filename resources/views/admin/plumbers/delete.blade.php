@extends('layouts.dashboard')

@section('content')
<div class="p-6">
    <div class="max-w-2xl mx-auto bg-slate-800 p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-4 text-white">Delete Plumber</h2>
        <p class="text-slate-300">Are you sure you want to delete <strong class="text-white">{{ $plumber->name }}</strong>?</p>

        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('dashboard.plumbers') }}" class="px-4 py-2 rounded bg-slate-700 text-white">Cancel</a>
            <form action="{{ route('dashboard.plumbers.destroy', $plumber) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="px-4 py-2 rounded bg-red-600 text-white">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
