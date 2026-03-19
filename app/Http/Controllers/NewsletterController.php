<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * @OA\Get(path="/api/newsletter", tags={"Newsletter"}, summary="List all subscribers (Admin)", security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="List of subscribers", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Subscriber")))
     * )
     */
    public function index()
    {
        return response()->json(Subscriber::all());
    }

    /**
     * @OA\Post(path="/api/newsletter", tags={"Newsletter"}, summary="Subscribe to newsletter",
     *     @OA\RequestBody(required=true, @OA\JsonContent(required={"email"},
     *         @OA\Property(property="email", type="string", format="email")
     *     )),
     *     @OA\Response(response=201, description="Subscribed", @OA\JsonContent(ref="#/components/schemas/Subscriber")),
     *     @OA\Response(response=422, description="Email already subscribed")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        $subscriber = Subscriber::create($validated);
        return response()->json($subscriber, 201);
    }
}
