<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // Returns { "key": "value", "key2": "value2" }
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return response()->json($settings);
    }

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
