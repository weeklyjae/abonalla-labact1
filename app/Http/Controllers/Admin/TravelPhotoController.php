<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelCategory;
use App\Models\TravelPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TravelPhotoController extends Controller
{
    public function index()
    {
        $categories = TravelCategory::with('photos')->get();
        $photos = TravelPhoto::with('category')->get();
        
        return view('admin.travel-photos.index', compact('categories', 'photos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'travel_category_id' => 'required|exists:travel_categories,id',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $file = $request->file('photo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $filePath = 'travel-photos/' . $filename;
        
        // Store the file
        Storage::disk('public')->put($filePath, file_get_contents($file));

        TravelPhoto::create([
            'travel_category_id' => $request->travel_category_id,
            'filename' => $filename,
            'original_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', 'Photo uploaded successfully!');
    }

    public function update(Request $request, TravelPhoto $photo)
    {
        $request->validate([
            'travel_category_id' => 'required|exists:travel_categories,id',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ]);

        $photo->update([
            'travel_category_id' => $request->travel_category_id,
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->back()->with('success', 'Photo updated successfully!');
    }

    public function destroy(TravelPhoto $photo)
    {
        // Delete the file from storage
        if (Storage::disk('public')->exists($photo->file_path)) {
            Storage::disk('public')->delete($photo->file_path);
        }
        
        $photo->delete();
        return redirect()->back()->with('success', 'Photo deleted successfully!');
    }

    public function edit(TravelPhoto $photo)
    {
        return response()->json($photo);
    }
}
