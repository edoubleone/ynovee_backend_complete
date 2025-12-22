<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use Illuminate\Http\Request;
use App\Traits\UploadsFiles;

class AmenityController extends Controller
{
    use UploadsFiles;

    public function index()
    {
        return response()->json(Amenity::all(), 200, [], JSON_UNESCAPED_SLASHES);
    }

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

    public function destroy($id)
    {
        Amenity::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
