<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use App\Traits\UploadsFiles;

class PlaceController extends Controller
{
    use UploadsFiles;

    public function index()
    {
        return response()->json(Place::all(), 200, [], JSON_UNESCAPED_SLASHES);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'rating' => 'nullable|numeric',
            'image' => 'required', // File or String
        ]);

        $validated['image_url'] = $this->uploadFile($request, 'image', 'places');
        unset($validated['image']);

        $place = Place::create($validated);
        return response()->json($place, 201, [], JSON_UNESCAPED_SLASHES);
    }

    public function update(Request $request, $id)
    {
        $place = Place::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'rating' => 'nullable|numeric',
            'image' => 'nullable',
        ]);

        if ($request->has('image') || $request->hasFile('image')) {
            $validated['image_url'] = $this->uploadFile($request, 'image', 'places');
        }
        unset($validated['image']);

        $place->update($validated);
        return response()->json($place, 200, [], JSON_UNESCAPED_SLASHES);
    }

    public function destroy($id)
    {
        Place::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
