@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold">Admin Dashboard</h1>
            <p class="text-sm text-gray-300">Welcome, {{ $user->name }}</p>
        </div>
        <div>
            <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow">Create User</a>
        </div>
    </div>

    <div class="bg-transparent p-4">
        <h2 class="font-semibold text-lg mb-3">Registered Users</h2>
        <div class="overflow-auto max-h-96">
            <table class="w-full text-sm">
                <thead class="text-left text-gray-400 text-xs uppercase">
                    <tr>
                        <th class="pb-2">Name</th>
                        <th class="pb-2">Email</th>
                        <th class="pb-2">Role</th>
                        <th class="pb-2">Plumber</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                    <tr class="border-t border-gray-700">
                        <td class="py-2">{{ $u->name }}</td>
                        <td class="py-2 text-gray-300">{{ $u->email }}</td>
                        <td class="py-2"><span class="px-2 py-1 bg-gray-800 rounded">{{ $u->role }}</span></td>
                        <td class="py-2">{{ optional($u->plumber)->name ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
