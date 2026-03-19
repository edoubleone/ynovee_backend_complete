<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Traits\UploadsFiles;

class ArticleController extends Controller
{
    use UploadsFiles;

    /**
     * @OA\Get(path="/api/articles", tags={"Articles"}, summary="List all articles",
     *     @OA\Response(response=200, description="List of articles", @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Article")))
     * )
     */
    public function index()
    {
        return response()->json(Article::all(), 200, [], JSON_UNESCAPED_SLASHES);
    }

    /**
     * @OA\Post(path="/api/articles", tags={"Articles"}, summary="Create an article (Admin)", security={{"sanctum":{}}},
     *     @OA\RequestBody(required=true, @OA\MediaType(mediaType="multipart/form-data",
     *         @OA\Schema(required={"title","author","category","content","image","published_at"},
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="author", type="string"),
     *             @OA\Property(property="category", type="string"),
     *             @OA\Property(property="content", type="string"),
     *             @OA\Property(property="image", type="string", format="binary"),
     *             @OA\Property(property="published_at", type="string", format="date-time")
     *         )
     *     )),
     *     @OA\Response(response=201, description="Article created", @OA\JsonContent(ref="#/components/schemas/Article"))
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
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

    /**
     * @OA\Put(path="/api/articles/{id}", tags={"Articles"}, summary="Update an article (Admin)", security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true, @OA\JsonContent(required={"title","author","category","content","published_at"},
     *         @OA\Property(property="title", type="string"),
     *         @OA\Property(property="author", type="string"),
     *         @OA\Property(property="category", type="string"),
     *         @OA\Property(property="content", type="string"),
     *         @OA\Property(property="image", type="string"),
     *         @OA\Property(property="published_at", type="string", format="date-time")
     *     )),
     *     @OA\Response(response=200, description="Article updated", @OA\JsonContent(ref="#/components/schemas/Article"))
     * )
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
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

    /**
     * @OA\Delete(path="/api/articles/{id}", tags={"Articles"}, summary="Delete an article (Admin)", security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted")
     * )
     */
    public function destroy($id)
    {
        Article::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
