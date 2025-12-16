<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ContactController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::check()) {
            $validated = $request->validate([
                'message' => ['required', 'string', 'min:10', 'max:1000'],
                'images.*' => ['nullable', 'image', 'max:10240'], // Multiple images, each max 10MB
            ]);

            $data = [
                'name' => Auth::user()->name ?? 'Anonymous',
                'email' => Auth::user()->email ?? 'no-reply@example.com',
                'message' => $validated['message'],
                'user_id' => Auth::id(),
            ];

            // image intervention
            if ($request->hasFile('images')) {
                $manager = new ImageManager(new Driver());
                $saved = [];

                foreach ($request->file('images') as $file) {
                    $image = $manager->read($file->getPathname());

                    // watermark bottom-right (75px offset), 25% opacity
                    $image->place(public_path('images/logo.png'), 
                        'bottom-right', 
                        $offsetX = 75, 
                        $offsetY = 75, 
                        $opacity = 50);

                    // scale
                    $image->scale(height: 500);

                    // save
                    $filename = time() . '_' . uniqid() . '.jpg';
                    $image->save(public_path('images/' . $filename));

                    $saved[] = 'images/' . $filename;
                }

                $data['images'] = json_encode($saved);
            }

            ContactMessage::create($data);
        } else {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'message' => ['required', 'string', 'min:10', 'max:1000'],
                'images.*' => ['nullable', 'image', 'max:10240'], // Multiple images, each max 10MB
            ]);

            $data = $validated;

            // Simple image processing if uploaded
            if ($request->hasFile('images')) {
                $manager = new ImageManager(new Driver());
                $saved = [];

                foreach ($request->file('images') as $file) {
                    $image = $manager->read($file->getPathname());

                    // watermark bottom-right (75px offset), 25% opacity
                    $image->place(public_path('images/logo.png'), 'bottom-right', 75, 75, 50);

                    // scale
                    $image->scale(height: 500);

                    // save
                    $filename = time() . '_' . uniqid() . '.jpg';
                    $image->save(public_path('images/' . $filename));

                    $saved[] = 'images/' . $filename;
                }

                $data['images'] = json_encode($saved);
            }

            ContactMessage::create($data);
        }

        return redirect()->back()->with('success', "Thank you for your message! I'll get back to you soon.");
    }
}