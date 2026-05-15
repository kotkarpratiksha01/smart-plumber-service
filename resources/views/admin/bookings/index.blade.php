@extends('layouts.dashboard')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold mb-4 text-white">Booking Requests</h1>

    <div class="bg-slate-800 rounded p-4">
        @if($bookings->count())
            <table class="w-full table-auto text-sm text-left">
                <thead>
                    <tr class="text-slate-300">
                        <th class="px-3 py-2">Plumber</th>
                        <th class="px-3 py-2">Customer</th>
                        <th class="px-3 py-2">Phone</th>
                        <th class="px-3 py-2">Service</th>
                        <th class="px-3 py-2">Scheduled</th>
                        <th class="px-3 py-2">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $b)
                        <tr class="border-t border-slate-700">
                            <td class="px-3 py-2 text-white">{{ optional($b->plumber)->name }}</td>
                            <td class="px-3 py-2 text-slate-300">{{ $b->user_name }}</td>
                            <td class="px-3 py-2 text-slate-300">{{ $b->user_phone }}</td>
                            <td class="px-3 py-2 text-slate-300">{{ $b->service }}</td>
                            <td class="px-3 py-2 text-slate-300">{{ $b->scheduled_at }}</td>
                            <td class="px-3 py-2 text-slate-300">{{ $b->notes }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">{{ $bookings->links() }}</div>
        @else
            <p class="text-slate-300">No booking requests yet.</p>
        @endif
    </div>
</div>
@endsection
