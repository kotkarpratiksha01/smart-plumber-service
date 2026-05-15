@extends('layouts.dashboard')

@section('dashboard-content')
<div>
    <h2 class="text-2xl font-bold mb-4">User details</h2>
    <div class="bg-[#0b1220] p-6 rounded-lg">
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ $user->role }}</p>
        <p><strong>Plumber:</strong> {{ optional($user->plumber)->name ?? '-' }}</p>
        <div class="mt-4 flex gap-2">
            <a href="{{ route('dashboard.users.edit', $user->id) }}" class="px-3 py-2 bg-blue-600 text-white rounded">Edit</a>
            <a href="{{ route('dashboard.users.delete', $user->id) }}" class="px-3 py-2 bg-red-600 text-white rounded">Delete</a>
            <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 bg-gray-700 text-white rounded">Back</a>
        </div>
    </div>
</div>
@endsection
