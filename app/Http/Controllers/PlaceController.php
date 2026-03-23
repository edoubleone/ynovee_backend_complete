<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use App\Traits\UploadsFiles;

class PlaceController extends Controller
{
    use UploadsFiles;

    /**
     * @OA\Get(path="/api/places", tags={"Places"}, summary="List all places",
     *     @OA\Response(response=200, description="List of places", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Place")))
     * )
     */
    /**
     * @OA\Get(path="/api/places", tags={"Places"}, summary="List all places",
     *     @OA\Response(response=200, description="List of places", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Place")))
     * )
     */
    public function index()
    {
        return response()->json(Place::all(), 200, [], JSON_UNESCAPED_SLASHES);
    }

    
    /**
     * @OA\Post(path="/api/places", tags={"Places"}, summary="Create a place (Admin)", security={{"sanctum":{}}},
     *     @OA\RequestBody(required=true, @OA\MediaType(mediaType="multipart/form-data",
     *         @OA\Schema(required={"title","location","description","image"},
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="location", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="content", type="string"),
     *             @OA\Property(property="rating", type="number"),
     *             @OA\Property(property="image", type="string", format="binary")
     *         )
     *     )),
     *     @OA\Response(response=201, description="Place created", @OA\JsonContent(ref="#/components/schemas/Place"))
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'rating' => 'nullable|numeric',
            'size' => 'nullable|string',
            'image' => 'required', // File or String
        ]);

        $validated['image_url'] = $this->uploadFile($request, 'image', 'places');
        unset($validated['image']);

        $place = Place::create($validated);
        return response()->json($place, 201, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Put(path="/api/places/{id}", tags={"Places"}, summary="Update a place (Admin)", security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(required={"title","location","description"},
     *         @OA\Property(property="title", type="string"),
     *         @OA\Property(property="location", type="string"),
     *         @OA\Property(property="description", type="string"),
     *         @OA\Property(property="content", type="string"),
     *         @OA\Property(property="rating", type="number"),
     *         @OA\Property(property="image", type="string")
     *     )),
     *     @OA\Response(response=200, description="Place updated", @OA\JsonContent(ref="#/components/schemas/Place"))
     * )
     */
    public function update(Request $request, $id)
    {
        $place = Place::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'rating' => 'nullable|numeric',
            'size' => 'nullable|string',
            'image' => 'nullable',
        ]);

        if ($request->has('image') || $request->hasFile('image')) {
            $validated['image_url'] = $this->uploadFile($request, 'image', 'places');
        }
        unset($validated['image']);

        $place->update($validated);
        return response()->json($place, 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Delete(path="/api/places/{id}", tags={"Places"}, summary="Delete a place (Admin)", security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted")
     * )
     */
    public function destroy($id)
    {
        Place::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
