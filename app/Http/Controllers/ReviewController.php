<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Traits\UploadsFiles;

class ReviewController extends Controller
{
    use UploadsFiles;

    /**
     * @OA\Get(path="/api/reviews", tags={"Reviews"}, summary="List all reviews",
     *     @OA\Response(response=200, description="List of reviews", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Review")))
     * )
     */
    public function index()
    {
        return response()->json(Review::all(), 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Post(path="/api/reviews", tags={"Reviews"}, summary="Create a review (Admin)", security={{"sanctum":{}}},
     *     @OA\RequestBody(required=true, @OA\JsonContent(required={"name","feedback","rating"},
     *         @OA\Property(property="name", type="string"),
     *         @OA\Property(property="role", type="string"),
     *         @OA\Property(property="feedback", type="string"),
     *         @OA\Property(property="rating", type="integer", minimum=1, maximum=5),
     *         @OA\Property(property="image", type="string", description="Image URL or upload via multipart")
     *     )),
     *     @OA\Response(response=201, description="Review created", @OA\JsonContent(ref="#/components/schemas/Review"))
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'role' => 'nullable|string',
            'feedback' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable', // File or String
        ]);

        if ($request->has('image') || $request->hasFile('image')) {
            $validated['image_url'] = $this->uploadFile($request, 'image', 'reviews');
        }
        unset($validated['image']);

        $review = Review::create($validated);
        return response()->json($review, 201, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Put(path="/api/reviews/{id}", tags={"Reviews"}, summary="Update a review (Admin)", security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(required={"name","feedback","rating"},
     *         @OA\Property(property="name", type="string"),
     *         @OA\Property(property="role", type="string"),
     *         @OA\Property(property="feedback", type="string"),
     *         @OA\Property(property="rating", type="integer", minimum=1, maximum=5),
     *         @OA\Property(property="image", type="string")
     *     )),
     *     @OA\Response(response=200, description="Review updated", @OA\JsonContent(ref="#/components/schemas/Review"))
     * )
     */
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'role' => 'nullable|string',
            'feedback' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable',
        ]);

        if ($request->has('image') || $request->hasFile('image')) {
            $validated['image_url'] = $this->uploadFile($request, 'image', 'reviews');
        }
        unset($validated['image']);

        $review->update($validated);
        return response()->json($review, 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Delete(path="/api/reviews/{id}", tags={"Reviews"}, summary="Delete a review (Admin)", security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted")
     * )
     */
    public function destroy($id)
    {
        Review::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
