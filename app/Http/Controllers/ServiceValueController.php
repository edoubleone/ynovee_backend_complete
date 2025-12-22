<?php

namespace App\Http\Controllers;

use App\Models\ServiceValue;
use Illuminate\Http\Request;
use App\Traits\UploadsFiles;

class ServiceValueController extends Controller
{
    use UploadsFiles;

    public function index()
    {
        return response()->json(ServiceValue::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'icon' => 'required', // File or String
        ]);

        $validated['icon_url'] = $this->uploadFile($request, 'icon', 'service-values');
        unset($validated['icon']);

        $serviceValue = ServiceValue::create($validated);
        return response()->json($serviceValue, 201);
    }

    public function update(Request $request, $id)
    {
        $serviceValue = ServiceValue::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'icon' => 'nullable',
        ]);

        if ($request->has('icon') || $request->hasFile('icon')) {
            $validated['icon_url'] = $this->uploadFile($request, 'icon', 'service-values');
        }
        unset($validated['icon']);

        $serviceValue->update($validated);
        return response()->json($serviceValue);
    }

    public function destroy($id)
    {
        ServiceValue::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
