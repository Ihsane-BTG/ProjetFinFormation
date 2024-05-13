<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::with('category')->get();

        $groupedMenuItems = $menuItems->groupBy('category_id');

        $formattedMenuItems = $groupedMenuItems->map(function ($items, $categoryId) {

            $categoryName = Category::find($categoryId)->name;

            $formattedItems = $items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'description' => $item->description,
                    'price' => $item->price,
                    'image' => $item->image,
                ];
            });

            return [
                'category' => $categoryName,
                'items' => $formattedItems,
            ];
        });

        return response()->json($formattedMenuItems);
    }

    public function show($id)
    {
        $menuItem = MenuItem::with('category')->find($id);

        if (!$menuItem) {
            return response()->json(['error' => 'Menu item not found'], 404);
        }

        // Retrieve category name
        $categoryName = $menuItem->category->name;

        // Add category name to the menu item data
        $menuItemData = [
            'id' => $menuItem->id,
            'category' => $categoryName,
            'name' => $menuItem->name,
            'description' => $menuItem->description,
            'price' => 'DHs' . $menuItem->price,
            'image' => $menuItem->image,
        ];

        return response()->json($menuItemData);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id', 
            'name' => 'required|string',
            'description' => 'string',
            'price' => 'required|numeric',
            'image' => 'nullable|file',
        ]);

        $categoryName = Category::find($validatedData['category_id'])->name;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $validatedData['image'] = url(Storage::url($imagePath));
        }

        $menuItem = MenuItem::create($validatedData);

        $menuItemData = [
            'category' => $categoryName,
            'menuItem' => $menuItem,
        ];

        return response()->json($menuItemData, 201);
    }

    public function update(Request $request, $id)
    {
        $menuItem = MenuItem::find($id);

        if (!$menuItem) {
            return response()->json(['error' => 'Menu item not found'], 404);
        }

        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id', 
            'description' => 'string',
            'price' => 'required|numeric',
            'image' => 'nullable|file',
        ]);

        $categoryName = Category::find($validatedData['category_id'])->name;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $validatedData['image'] = url(Storage::url($imagePath));
        }

        $menuItem->update($validatedData);

        $menuItemData = [
            'category' => $categoryName,
            'menuItem' => $menuItem,
        ];

        return response()->json($menuItemData);
    }

    public function destroy($id)
    {
        $menuItem = MenuItem::find($id);

        if (!$menuItem) {
            return response()->json(['error' => 'Menu item not found'], 404);
        }

        $categoryName = $menuItem->category->name;

        $menuItem->delete();

        return response()->json(['category' => $categoryName, 'message' => 'Menu item deleted']);
    }
}
