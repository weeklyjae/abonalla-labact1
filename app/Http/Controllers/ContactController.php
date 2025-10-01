<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:1000'],
        ], [
            'name.required' => 'Please enter your name.',
            'name.max' => 'Name may not be greater than 255 characters.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Provide a valid email address.',
            'email.max' => 'Email may not be greater than 255 characters.',
            'message.required' => 'Please enter your message.',
            'message.min' => 'Message must be at least 10 characters.',
            'message.max' => 'Message may not be greater than 1000 characters.',
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Thank you for your message! I\'ll get back to you soon.',
            ]);
        }

        return redirect()->back()->with('success', 'Thank you for your message! I\'ll get back to you soon.');
    }
}
