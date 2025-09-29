<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteController extends Controller
{
    public function index()
    {
        $aboutText = $this->getSiteContent('about');
        $heroTitle = $this->getSiteContent('hero_title');
        $socials = $this->getSiteContent('socials');
        
        return view('admin.site', compact('aboutText', 'heroTitle', 'socials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'about_text' => 'required|string|max:2000',
            'hero_title' => 'required|string|max:255',
            'github' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
        ]);

        // Save about text
        Storage::disk('public')->put('site_about.txt', $request->about_text);
        
        // Save hero title
        Storage::disk('public')->put('site_hero_title.txt', $request->hero_title);
        
        // Save social links
        $socials = [
            'github' => $request->github,
            'linkedin' => $request->linkedin,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
        ];
        Storage::disk('public')->put('site_socials.txt', json_encode($socials));
        
        return redirect()->back()->with('success', 'Site content updated successfully!');
    }

    private function getSiteContent($type)
    {
        $defaults = [
            'about' => 'I am Jhon Martin Abonalla, also known as weeklyjae. I am a passionate developer and creative professional with expertise in coding, video editing, and photography. I love creating digital experiences and capturing moments through my lens.',
            'hero_title' => 'Hi, I\'m weeklyjae',
            'socials' => [
                'github' => 'https://github.com/weeklyjae',
                'linkedin' => 'https://linkedin.com/in/weeklyjae',
                'instagram' => 'https://instagram.com/weeklyjae',
                'youtube' => 'https://youtube.com/@weeklyjae'
            ]
        ];

        if (Storage::disk('public')->exists("site_{$type}.txt")) {
            $content = Storage::disk('public')->get("site_{$type}.txt");
            if ($type === 'socials') {
                return json_decode($content, true) ?: $defaults[$type];
            }
            return $content ?: $defaults[$type];
        }

        return $defaults[$type];
    }
}
