<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\UploadsFiles;

class ProfileController extends Controller
{
    use UploadsFiles;

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
