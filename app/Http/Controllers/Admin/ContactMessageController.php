<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ContactMessageController extends Controller
{
    public function create()
    {
        return view('admin.contact-messages-create');
    }

    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);
        $archived = ContactMessage::onlyTrashed()->latest('deleted_at')->paginate(10, ['*'], 'archived_page');

        return view('admin.contact-messages', [
            'messages' => $messages,
            'archived' => $archived,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string'],
            'images.*' => ['nullable', 'image', 'max:10240'], // Multiple images, each max 10MB
        ]);

        $data = array_merge($validated, [
            'user_id' => Auth::id(),
        ]);

        // Process images if uploaded
        if ($request->hasFile('images')) {
            $manager = new ImageManager(new Driver());
            $saved = [];

            foreach ($request->file('images') as $file) {
                $image = $manager->read($file->getPathname());

                // watermark bottom-right (75px offset), 50% opacity
                $image->place(public_path('images/logo.png'), 
                    'bottom-right', 
                    $offsetX = 75, 
                    $offsetY = 75, 
                    $opacity = 50);

                // scale to height 500
                $image->scale(height: 500);

                // save
                $filename = time() . '_' . uniqid() . '.jpg';
                $image->save(public_path('images/' . $filename));

                $saved[] = 'images/' . $filename;
            }

            $data['images'] = json_encode($saved);
        }

        ContactMessage::create($data);

        return redirect()->route('admin.contact-messages.index')->with('success', 'Message added.');
    }

    //soft-delete (archive)
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()->route('admin.contact-messages.index')->with('success', 'Message archived.');
    }

    public function update(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        $contactMessage->update($validated);

        return redirect()->route('admin.contact-messages.index')->with('success', 'Message updated.');
    }

    public function restore(int $id)
    {
        $message = ContactMessage::onlyTrashed()->findOrFail($id);
        $message->restore();

        return redirect()->route('admin.contact-messages.index')->with('success', 'Message restored.');
    }

    public function forceDelete(int $id)
    {
        $message = ContactMessage::onlyTrashed()->findOrFail($id);
        $message->forceDelete();

        return redirect()->route('admin.contact-messages.index')->with('success', 'Message permanently deleted.');
    }
}

