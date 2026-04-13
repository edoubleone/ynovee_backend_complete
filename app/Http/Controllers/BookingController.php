<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class BookingController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/bookings",
     *     tags={"Bookings"},
     *     summary="List all bookings (Admin)",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="List of bookings with room type", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Booking")))
     * )
     */
    public function index()
    {
        return response()->json(Booking::with('roomType')->get());
    }

    /**
     * @OA\Post(
     *     path="/api/bookings",
     *     tags={"Bookings"},
     *     summary="Create a booking",
     *     description="Creates a booking after checking room availability. Calculates total_price automatically.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"room_type_id","check_in","check_out","guests","customer_name","customer_email","customer_phone","currency"},
     *             @OA\Property(property="room_type_id", type="integer", example=1),
     *             @OA\Property(property="check_in", type="string", format="date", example="2025-01-01"),
     *             @OA\Property(property="check_out", type="string", format="date", example="2025-01-05"),
     *             @OA\Property(property="guests", type="integer", example=2),
     *             @OA\Property(property="customer_name", type="string", example="John Doe"),
     *             @OA\Property(property="customer_email", type="string", format="email", example="john@example.com"),
     *             @OA\Property(property="customer_phone", type="string", example="+1234567890"),
     *             @OA\Property(property="currency", type="string", enum={"USD","EUR","GHS"}, example="USD")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Booking created", @OA\JsonContent(ref="#/components/schemas/Booking")),
     *     @OA\Response(response=422, description="Room not available or validation error")
     * )
     */
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

        // Availability Check — only confirmed/checked_in bookings block the room.
        // Pending bookings are reviewed by admin; only confirmed ones occupy the room.
        $overlappingBookings = Booking::where('room_type_id', $roomType->id)
            ->whereIn('status', ['confirmed', 'checked_in'])
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
            foreach ($files as $file) {
                $result = Cloudinary::uploadApi()->upload($file->getRealPath(), ['folder' => 'bookings']);
                $imageLinks[] = $result['secure_url'];
            }
        }
        $validated['images'] = $imageLinks;

        $booking = Booking::create($validated);

        // Email Notification Dummy
        Log::info('Sending confirmation email to ' . $validated['customer_email']);

        return response()->json($booking, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/bookings/{id}/status",
     *     tags={"Bookings"},
     *     summary="Update booking status (Admin)",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"status"},
     *             @OA\Property(property="status", type="string", enum={"pending","confirmed","checked_in","checked_out","cancelled"})
     *         )
     *     ),
     *     @OA\Response(response=200, description="Status updated", @OA\JsonContent(ref="#/components/schemas/Booking")),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $request->validate(['status' => 'required|string']);
        $booking->update(['status' => $request->status]);
        return response()->json($booking);
    }

    /**
     * @OA\Delete(
     *     path="/api/bookings/{id}",
     *     tags={"Bookings"},
     *     summary="Cancel a booking (Admin)",
     *     description="Sets booking status to 'cancelled', immediately releasing room inventory.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Booking cancelled", @OA\JsonContent(@OA\Property(property="message", type="string"))),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'cancelled']);
        return response()->json(['message' => 'Booking cancelled']);
    }
}
