<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelCategory;
use Illuminate\Http\Request;

class TravelCategoryController extends Controller
{
    public function index()
    {
        $categories = TravelCategory::with('photos')->get();
        return view('admin.travel-categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        TravelCategory::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', 'Travel place created successfully!');
    }

    public function update(Request $request, TravelCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', 'Travel place updated successfully!');
    }

    public function destroy(TravelCategory $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Travel place deleted successfully!');
    }
}
