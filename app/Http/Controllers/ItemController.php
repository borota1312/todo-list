<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index($checklistId)
    {
        $checklist = auth()->user()->checklists()->findOrFail($checklistId);
        return response()->json($checklist->items);
    }

    public function store(Request $request, $checklistId)
    {
        $checklist = auth()->user()->checklists()->findOrFail($checklistId);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $item = $checklist->items()->create([
            'name' => $request->name,
            'is_completed' => false
        ]);

        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Item::whereHas('checklist', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($id);

        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Item::whereHas('checklist', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $item->update($request->all());
        return response()->json($item);
    }

    public function updateStatus(Request $request, $id)
    {
        $item = Item::whereHas('checklist', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($id);

        $request->validate([
            'is_completed' => 'required|boolean',
        ]);

        $item->update([
            'is_completed' => $request->is_completed
        ]);

        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = Item::whereHas('checklist', function ($query) {
            $query->where('user_id', auth()->id());
        })->findOrFail($id);

        $item->delete();
        return response()->json(null, 204);
    }
}
