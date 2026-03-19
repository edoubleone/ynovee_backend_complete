<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * @OA\Get(path="/api/settings", tags={"Settings"}, summary="Get all settings",
     *     description="Returns all settings as a flat key-value object.",
     *     @OA\Response(response=200, description="Settings object", @OA\JsonContent(type="object", example={"site_name":"Ynovee","contact_email":"info@ynovee.com"}))
     * )
     */
    // Returns { "key": "value", "key2": "value2" }
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return response()->json($settings);
    }

    /**
     * @OA\Post(path="/api/settings", tags={"Settings"}, summary="Update settings (Admin)", security={{"sanctum":{}}},
     *     description="Pass a flat key-value JSON object. Each key is upserted.",
     *     @OA\RequestBody(required=true, @OA\JsonContent(type="object", example={"site_name":"Ynovee","contact_email":"info@ynovee.com"})),
     *     @OA\Response(response=200, description="Settings updated", @OA\JsonContent(@OA\Property(property="message", type="string")))
     * )
     */
    // Expects { "key": "value", "key2": "value2" }
    public function update(Request $request)
    {
        $data = $request->all();
        
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return response()->json(['message' => 'Settings updated successfully']);
    }
}
