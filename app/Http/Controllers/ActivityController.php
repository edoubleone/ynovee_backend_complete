<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Traits\UploadsFiles;

class ActivityController extends Controller
{
    use UploadsFiles;

    public function index()
    {
        return response()->json(Activity::all(), 200, [], JSON_UNESCAPED_SLASHES);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required', // File or String
        ]);

        $validated['image_url'] = $this->uploadFile($request, 'image', 'activities');
        unset($validated['image']);

        $activity = Activity::create($validated);
        return response()->json($activity, 201, [], JSON_UNESCAPED_SLASHES);
    }

    public function update(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable',
        ]);

        if ($request->has('image') || $request->hasFile('image')) {
            $validated['image_url'] = $this->uploadFile($request, 'image', 'activities');
        }
        unset($validated['image']);

        $activity->update($validated);
        return response()->json($activity, 200, [], JSON_UNESCAPED_SLASHES);
    }

    public function destroy($id)
    {
        Activity::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
