<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use App\Traits\UploadsFiles;

class SlideController extends Controller
{
    use UploadsFiles;

    /**
     * @OA\Get(path="/api/slides", tags={"Slides"}, summary="List all slides",
     *     @OA\Response(response=200, description="List of slides", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Slide")))
     * )
     */
    public function index()
    {
        return response()->json(Slide::orderBy('order')->get(), 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Post(path="/api/slides", tags={"Slides"}, summary="Create a slide (Admin)", security={{"sanctum":{}}},
     *     @OA\RequestBody(required=true, @OA\MediaType(mediaType="multipart/form-data",
     *         @OA\Schema(required={"image","title"},
     *             @OA\Property(property="image", type="string", format="binary"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="subtitle", type="string"),
     *             @OA\Property(property="cta_link", type="string")
     *         )
     *     )),
     *     @OA\Response(response=201, description="Slide created", @OA\JsonContent(ref="#/components/schemas/Slide"))
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required', // File or String
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'cta_link' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $validated['image_url'] = $this->uploadFile($request, 'image', 'slides');
        unset($validated['image']);

        $slide = Slide::create($validated);
        return response()->json($slide, 201, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Put(path="/api/slides/{id}", tags={"Slides"}, summary="Update a slide (Admin)", security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(required={"title"},
     *         @OA\Property(property="title", type="string"),
     *         @OA\Property(property="subtitle", type="string"),
     *         @OA\Property(property="cta_link", type="string"),
     *         @OA\Property(property="image", type="string", description="Image URL or upload via multipart")
     *     )),
     *     @OA\Response(response=200, description="Slide updated", @OA\JsonContent(ref="#/components/schemas/Slide"))
     * )
     */
    public function update(Request $request, $id)
    {
        $slide = Slide::findOrFail($id);
        
        $validated = $request->validate([
            'image' => 'nullable', // Can be string or file
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'cta_link' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        if ($request->has('image') || $request->hasFile('image')) {
             $validated['image_url'] = $this->uploadFile($request, 'image', 'slides');
        }
        unset($validated['image']);

        $slide->update($validated);
        return response()->json($slide, 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Delete(path="/api/slides/{id}", tags={"Slides"}, summary="Delete a slide (Admin)", security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted")
     * )
     */
    public function destroy($id)
    {
        Slide::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
