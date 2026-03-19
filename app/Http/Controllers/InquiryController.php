<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * @OA\Get(path="/api/inquiries", tags={"Inquiries"}, summary="List all inquiries (Admin)", security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="List of inquiries", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Inquiry")))
     * )
     */
    public function index()
    {
        return response()->json(Inquiry::all());
    }

    /**
     * @OA\Post(path="/api/inquiries", tags={"Inquiries"}, summary="Submit a contact inquiry",
     *     @OA\RequestBody(required=true, @OA\JsonContent(required={"name","email","message"},
     *         @OA\Property(property="name", type="string"),
     *         @OA\Property(property="email", type="string", format="email"),
     *         @OA\Property(property="message", type="string")
     *     )),
     *     @OA\Response(response=201, description="Inquiry submitted", @OA\JsonContent(ref="#/components/schemas/Inquiry"))
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $inquiry = Inquiry::create($validated);
        return response()->json($inquiry, 201);
    }
}
