<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class TourController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/tours",
     *     tags={"Tours"},
     *     summary="List all tours",
     *     @OA\Response(response=200, description="List of tours", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Tour")))
     * )
     */
    public function index(Request $request)
    {
        $query = Tour::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%');
            });
        }

        return response()->json($query->get(), 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Get(
     *     path="/api/tours/{id}",
     *     tags={"Tours"},
     *     summary="Get a tour",
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Tour details with bookings", @OA\JsonContent(ref="#/components/schemas/Tour")),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        $tour = Tour::with('bookings')->findOrFail($id);
        return response()->json($tour, 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Post(
     *     path="/api/tours",
     *     tags={"Tours"},
     *     summary="Create a tour (Admin)",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"title","max_guests"},
     *                 @OA\Property(property="title", type="string", example="Accra City Tour"),
     *                 @OA\Property(property="description", type="string"),
     *                 @OA\Property(property="location", type="string"),
     *                 @OA\Property(property="duration", type="string", example="3 hours"),
     *                 @OA\Property(property="price_usd", type="number", example=50.00),
     *                 @OA\Property(property="price_eur", type="number", example=46.00),
     *                 @OA\Property(property="price_ghs", type="number", example=700.00),
     *                 @OA\Property(property="max_guests", type="integer", example=10),
     *                 @OA\Property(property="category", type="string"),
     *                 @OA\Property(property="inclusions", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="exclusions", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="images", type="array", @OA\Items(type="string", format="binary")),
     *                 @OA\Property(property="is_featured", type="boolean"),
     *                 @OA\Property(property="status", type="string", example="active")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=201, description="Tour created", @OA\JsonContent(ref="#/components/schemas/Tour")),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'duration' => 'nullable|string',
            'price_usd' => 'nullable|numeric',
            'price_eur' => 'nullable|numeric',
            'price_ghs' => 'nullable|numeric',
            'max_guests' => 'required|integer',
            'category' => 'nullable|string',
            'inclusions' => 'nullable|array',
            'exclusions' => 'nullable|array',
            'images' => 'nullable',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|string',
        ]);

        $validated['images'] = $this->handleImages($request);

        $tour = Tour::create($validated);
        return response()->json($tour, 201, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Post(
     *     path="/api/tours/{id}",
     *     tags={"Tours"},
     *     summary="Update a tour (Admin) — multipart",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(property="title", type="string"),
     *                 @OA\Property(property="description", type="string"),
     *                 @OA\Property(property="location", type="string"),
     *                 @OA\Property(property="duration", type="string"),
     *                 @OA\Property(property="price_usd", type="number"),
     *                 @OA\Property(property="price_eur", type="number"),
     *                 @OA\Property(property="price_ghs", type="number"),
     *                 @OA\Property(property="max_guests", type="integer"),
     *                 @OA\Property(property="category", type="string"),
     *                 @OA\Property(property="inclusions", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="exclusions", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="images", type="array", @OA\Items(type="string", format="binary")),
     *                 @OA\Property(property="is_featured", type="boolean"),
     *                 @OA\Property(property="status", type="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=200, description="Tour updated", @OA\JsonContent(ref="#/components/schemas/Tour")),
     *     @OA\Response(response=404, description="Not found")
     * )
     *
     * @OA\Put(
     *     path="/api/tours/{id}",
     *     tags={"Tours"},
     *     summary="Update a tour (Admin) — JSON",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="location", type="string"),
     *             @OA\Property(property="duration", type="string"),
     *             @OA\Property(property="price_usd", type="number"),
     *             @OA\Property(property="price_eur", type="number"),
     *             @OA\Property(property="price_ghs", type="number"),
     *             @OA\Property(property="max_guests", type="integer"),
     *             @OA\Property(property="category", type="string"),
     *             @OA\Property(property="is_featured", type="boolean"),
     *             @OA\Property(property="status", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Tour updated", @OA\JsonContent(ref="#/components/schemas/Tour")),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function update(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'duration' => 'nullable|string',
            'price_usd' => 'nullable|numeric',
            'price_eur' => 'nullable|numeric',
            'price_ghs' => 'nullable|numeric',
            'max_guests' => 'sometimes|required|integer',
            'category' => 'nullable|string',
            'inclusions' => 'nullable|array',
            'exclusions' => 'nullable|array',
            'images' => 'nullable',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|string',
        ]);

        if ($request->hasFile('images')) {
            // Delete old Cloudinary images first
            if ($tour->images) {
                foreach ($tour->images as $oldImageUrl) {
                    $publicId = $this->extractCloudinaryPublicId($oldImageUrl);
                    if ($publicId) {
                        Cloudinary::uploadApi()->destroy($publicId);
                    }
                }
            }
            $validated['images'] = $this->handleImages($request);
        }

        $tour->update($validated);
        return response()->json($tour, 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Delete(
     *     path="/api/tours/{id}",
     *     tags={"Tours"},
     *     summary="Delete a tour (Admin)",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function destroy($id)
    {
        Tour::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    private function handleImages(Request $request): array
    {
        $imageLinks = [];
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            if (!is_array($files)) {
                $files = [$files];
            }
            foreach ($files as $file) {
                $result = Cloudinary::uploadApi()->upload($file->getRealPath(), ['folder' => 'tours']);
                $imageLinks[] = $result['secure_url'];
            }
        }
        return $imageLinks;
    }

    private function extractCloudinaryPublicId(string $url): ?string
    {
        // Cloudinary URL format: https://res.cloudinary.com/{cloud}/image/upload/v{ver}/{public_id}.{ext}
        if (preg_match('/\/image\/upload\/(?:v\d+\/)?(.+)\.[a-z]+$/i', $url, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
