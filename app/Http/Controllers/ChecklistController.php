<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function index()
    {
        $checklists = auth()->user()->checklists()->with('items')->get();
        return response()->json($checklists);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $checklist = auth()->user()->checklists()->create($request->all());
        return response()->json($checklist, 201);
    }

    public function show($id)
    {
        $checklist = auth()->user()->checklists()->with('items')->findOrFail($id);
        return response()->json($checklist);
    }

    public function destroy($id)
    {
        $checklist = auth()->user()->checklists()->findOrFail($id);
        $checklist->delete();
        return response()->json(null, 204);
    }
}
