<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Traits\UploadsFiles;

class ReviewController extends Controller
{
    use UploadsFiles;

    public function index()
    {
        return response()->json(Review::all(), 200, [], JSON_UNESCAPED_SLASHES);
    }

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

    public function destroy($id)
    {
        Review::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
