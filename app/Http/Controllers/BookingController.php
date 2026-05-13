<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Plumber;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'plumber_id' => 'required|exists:plumbers,id',
            'user_name' => 'required|string',
            'user_phone' => 'required|string',
            'service' => 'required|string',
            'scheduled_at' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $booking = Booking::create($data);

        // Simple response for now
        return redirect()->route('plumbers.show', $booking->plumber_id)->with('success', 'Booking created');
    }
}
