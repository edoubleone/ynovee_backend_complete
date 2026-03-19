<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use Illuminate\Http\Request;
use App\Traits\UploadsFiles;

class AmenityController extends Controller
{
    use UploadsFiles;

    /**
     * @OA\Get(path="/api/amenities", tags={"Amenities"}, summary="List all amenities",
     *     @OA\Response(response=200, description="List of amenities", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Amenity")))
     * )
     */
    public function index()
    {
        return response()->json(Amenity::all(), 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Post(path="/api/amenities", tags={"Amenities"}, summary="Create an amenity (Admin)", security={{"sanctum":{}}},
     *     @OA\RequestBody(required=true, @OA\MediaType(mediaType="multipart/form-data",
     *         @OA\Schema(required={"title","icon"},
     *             @OA\Property(property="title", type="string", example="Free WiFi"),
     *             @OA\Property(property="icon", type="string", format="binary")
     *         )
     *     )),
     *     @OA\Response(response=201, description="Amenity created", @OA\JsonContent(ref="#/components/schemas/Amenity"))
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'icon' => 'required', // File or String
        ]);

        $validated['icon_url'] = $this->uploadFile($request, 'icon', 'amenities');
        unset($validated['icon']);

        $amenity = Amenity::create($validated);
        return response()->json($amenity, 201, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Put(path="/api/amenities/{id}", tags={"Amenities"}, summary="Update an amenity (Admin)", security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(required={"title"},
     *         @OA\Property(property="title", type="string"),
     *         @OA\Property(property="icon", type="string", description="Icon URL or upload via multipart")
     *     )),
     *     @OA\Response(response=200, description="Amenity updated", @OA\JsonContent(ref="#/components/schemas/Amenity"))
     * )
     */
    public function update(Request $request, $id)
    {
        $amenity = Amenity::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'icon' => 'nullable',
        ]);

        if ($request->has('icon') || $request->hasFile('icon')) {
            $validated['icon_url'] = $this->uploadFile($request, 'icon', 'amenities');
        }
        unset($validated['icon']);

        $amenity->update($validated);
        return response()->json($amenity, 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Delete(path="/api/amenities/{id}", tags={"Amenities"}, summary="Delete an amenity (Admin)", security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted")
     * )
     */
    public function destroy($id)
    {
        Amenity::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
