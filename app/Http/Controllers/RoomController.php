<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\UploadsFiles;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class RoomController extends Controller
{
    use UploadsFiles;

    /**
     * @OA\Get(
     *     path="/api/rooms",
     *     tags={"Rooms"},
     *     summary="List all room types",
     *     description="Returns all room types. Optionally filter by availability and guest capacity.",
     *     @OA\Parameter(name="start_date", in="query", required=false, @OA\Schema(type="string", format="date"), description="Check-in date for availability filter"),
     *     @OA\Parameter(name="end_date", in="query", required=false, @OA\Schema(type="string", format="date"), description="Check-out date for availability filter"),
     *     @OA\Parameter(name="guests", in="query", required=false, @OA\Schema(type="integer"), description="Minimum guest capacity"),
     *     @OA\Response(response=200, description="List of room types", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/RoomType")))
     * )
     */
    public function index(Request $request)
    {
        $query = RoomType::query();

        // Filter by capacity
        if ($request->has('guests')) {
            $query->where('capacity', '>=', $request->query('guests'));
        }

        // Filter by availability
        if ($request->has(['start_date', 'end_date'])) {
            $startDate = $request->query('start_date');
            $endDate = $request->query('end_date');

            // We need to find RoomTypes where (bookings overlapping < total_rooms)
            // It's easier to fetch all (or capacity filtered) and then filter by availability in PHP
            // to avoid complex SQL group by having logic, unless dataset is huge.
            // For a hotel with < 50 room types, PHP filtering is fine.
            
            // Only confirmed/checked_in bookings block room availability.
            // Pending bookings do not block — admin approves/rejects as needed.
            $roomTypes = $query->withCount(['bookings' => function (Builder $query) use ($startDate, $endDate) {
                $query->whereIn('status', ['confirmed', 'checked_in'])
                      ->where('check_in', '<', $endDate)
                      ->where('check_out', '>', $startDate);
            }])->get();

            $availableRooms = $roomTypes->filter(function ($room) {
                return $room->bookings_count < $room->total_rooms;
            })->values();

            return response()->json($availableRooms);
        }

        return response()->json($query->get(), 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Get(
     *     path="/api/rooms/{id}",
     *     tags={"Rooms"},
     *     summary="Get a room type",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Room type details", @OA\JsonContent(ref="#/components/schemas/RoomType")),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        return response()->json(RoomType::findOrFail($id), 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Post(
     *     path="/api/rooms",
     *     tags={"Rooms"},
     *     summary="Create a room type (Admin)",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"name","description","capacity","price_usd","price_eur","price_ghs","total_rooms"},
     *                 @OA\Property(property="name", type="string", example="Deluxe Suite"),
     *                 @OA\Property(property="description", type="string"),
     *                 @OA\Property(property="capacity", type="integer", example=2),
     *                 @OA\Property(property="price_usd", type="number", example=150.00),
     *                 @OA\Property(property="price_eur", type="number", example=140.00),
     *                 @OA\Property(property="price_ghs", type="number", example=2500.00),
     *                 @OA\Property(property="total_rooms", type="integer", example=5),
     *                 @OA\Property(property="amenities", type="array", @OA\Items(type="integer")),
     *                 @OA\Property(property="images", type="array", @OA\Items(type="string", format="binary"))
     *             )
     *         )
     *     ),
     *     @OA\Response(response=201, description="Room type created", @OA\JsonContent(ref="#/components/schemas/RoomType")),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'capacity' => 'required|integer',
            'price_usd' => 'required|numeric',
            'price_eur' => 'required|numeric',
            'price_ghs' => 'required|numeric',
            'total_rooms' => 'required|integer',
            'images' => 'nullable', // Flexible input
            'image_url' => 'nullable', // Legacy fallback
            'amenities' => 'nullable|array', // List of Amenity IDs
        ]);

        $imageLinks = [];

        // 1. Handle File Uploads (Multiple)
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            if (!is_array($files)) {
                $files = [$files];
            }
            foreach ($files as $file) {
                $result = Cloudinary::uploadApi()->upload($file->getRealPath(), ['folder' => 'rooms']);
                $imageLinks[] = $result['secure_url'];
            }
        }

        // 2. Handle Text Input (Comma Separated) or Array of URLs
        if ($request->has('images') && ! $request->hasFile('images')) {
             $input = $request->input('images');
             if (is_string($input)) {
                 $links = array_filter(array_map('trim', explode(',', $input)));
                 $imageLinks = array_merge($imageLinks, $links);
             } elseif (is_array($input)) {
                 $imageLinks = array_merge($imageLinks, $input);
             }
        }

        // 3. Legacy single image_url fallback
        if ($request->hasFile('image_url')) {
             $imageLinks[] = $this->uploadFile($request, 'image_url', 'rooms');
        } elseif ($request->input('image_url')) {
             $imageLinks[] = $request->input('image_url');
        }

        // Ensure unique and values
        $validated['images'] = array_values(array_unique($imageLinks));
        unset($validated['image_url']);

        $room = RoomType::create($validated);
        return response()->json($room, 201, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Put(
     *     path="/api/rooms/{id}",
     *     tags={"Rooms"},
     *     summary="Update a room type (Admin)",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","description","capacity","price_usd","price_eur","price_ghs","total_rooms"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="capacity", type="integer"),
     *             @OA\Property(property="price_usd", type="number"),
     *             @OA\Property(property="price_eur", type="number"),
     *             @OA\Property(property="price_ghs", type="number"),
     *             @OA\Property(property="total_rooms", type="integer"),
     *             @OA\Property(property="amenities", type="array", @OA\Items(type="integer")),
     *             @OA\Property(property="images", type="array", @OA\Items(type="string"))
     *         )
     *     ),
     *     @OA\Response(response=200, description="Room type updated", @OA\JsonContent(ref="#/components/schemas/RoomType")),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $room = RoomType::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'capacity' => 'sometimes|required|integer',
            'price_usd' => 'sometimes|required|numeric',
            'price_eur' => 'sometimes|required|numeric',
            'price_ghs' => 'sometimes|required|numeric',
            'total_rooms' => 'sometimes|required|integer',
            'images' => 'nullable',
            'image_url' => 'nullable',
            'amenities' => 'nullable|array',
        ]);

        // Logic to Append or Replace? 
        // usually 'images' in update REPLACES the array.
        // But if we want to support appending, we'd need a specific flag or endpoint.
        // For now, standard REST: PUT replaces content.
        
        $imageLinks = [];

        // 1. Handle File Uploads (Multiple)
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            if (!is_array($files)) {
                $files = [$files];
            }
            foreach ($files as $file) {
                $result = Cloudinary::uploadApi()->upload($file->getRealPath(), ['folder' => 'rooms']);
                $imageLinks[] = $result['secure_url'];
            }
        }

        // 2. Handle Text Input or Array
        if ($request->has('images') && ! $request->hasFile('images')) {
             $input = $request->input('images');
             if (is_string($input)) {
                 $links = array_filter(array_map('trim', explode(',', $input)));
                 $imageLinks = array_merge($imageLinks, $links);
             } elseif (is_array($input)) {
                 $imageLinks = array_merge($imageLinks, $input);
             }
        }

        // 3. Legacy single image_url fallback
        if ($request->hasFile('image_url')) {
             $imageLinks[] = $this->uploadFile($request, 'image_url', 'rooms');
        } elseif ($request->input('image_url')) {
             $imageLinks[] = $request->input('image_url');
        }

        // If no images provided at all, maybe keep existing? 
        // PUT usually implies full update. 
        // If $imageLinks is result of input processing and input was provided, use it.
        // If 'images' key was NOT present, we usually don't touch it (skip).
        // But here we checked $request->has...
        
        if ($request->has('images') || $request->has('image_url') || $request->hasFile('images')) {
            $validated['images'] = array_values(array_unique($imageLinks));
        }

        unset($validated['image_url']);

        $room->update($validated);
        return response()->json($room, 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Delete(
     *     path="/api/rooms/{id}",
     *     tags={"Rooms"},
     *     summary="Delete a room type (Admin)",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        RoomType::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
