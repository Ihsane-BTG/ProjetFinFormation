<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::all();

        $groupedMenuItems = $menuItems->groupBy('category');

        $formattedMenuItems = $groupedMenuItems->map(function ($items, $category) {
            return [
                'category' => $category,
                'items' => $items->map(function ($item) {
                    return [
                        'name' => $item->name,
                        'description' => $item->description,
                        'price' => '$' . $item->price,
                        'image' => $item->image, 
                    ];
                }),
            ];
        });

        return response()->json($formattedMenuItems);
    }

    public function show($id)
    {
        $menuItem = MenuItem::find($id);

        if (!$menuItem) {
            return response()->json(['error' => 'Menu item not found'], 404);
        }

        return response()->json($menuItem);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required|string',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
        ]);

        $menuItem = MenuItem::create($validatedData);

        return response()->json($menuItem, 201);
    }

    public function update(Request $request, $id)
    {
        $menuItem = MenuItem::find($id);

        if (!$menuItem) {
            return response()->json(['error' => 'Menu item not found'], 404);
        }

        $validatedData = $request->validate([
            'category' => 'required|string',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
        ]);

        $menuItem->update($validatedData);

        return response()->json($menuItem);
    }

    public function destroy($id)
    {
        $menuItem = MenuItem::find($id);

        if (!$menuItem) {
            return response()->json(['error' => 'Menu item not found'], 404);
        }

        $menuItem->delete();

        return response()->json(['message' => 'Menu item deleted']);
    }
}
