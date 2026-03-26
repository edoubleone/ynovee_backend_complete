<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Traits\UploadsFiles;

class ActivityController extends Controller
{
    use UploadsFiles;

    /**
     * @OA\Get(path="/api/activities", tags={"Activities"}, summary="List all activities",
     *     @OA\Response(response=200, description="List of activities", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Activity")))
     * )
     */
    public function index()
    {
        return response()->json(Activity::all(), 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Post(path="/api/activities", tags={"Activities"}, summary="Create an activity (Admin)", security={{"sanctum":{}}},
     *     @OA\RequestBody(required=true, @OA\MediaType(mediaType="multipart/form-data",
     *         @OA\Schema(required={"title","description","image"},
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="image", type="string", format="binary")
     *         )
     *     )),
     *     @OA\Response(response=201, description="Activity created", @OA\JsonContent(ref="#/components/schemas/Activity"))
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required', // File or String
            'width' => 'nullable|integer',
            'height' => 'nullable|integer',
        ]);

        $validated['image_url'] = $this->uploadFile($request, 'image', 'activities');
        unset($validated['image']);

        $activity = Activity::create($validated);
        return response()->json($activity, 201, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Put(path="/api/activities/{id}", tags={"Activities"}, summary="Update an activity (Admin)", security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(required={"title","description"},
     *         @OA\Property(property="title", type="string"),
     *         @OA\Property(property="description", type="string"),
     *         @OA\Property(property="image", type="string")
     *     )),
     *     @OA\Response(response=200, description="Activity updated", @OA\JsonContent(ref="#/components/schemas/Activity"))
     * )
     */
    public function update(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'image' => 'nullable',
            'width' => 'nullable|integer',
            'height' => 'nullable|integer',
        ]);

        if ($request->has('image') || $request->hasFile('image')) {
            $validated['image_url'] = $this->uploadFile($request, 'image', 'activities');
        }
        unset($validated['image']);

        $activity->update($validated);
        return response()->json($activity, 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Delete(path="/api/activities/{id}", tags={"Activities"}, summary="Delete an activity (Admin)", security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted")
     * )
     */
    public function destroy($id)
    {
        Activity::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
