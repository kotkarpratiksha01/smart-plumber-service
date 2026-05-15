@extends('layouts.dashboard')

@section('dashboard-content')
<div>
    <h2 class="text-2xl font-bold mb-4">Delete user</h2>
    <div class="bg-[#0b1220] p-6 rounded-lg">
        <p>Are you sure you want to delete <strong>{{ $user->name }}</strong> ({{ $user->email }})?</p>
        <div class="mt-4 flex gap-2">
            <form method="POST" action="{{ route('dashboard.users.destroy', $user->id) }}">
                @csrf
                @method('DELETE')
                <button class="px-4 py-2 bg-red-600 text-white rounded">Yes, delete</button>
            </form>
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-700 text-white rounded">Cancel</a>
        </div>
    </div>
</div>
@endsection
