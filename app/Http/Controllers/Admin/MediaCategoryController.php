<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MediaCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = MediaCategory::ordered()->get();
        return view('admin.media-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.media-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        $category = MediaCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'icon' => $request->icon,
            'color' => $request->color,
            'sort_order' => $request->sort_order ?? 0
        ]);

        return redirect()->route('admin.media-categories.index')
            ->with('success', 'Media category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = MediaCategory::findOrFail($id);
        return view('admin.media-categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        $category = MediaCategory::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'icon' => $request->icon,
            'color' => $request->color,
            'sort_order' => $request->sort_order ?? 0
        ]);

        return redirect()->route('admin.media-categories.index')
            ->with('success', 'Media category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = MediaCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.media-categories.index')
            ->with('success', 'Media category deleted successfully!');
    }
}
