<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function contact()
    {
        // Get site content from storage
        $socials = $this->getSiteContent('socials');
        
        return view('contact', compact('socials'));
    }

    public function site()
    {
        // Get site content from storage
        $aboutText = $this->getSiteContent('about');
        $heroTitle = $this->getSiteContent('hero_title');
        $socials = $this->getSiteContent('socials');
        
        return view('admin.site', compact('aboutText', 'heroTitle', 'socials'));
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
