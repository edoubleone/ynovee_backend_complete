<?php

namespace App\Http\Controllers;

use App\Models\ServiceValue;
use Illuminate\Http\Request;
use App\Traits\UploadsFiles;

class ServiceValueController extends Controller
{
    use UploadsFiles;

    /**
     * @OA\Get(path="/api/service-values", tags={"Service Values"}, summary="List all service values",
     *     @OA\Response(response=200, description="List of service values", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/ServiceValue")))
     * )
     */
    public function index()
    {
        return response()->json(ServiceValue::all());
    }

    /**
     * @OA\Post(path="/api/service-values", tags={"Service Values"}, summary="Create a service value (Admin)", security={{"sanctum":{}}},
     *     @OA\RequestBody(required=true, @OA\MediaType(mediaType="multipart/form-data",
     *         @OA\Schema(required={"title","description","icon"},
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="icon", type="string", format="binary")
     *         )
     *     )),
     *     @OA\Response(response=201, description="Service value created", @OA\JsonContent(ref="#/components/schemas/ServiceValue"))
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'icon' => 'required', // File or String
        ]);

        $validated['icon_url'] = $this->uploadFile($request, 'icon', 'service-values');
        unset($validated['icon']);

        $serviceValue = ServiceValue::create($validated);
        return response()->json($serviceValue, 201);
    }

    /**
     * @OA\Put(path="/api/service-values/{id}", tags={"Service Values"}, summary="Update a service value (Admin)", security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(required={"title","description"},
     *         @OA\Property(property="title", type="string"),
     *         @OA\Property(property="description", type="string"),
     *         @OA\Property(property="icon", type="string")
     *     )),
     *     @OA\Response(response=200, description="Service value updated", @OA\JsonContent(ref="#/components/schemas/ServiceValue"))
     * )
     */
    public function update(Request $request, $id)
    {
        $serviceValue = ServiceValue::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'icon' => 'nullable',
        ]);

        if ($request->has('icon') || $request->hasFile('icon')) {
            $validated['icon_url'] = $this->uploadFile($request, 'icon', 'service-values');
        }
        unset($validated['icon']);

        $serviceValue->update($validated);
        return response()->json($serviceValue);
    }

    /**
     * @OA\Delete(path="/api/service-values/{id}", tags={"Service Values"}, summary="Delete a service value (Admin)", security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted")
     * )
     */
    public function destroy($id)
    {
        ServiceValue::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
