@extends('layouts.dashboard')

@section('dashboard-content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Manage Requests</h1>

    <div class="bg-[#07101a] p-4 rounded">
        <table class="w-full text-sm">
            <thead class="text-left text-gray-400 text-xs uppercase">
                <tr>
                    <th class="pb-2">User</th>
                    <th class="pb-2">Title</th>
                    <th class="pb-2">Service</th>
                    <th class="pb-2">Status</th>
                    <th class="pb-2">Assign</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $r)
                <tr class="border-t border-gray-700">
                    <td class="py-2">{{ optional($r->user)->name }}</td>
                    <td class="py-2">{{ $r->title }}</td>
                    <td class="py-2">{{ $r->service }}</td>
                    <td class="py-2">{{ $r->status }}</td>
                    <td class="py-2">
                        <form method="POST" action="{{ route('requests.assign', $r) }}">
                            @csrf
                            <select name="plumber_id" class="px-2 py-1 bg-gray-800 text-sm">
                                <option value="">-- assign --</option>
                                @foreach(\App\Models\Plumber::orderBy('name')->get() as $p)
                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                @endforeach
                            </select>
                            <button class="ml-2 bg-green-600 px-2 py-1 rounded">Assign</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
