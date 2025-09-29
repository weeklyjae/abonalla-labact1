<?php

namespace App\Http\Controllers;

use App\Models\TravelCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function coding()
    {
        $images = $this->getGalleryImages('coding');
        return view('portfolio.coding', compact('images'));
    }

    public function editing()
    {
        $images = $this->getGalleryImages('editing');
        
        // Load media settings
        $mediaSettings = $this->getMediaSettings();
        
        return view('portfolio.editing', compact('images', 'mediaSettings'));
    }

    public function travel()
    {
        // Get travel categories with their photos
        $categories = TravelCategory::with(['photos'])->get();

        // Fallback to old method if no categories exist
        if ($categories->isEmpty()) {
            $images = $this->getGalleryImages('travel');
            return view('portfolio.travel', compact('images'));
        }

        return view('portfolio.travel', compact('categories'));
    }

    private function getGalleryImages($folder)
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
                    'url' => Storage::disk('public')->url($file)
                ];
            }
        }

        return $images;
    }
    
    private function getMediaSettings()
    {
        // Get media categories with their items
        $mediaCategories = \App\Models\MediaCategory::with(['mediaItems' => function($query) {
            $query->active()->ordered();
        }])->active()->ordered()->get();
        
        return $mediaCategories;
    }
}
