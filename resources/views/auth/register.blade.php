@extends('layouts.app')
@section('content')
<div class="max-w-xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Create User</h2>

    <form method="POST" action="{{ route('auth.register') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full border rounded px-3 py-2" />
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full border rounded px-3 py-2" />
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" required class="w-full border rounded px-3 py-2" />
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" required class="w-full border rounded px-3 py-2" />
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Role</label>
            <select name="role" class="w-full border rounded px-3 py-2">
                <option value="user">User</option>
                <option value="plumber">Plumber</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Assign Plumber (optional)</label>
            <select name="plumber_id" class="w-full border rounded px-3 py-2">
                <option value="">-- none --</option>
                @foreach(
                    \App\Models\Plumber::orderBy('name')->get() as $p)
                    <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->phone }})</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Create</button>
            <a href="{{ url()->previous() }}" class="text-gray-600">Cancel</a>
        </div>
    </form>
</div>
@endsection
