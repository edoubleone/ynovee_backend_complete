<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Traits\UploadsFiles;

class ArticleController extends Controller
{
    use UploadsFiles;

    public function index()
    {
        return response()->json(Article::all(), 200, [], JSON_UNESCAPED_SLASHES);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'excerpt' => 'nullable|string',
            'author' => 'required|string',
            'category' => 'required|string',
            'content' => 'required|string',
            'image' => 'required', // File or String
            'published_at' => 'required|date',
        ]);

        $validated['image_url'] = $this->uploadFile($request, 'image', 'articles');
        unset($validated['image']);

        $article = Article::create($validated);
        return response()->json($article, 201, [], JSON_UNESCAPED_SLASHES);
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'excerpt' => 'nullable|string',
            'author' => 'required|string',
            'category' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable',
            'published_at' => 'required|date',
        ]);

        if ($request->has('image') || $request->hasFile('image')) {
            $validated['image_url'] = $this->uploadFile($request, 'image', 'articles');
        }
        unset($validated['image']);

        $article->update($validated);
        return response()->json($article, 200, [], JSON_UNESCAPED_SLASHES);
    }

    public function destroy($id)
    {
        Article::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
