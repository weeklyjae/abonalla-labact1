<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaItem;
use App\Models\MediaCategory;
use Illuminate\Http\Request;

class MediaItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mediaItems = MediaItem::with('category')->ordered()->get();
        $categories = MediaCategory::ordered()->get();
        return view('admin.media-items.index', compact('mediaItems', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = MediaCategory::ordered()->get();
        return view('admin.media-items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'media_category_id' => 'required|exists:media_categories,id',
            'content' => 'required|url',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        // Auto-detect content type from URL
        $type = $this->detectContentTypeFromUrl($request->content);
        
        // Auto-generate title and thumbnail from URL
        $title = $this->generateTitleFromUrl($request->content, $type);
        $thumbnail = $this->generateThumbnailFromUrl($request->content, $type);

        MediaItem::create([
            'media_category_id' => $request->media_category_id,
            'type' => $type,
            'title' => $title,
            'content' => $request->content,
            'description' => null,
            'thumbnail' => $thumbnail,
            'sort_order' => $request->sort_order ?? 0
        ]);

        return redirect()->route('admin.media-items.index')
            ->with('success', 'Media item created successfully!');
    }

    /**
     * Auto-detect content type from URL
     */
    private function detectContentTypeFromUrl($url)
    {
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)/', $url)) {
            return 'youtube_video';
        }
        
        if (preg_match('/instagram\.com\//', $url)) {
            return 'instagram_account';
        }
        
        // Check if it's an image file
        if (preg_match('/\.(jpg|jpeg|png|gif|webp|svg)$/i', $url)) {
            return 'photo';
        }
        
        // Default to photo for unknown URLs
        return 'photo';
    }

    /**
     * Generate title from URL based on content type
     */
    private function generateTitleFromUrl($url, $type)
    {
        switch ($type) {
            case 'youtube_video':
                // Extract video ID and try to get title from YouTube
                if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $matches)) {
                    $videoId = $matches[1];
                    // For now, return a formatted title - you can integrate YouTube API later
                    return 'YouTube Video - ' . $videoId;
                }
                break;
                
            case 'instagram_account':
                // Extract username from Instagram URL
                if (preg_match('/instagram\.com\/([a-zA-Z0-9._]+)/', $url, $matches)) {
                    $username = $matches[1];
                    return '@' . $username;
                }
                break;
                
            case 'instagram_embed':
                // Extract post ID or username from Instagram embed URL
                if (preg_match('/instagram\.com\/([a-zA-Z0-9._]+)/', $url, $matches)) {
                    $username = $matches[1];
                    return 'Instagram Post - @' . $username;
                }
                break;
                
            case 'photo':
                // Extract filename from photo URL
                $filename = basename(parse_url($url, PHP_URL_PATH));
                return 'Photo - ' . pathinfo($filename, PATHINFO_FILENAME);
                break;
        }
        
        return 'Media Item';
    }

    /**
     * Generate thumbnail from URL based on content type
     */
    private function generateThumbnailFromUrl($url, $type)
    {
        switch ($type) {
            case 'youtube_video':
                // Generate YouTube thumbnail URL
                if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $matches)) {
                    $videoId = $matches[1];
                    return "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg";
                }
                break;
                
            case 'instagram_account':
            case 'instagram_embed':
                // For Instagram, you might want to use a default icon or integrate Instagram API
                return null;
                
            case 'photo':
                // For photos, the URL itself can serve as the thumbnail
                return $url;
                break;
        }
        
        return null;
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
        $mediaItem = MediaItem::findOrFail($id);
        $categories = MediaCategory::ordered()->get();
        return view('admin.media-items.edit', compact('mediaItem', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'media_category_id' => 'required|exists:media_categories,id',
            'content' => 'required|url',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        // Auto-detect content type from URL
        $type = $this->detectContentTypeFromUrl($request->content);
        
        // Auto-generate title and thumbnail from URL
        $title = $this->generateTitleFromUrl($request->content, $type);
        $thumbnail = $this->generateThumbnailFromUrl($request->content, $type);

        $mediaItem = MediaItem::findOrFail($id);
        $mediaItem->update([
            'media_category_id' => $request->media_category_id,
            'type' => $type,
            'title' => $title,
            'content' => $request->content,
            'description' => null,
            'thumbnail' => $thumbnail,
            'sort_order' => $request->sort_order ?? 0
        ]);

        return redirect()->route('admin.media-items.index')
            ->with('success', 'Media item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mediaItem = MediaItem::findOrFail($id);
        $mediaItem->delete();

        return redirect()->route('admin.media-items.index')
            ->with('success', 'Media item deleted successfully!');
    }
}
