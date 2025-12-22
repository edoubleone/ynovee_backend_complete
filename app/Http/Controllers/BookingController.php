<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function index()
    {
        return response()->json(Booking::with('roomType')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer', // spec says 'guests' in payload, 'guests_count' in db
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'currency' => 'required|string',
            'images' => 'nullable', // Allow multiple files
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $roomType = RoomType::findOrFail($validated['room_type_id']);

        // Availability Check
        $overlappingBookings = Booking::where('room_type_id', $roomType->id)
            ->where('status', '!=', 'cancelled')
            ->where('check_in', '<', $validated['check_out'])
            ->where('check_out', '>', $validated['check_in'])
            ->count();

        if ($overlappingBookings >= $roomType->total_rooms) {
            return response()->json(['error' => 'Room not available for selected dates'], 422);
        }

        // Map payload 'guests' to db 'guests_count'
        $validated['guests_count'] = $validated['guests'];
        unset($validated['guests']);

        // Calculate Total Price
        $nights = (strtotime($validated['check_out']) - strtotime($validated['check_in'])) / 86400;
        if ($nights < 1) $nights = 1;
        
        $pricePerNight = 0;
        switch($validated['currency']) {
            case 'USD': $pricePerNight = $roomType->price_usd; break;
            case 'EUR': $pricePerNight = $roomType->price_eur; break;
            case 'GHS': $pricePerNight = $roomType->price_ghs; break;
            default: $pricePerNight = $roomType->price_usd; // Fallback
        }
        $validated['total_price'] = $pricePerNight * $nights;
        $validated['status'] = 'pending';

        // Handle Image Uploads
        $imageLinks = [];
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            if (!is_array($files)) {
                $files = [$files];
            }
            foreach($files as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('bookings', $filename, 'public');
                $imageLinks[] = \Illuminate\Support\Facades\Storage::disk('public')->url($path);
            }
        }
        $validated['images'] = $imageLinks;

        $booking = Booking::create($validated);

        // Email Notification Dummy
        Log::info('Sending confirmation email to ' . $validated['customer_email']);

        return response()->json($booking, 201);
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $request->validate(['status' => 'required|string']);
        $booking->update(['status' => $request->status]);
        return response()->json($booking);
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'cancelled']);
        return response()->json(['message' => 'Booking cancelled']);
    }
}
