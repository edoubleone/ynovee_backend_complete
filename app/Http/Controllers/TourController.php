<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TourController extends Controller
{
    public function index()
    {
        return response()->json(Tour::all(), 200, [], JSON_UNESCAPED_SLASHES);
    }

    public function show($id)
    {
        $tour = Tour::with('bookings')->findOrFail($id);
        return response()->json($tour, 200, [], JSON_UNESCAPED_SLASHES);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'duration' => 'nullable|string',
            'price_usd' => 'nullable|numeric',
            'price_eur' => 'nullable|numeric',
            'price_ghs' => 'nullable|numeric',
            'max_guests' => 'required|integer',
            'category' => 'nullable|string',
            'inclusions' => 'nullable|array',
            'exclusions' => 'nullable|array',
            'images' => 'nullable',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|string',
        ]);

        $validated['images'] = $this->handleImages($request);

        $tour = Tour::create($validated);
        return response()->json($tour, 201, [], JSON_UNESCAPED_SLASHES);
    }

    public function update(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'duration' => 'nullable|string',
            'price_usd' => 'nullable|numeric',
            'price_eur' => 'nullable|numeric',
            'price_ghs' => 'nullable|numeric',
            'max_guests' => 'sometimes|required|integer',
            'category' => 'nullable|string',
            'inclusions' => 'nullable|array',
            'exclusions' => 'nullable|array',
            'images' => 'nullable',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'nullable|boolean',
            'status' => 'nullable|string',
        ]);

        if ($request->hasFile('images')) {
            $validated['images'] = $this->handleImages($request);
        }

        $tour->update($validated);
        return response()->json($tour, 200, [], JSON_UNESCAPED_SLASHES);
    }

    public function destroy($id)
    {
        Tour::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    private function handleImages(Request $request): array
    {
        $imageLinks = [];
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            if (!is_array($files)) {
                $files = [$files];
            }
            foreach ($files as $file) {
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('tours', $filename, 'public');
                $imageLinks[] = Storage::disk('public')->url($path);
            }
        }
        return $imageLinks;
    }
}
