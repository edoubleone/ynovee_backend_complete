<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\RoomType;

class PaymentController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/create-payment-intent",
     *     tags={"Payments"},
     *     summary="Create Stripe payment intent",
     *     description="Calculates total price and creates a Stripe PaymentIntent. Returns the client secret for frontend confirmation.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"room_type_id","check_in","check_out","guests","currency"},
     *             @OA\Property(property="room_type_id", type="integer", example=1),
     *             @OA\Property(property="check_in", type="string", format="date", example="2025-01-01"),
     *             @OA\Property(property="check_out", type="string", format="date", example="2025-01-05"),
     *             @OA\Property(property="guests", type="integer", example=2),
     *             @OA\Property(property="currency", type="string", enum={"USD","EUR","GHS"}, example="USD")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Payment intent created",
     *         @OA\JsonContent(
     *             @OA\Property(property="clientSecret", type="string", example="pi_12345_secret_abcde"),
     *             @OA\Property(property="amount", type="number", example=750.00)
     *         )
     *     ),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=500, description="Stripe error")
     * )
     */
    public function createPaymentIntent(Request $request)
    {
        $validated = $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer',
            'currency' => 'required|string',
        ]);

        $roomType = RoomType::findOrFail($validated['room_type_id']);

        $nights = (strtotime($validated['check_out']) - strtotime($validated['check_in'])) / 86400;
        if ($nights < 1) $nights = 1;

        $pricePerNight = 0;
        switch($validated['currency']) {
            case 'USD': $pricePerNight = $roomType->price_usd; break;
            case 'EUR': $pricePerNight = $roomType->price_eur; break;
            case 'GHS': $pricePerNight = $roomType->price_ghs; break;
            default: $pricePerNight = $roomType->price_usd; // Fallback
        }

        $amount = $pricePerNight * $nights;
        
        // Stripe expects amount in smallest currency unit (cents), except for some zero-decimal currencies.
        // USD, EUR, GHS all have 2 decimals.
        $amountInCents = round($amount * 100);

        // Todo: Set Stripe API Key from env
        Stripe::setApiKey(env('STRIPE_SECRET_KEY', 'sk_test_mock'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $amountInCents,
                'currency' => strtolower($validated['currency']),
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
                'metadata' => [
                    'room_type_id' => $roomType->id,
                    'check_in' => $validated['check_in'],
                    'check_out' => $validated['check_out'],
                ]
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
                'amount' => $amount
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
