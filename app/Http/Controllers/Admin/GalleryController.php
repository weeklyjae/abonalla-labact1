<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelCategory;
use App\Models\TravelPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $folders = ['coding', 'editing', 'travel'];
        $galleryData = [];
        
        foreach ($folders as $folder) {
            $galleryData[$folder] = $this->getFolderImages($folder);
        }

        // Get travel categories for the travel section
        $travelCategories = TravelCategory::with('photos')->get();
        
        return view('admin.gallery', compact('galleryData', 'folders', 'travelCategories'));
    }

    public function coding()
    {
        $images = $this->getFolderImages('coding');
        return view('admin.coding', compact('images'));
    }

    public function codingStore(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $uploadedImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs("gallery/coding", $filename, 'public');
                $uploadedImages[] = $path;
            }
        }

        $successMessage = count($uploadedImages) . ' project images uploaded successfully!';
        return redirect()->back()->with('success', $successMessage);
    }

    public function codingDestroy($filename)
    {
        $path = "gallery/coding/{$filename}";
        
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return redirect()->back()->with('success', 'Project image deleted successfully!');
        }

        return redirect()->back()->with('error', 'Image not found!');
    }

    public function media()
    {
        // Load media settings from storage
        $settings = [
            'youtube_channel' => '',
            'youtube_videos' => '',
            'instagram_username' => '',
            'instagram_embed' => ''
        ];
        
        // Load YouTube settings
        if (Storage::disk('public')->exists('media_settings.json')) {
            $youtubeSettings = json_decode(Storage::disk('public')->get('media_settings.json'), true);
            if ($youtubeSettings) {
                $settings['youtube_channel'] = $youtubeSettings['youtube_channel'] ?? '';
                $settings['youtube_videos'] = $youtubeSettings['youtube_videos'] ?? '';
            }
        }
        
        // Load Instagram settings
        if (Storage::disk('public')->exists('instagram_settings.json')) {
            $instagramSettings = json_decode(Storage::disk('public')->get('instagram_settings.json'), true);
            if ($instagramSettings) {
                $settings['instagram_username'] = $instagramSettings['instagram_username'] ?? '';
                $settings['instagram_embed'] = $instagramSettings['instagram_embed'] ?? '';
            }
        }
        
        return view('admin.media', compact('settings'));
    }

    public function youtubeStore(Request $request)
    {
        $request->validate([
            'youtube_channel' => 'nullable|url',
            'youtube_videos' => 'nullable|string'
        ]);

        // Save YouTube settings to storage
        $settings = [
            'youtube_channel' => $request->youtube_channel,
            'youtube_videos' => $request->youtube_videos
        ];
        
        Storage::disk('public')->put('media_settings.json', json_encode($settings));
        
        return response()->json(['success' => true]);
    }

    public function instagramStore(Request $request)
    {
        $request->validate([
            'instagram_username' => 'nullable|string',
            'instagram_embed' => 'nullable|string'
        ]);

        // Save Instagram settings to storage
        $settings = [
            'instagram_username' => $request->instagram_username,
            'instagram_embed' => $request->instagram_embed
        ];
        
        Storage::disk('public')->put('instagram_settings.json', json_encode($settings));
        
        return response()->json(['success' => true]);
    }

    public function travel()
    {
        $travelCategories = TravelCategory::with('photos')->get();
        return view('admin.travel', compact('travelCategories'));
    }

    public function travelStore(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'travel_category_id' => 'nullable|exists:travel_categories,id',
            'new_place_name' => 'nullable|string|max:255',
            'new_place_description' => 'nullable|string'
        ]);

        $uploadedImages = [];
        $travelCategoryId = null;

        // Handle travel place creation if needed
        if ($request->travel_category_id) {
            $travelCategoryId = $request->travel_category_id;
        } elseif ($request->new_place_name && $request->new_place_description) {
            $newCategory = TravelCategory::create([
                'name' => $request->new_place_name,
                'description' => $request->new_place_description
            ]);
            $travelCategoryId = $newCategory->id;
        } else {
            return redirect()->back()->with('error', 'Please either select an existing travel place or create a new one.');
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs("gallery/travel", $filename, 'public');
                $uploadedImages[] = $path;

                // Save to database with category
                TravelPhoto::create([
                    'travel_category_id' => $travelCategoryId,
                    'filename' => $filename,
                    'original_name' => $image->getClientOriginalName(),
                    'file_path' => $path,
                    'title' => pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
                ]);
            }
        }

        $successMessage = count($uploadedImages) . ' travel photos uploaded successfully!';
        if ($request->new_place_name) {
            $successMessage .= ' New travel place "' . $request->new_place_name . '" created!';
        }

        return redirect()->back()->with('success', $successMessage);
    }

    public function travelDestroy($category)
    {
        $category = TravelCategory::findOrFail($category);
        
        // Delete all photos in this category
        foreach ($category->photos as $photo) {
            if (Storage::disk('public')->exists($photo->file_path)) {
                Storage::disk('public')->delete($photo->file_path);
            }
        }
        
        // Delete photos from database
        $category->photos()->delete();
        
        // Delete category
        $category->delete();
        
        return redirect()->back()->with('success', 'Travel place and all photos deleted successfully!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'folder' => 'required|in:coding,editing,travel',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'travel_category_id' => 'nullable|exists:travel_categories,id',
            'new_place_name' => 'nullable|string|max:255',
            'new_place_description' => 'nullable|string'
        ]);

        $folder = $request->folder;
        $uploadedImages = [];
        $travelCategoryId = null;

        // Handle travel place creation if needed
        if ($folder === 'travel') {
            if ($request->travel_category_id) {
                // Use existing travel place
                $travelCategoryId = $request->travel_category_id;
            } elseif ($request->new_place_name && $request->new_place_description) {
                // Create new travel place
                $newCategory = TravelCategory::create([
                    'name' => $request->new_place_name,
                    'description' => $request->new_place_description
                ]);
                $travelCategoryId = $newCategory->id;
            } else {
                return redirect()->back()->with('error', 'Please either select an existing travel place or create a new one.');
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs("gallery/{$folder}", $filename, 'public');
                $uploadedImages[] = $path;

                // If it's a travel photo, save to database with category
                if ($folder === 'travel' && $travelCategoryId) {
                    TravelPhoto::create([
                        'travel_category_id' => $travelCategoryId,
                        'filename' => $filename,
                        'original_name' => $image->getClientOriginalName(),
                        'file_path' => $path,
                        'title' => pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
                    ]);
                }
            }
        }

        $successMessage = count($uploadedImages) . ' images uploaded successfully!';
        if ($folder === 'travel' && $request->new_place_name) {
            $successMessage .= ' New travel place "' . $request->new_place_name . '" created!';
        }

        return redirect()->back()->with('success', $successMessage);
    }





    public function destroy(Request $request, $folder, $filename)
    {
        $path = "gallery/{$folder}/{$filename}";
        
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            
            // If it's a travel photo, also delete from database
            if ($folder === 'travel') {
                TravelPhoto::where('filename', $filename)->delete();
            }
            
            return redirect()->back()->with('success', 'Image deleted successfully!');
        }

        return redirect()->back()->with('error', 'Image not found!');
    }

    private function getFolderImages($folder)
    {
        $path = "gallery/{$folder}";
        
        if (!Storage::disk('public')->exists($path)) {
            return [];
        }

        $files = Storage::disk('public')->files($path);
        $images = [];

        foreach ($files as $file) {
            if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
                $images[] = [
                    'path' => $file,
                    'name' => pathinfo($file, PATHINFO_FILENAME),
                    'filename' => pathinfo($file, PATHINFO_BASENAME),
                    'url' => Storage::disk('public')->url($file)
                ];
            }
        }

        return $images;
    }
}
