<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\TourBooking;
use Illuminate\Http\Request;

class TourBookingController extends Controller
{
    public function index()
    {
        return response()->json(TourBooking::with('tour')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'booking_date' => 'required|date',
            'guests' => 'required|integer|min:1',
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'currency' => 'required|string|in:USD,EUR,GHS',
        ]);

        $tour = Tour::findOrFail($validated['tour_id']);

        if ($validated['guests'] > $tour->max_guests) {
            return response()->json(['error' => 'Guest count exceeds maximum allowed for this tour'], 422);
        }

        $validated['guests_count'] = $validated['guests'];
        unset($validated['guests']);

        $pricePerGuest = match ($validated['currency']) {
            'EUR' => $tour->price_eur,
            'GHS' => $tour->price_ghs,
            default => $tour->price_usd,
        };

        $validated['total_price'] = $pricePerGuest * $validated['guests_count'];
        $validated['status'] = 'pending';

        $booking = TourBooking::create($validated);
        $booking->load('tour');

        return response()->json($booking, 201);
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = TourBooking::findOrFail($id);
        $request->validate(['status' => 'required|string']);
        $booking->update(['status' => $request->status]);
        return response()->json($booking);
    }

    public function destroy($id)
    {
        $booking = TourBooking::findOrFail($id);
        $booking->update(['status' => 'cancelled']);
        return response()->json(['message' => 'Tour booking cancelled']);
    }
}
