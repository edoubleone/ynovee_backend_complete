<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        return response()->json(Inquiry::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'message' => 'required|string',
        ]);

        $inquiry = Inquiry::create($validated);
        return response()->json($inquiry, 201);
    }

    public function update(Request $request, $id)
    {
        $inquiry = Inquiry::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email',
            'phone' => 'nullable|string',
            'message' => 'sometimes|required|string',
        ]);

        $inquiry->update($validated);
        return response()->json($inquiry);
    }

    public function destroy($id)
    {
        Inquiry::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
