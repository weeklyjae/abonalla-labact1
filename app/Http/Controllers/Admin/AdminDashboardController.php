<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $unreadMessagesCount = ContactMessage::count();

        return view('admin.dashboard', compact('unreadMessagesCount'));
    }

    public function coding()
    {
        $images = $this->getFolderImages('coding');
        return view('admin.coding-projects', compact('images'));
    }

    public function media()
    {
        $settings = [
            'youtube_channel' => '',
            'youtube_videos' => '',
            'instagram_username' => '',
            'instagram_embed' => '',
        ];

        if (Storage::disk('public')->exists('media_settings.json')) {
            $youtubeSettings = json_decode(Storage::disk('public')->get('media_settings.json'), true);
            if ($youtubeSettings) {
                $settings['youtube_channel'] = $youtubeSettings['youtube_channel'] ?? '';
                $settings['youtube_videos'] = $youtubeSettings['youtube_videos'] ?? '';
            }
        }

        if (Storage::disk('public')->exists('instagram_settings.json')) {
            $instagramSettings = json_decode(Storage::disk('public')->get('instagram_settings.json'), true);
            if ($instagramSettings) {
                $settings['instagram_username'] = $instagramSettings['instagram_username'] ?? '';
                $settings['instagram_embed'] = $instagramSettings['instagram_embed'] ?? '';
            }
        }

        return view('admin.media-library', compact('settings'));
    }

    public function youtubeStore(Request $request)
    {
        $request->validate([
            'youtube_channel' => 'nullable|url',
            'youtube_videos' => 'nullable|string',
        ]);

        $settings = [
            'youtube_channel' => $request->youtube_channel,
            'youtube_videos' => $request->youtube_videos,
        ];

        Storage::disk('public')->put('media_settings.json', json_encode($settings));

        return response()->json(['success' => true]);
    }

    public function instagramStore(Request $request)
    {
        $request->validate([
            'instagram_username' => 'nullable|string',
            'instagram_embed' => 'nullable|string',
        ]);

        $settings = [
            'instagram_username' => $request->instagram_username,
            'instagram_embed' => $request->instagram_embed,
        ];

        Storage::disk('public')->put('instagram_settings.json', json_encode($settings));

        return response()->json(['success' => true]);
    }

    private function getFolderImages(string $folder): array
    {
        $path = "gallery/{$folder}";

        if (! Storage::disk('public')->exists($path)) {
            return [];
        }

        $files = Storage::disk('public')->files($path);

        return collect($files)
            ->filter(fn ($file) => in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
            ->map(fn ($file) => [
                'path' => $file,
                'name' => pathinfo($file, PATHINFO_FILENAME),
                'filename' => pathinfo($file, PATHINFO_BASENAME),
                'url' => asset('storage/' . $file),
            ])
            ->values()
            ->all();
    }
}


