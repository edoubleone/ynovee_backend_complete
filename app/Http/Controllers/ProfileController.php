<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\UploadsFiles;

class ProfileController extends Controller
{
    use UploadsFiles;

    /**
     * @OA\Post(path="/api/auth/profile", tags={"Authentication"}, summary="Update own profile (Admin)", security={{"sanctum":{}}},
     *     @OA\RequestBody(required=true, @OA\MediaType(mediaType="multipart/form-data",
     *         @OA\Schema(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="avatar", type="string", format="binary", description="Avatar image file or URL")
     *         )
     *     )),
     *     @OA\Response(response=200, description="Profile updated", @OA\JsonContent(ref="#/components/schemas/User"))
     * )
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'avatar' => 'nullable', // File or String URL
            // Add other fields as necessary, e.g., phone, address
        ]);

        if ($request->hasAny(['name'])) {
             $user->fill($request->only(['name']));
        }

        if ($request->hasFile('avatar')) {
             $user->avatar = $this->uploadFile($request, 'avatar', 'avatars');
        } elseif ($request->has('avatar')) {
             // Handle case where avatar is a string URL or null (removing avatar)
             // If input is null, we might want to keep existing or delete. 
             // Logic: If 'avatar' is present in request and not a file, use the value.
             $user->avatar = $request->input('avatar');
        }

        $user->save();

        return response()->json($user);
    }
}
