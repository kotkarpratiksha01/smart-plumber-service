@extends('layouts.dashboard')

@section('dashboard-content')
<div>
    <h2 class="text-2xl font-bold mb-4">Edit user</h2>
    @if($errors->any())
        <div class="mb-4 p-3 bg-red-900/60 text-red-100 rounded">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('dashboard.users.update', $user->id) }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-4 max-w-lg">
            <label class="block">
                <span class="text-sm text-gray-300">Name</span>
                <input name="name" value="{{ old('name', $user->name) }}" class="w-full p-2 rounded bg-[#07101a] border border-gray-700 text-white" />
            </label>
            <label class="block">
                <span class="text-sm text-gray-300">Email</span>
                <input name="email" value="{{ old('email', $user->email) }}" class="w-full p-2 rounded bg-[#07101a] border border-gray-700 text-white" />
            </label>
            <label class="block">
                <span class="text-sm text-gray-300">Role</span>
                <select name="role" class="w-full p-2 rounded bg-[#07101a] border border-gray-700 text-white">
                    <option value="user" {{ (old('role', $user->role))==='user' ? 'selected' : '' }}>Customer</option>
                    <option value="plumber" {{ (old('role', $user->role))==='plumber' ? 'selected' : '' }}>Plumber</option>
                    <option value="admin" {{ (old('role', $user->role))==='admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </label>
            <label class="block">
                <span class="text-sm text-gray-300">Assign plumber (optional)</span>
                <select name="plumber_id" class="w-full p-2 rounded bg-[#07101a] border border-gray-700 text-white">
                    <option value="">- none -</option>
                    @foreach($plumbers as $p)
                        <option value="{{ $p->id }}" {{ (old('plumber_id', optional($user->plumber)->id))===$p->id ? 'selected' : ''}}>{{ $p->name }}</option>
                    @endforeach
                </select>
            </label>
            <label class="block">
                <span class="text-sm text-gray-300">New password (leave blank to keep)</span>
                <input name="password" type="password" class="w-full p-2 rounded bg-[#07101a] border border-gray-700 text-white" />
            </label>
            <label class="block">
                <span class="text-sm text-gray-300">Confirm password</span>
                <input name="password_confirmation" type="password" class="w-full p-2 rounded bg-[#07101a] border border-gray-700 text-white" />
            </label>
            <div class="flex gap-2">
                <button class="px-4 py-2 bg-blue-600 rounded text-white">Save</button>
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-700 rounded text-white">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
