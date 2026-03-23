<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use App\Traits\UploadsFiles;

class SlideController extends Controller
{
    use UploadsFiles;

    public function index()
    {
        return response()->json(Slide::orderBy('order')->get(), 200, [], JSON_UNESCAPED_SLASHES);
    }

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

    public function destroy($id)
    {
        Slide::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
