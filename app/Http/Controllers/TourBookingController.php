<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\TourBooking;
use Illuminate\Http\Request;

class TourBookingController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/tour-bookings",
     *     tags={"Tour Bookings"},
     *     summary="List all tour bookings (Admin)",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="List of tour bookings", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/TourBooking")))
     * )
     */
    public function index()
    {
        return response()->json(TourBooking::with('tour')->get());
    }

    /**
     * @OA\Post(
     *     path="/api/tour-bookings",
     *     tags={"Tour Bookings"},
     *     summary="Create a tour booking",
     *     description="Books a tour. Calculates total_price automatically based on guests and selected currency.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"tour_id","booking_date","guests","customer_name","customer_email","customer_phone","currency"},
     *             @OA\Property(property="tour_id", type="integer", example=1),
     *             @OA\Property(property="booking_date", type="string", format="date", example="2025-06-15"),
     *             @OA\Property(property="guests", type="integer", example=2),
     *             @OA\Property(property="customer_name", type="string", example="Jane Doe"),
     *             @OA\Property(property="customer_email", type="string", format="email", example="jane@example.com"),
     *             @OA\Property(property="customer_phone", type="string", example="+1234567890"),
     *             @OA\Property(property="currency", type="string", enum={"USD","EUR","GHS"}, example="USD")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Tour booking created", @OA\JsonContent(ref="#/components/schemas/TourBooking")),
     *     @OA\Response(response=422, description="Guest count exceeds maximum or validation error")
     * )
     */
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

    /**
     * @OA\Put(
     *     path="/api/tour-bookings/{id}/status",
     *     tags={"Tour Bookings"},
     *     summary="Update tour booking status (Admin)",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"status"},
     *             @OA\Property(property="status", type="string", enum={"pending","confirmed","cancelled"})
     *         )
     *     ),
     *     @OA\Response(response=200, description="Status updated", @OA\JsonContent(ref="#/components/schemas/TourBooking")),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function updateStatus(Request $request, $id)
    {
        $booking = TourBooking::findOrFail($id);
        $request->validate(['status' => 'required|string']);
        $booking->update(['status' => $request->status]);
        return response()->json($booking);
    }

    /**
     * @OA\Delete(
     *     path="/api/tour-bookings/{id}",
     *     tags={"Tour Bookings"},
     *     summary="Cancel a tour booking (Admin)",
     *     description="Sets tour booking status to 'cancelled'.",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Tour booking cancelled", @OA\JsonContent(@OA\Property(property="message", type="string"))),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        $booking = TourBooking::findOrFail($id);
        $booking->update(['status' => 'cancelled']);
        return response()->json(['message' => 'Tour booking cancelled']);
    }
}
