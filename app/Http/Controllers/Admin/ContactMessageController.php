<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);
        $archived = ContactMessage::onlyTrashed()->latest('deleted_at')->paginate(10, ['*'], 'archived_page');

        return view('admin.contact-messages.index', compact('messages', 'archived'));
    }

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

