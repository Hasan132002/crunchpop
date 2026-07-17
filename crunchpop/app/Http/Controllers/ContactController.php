<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:120'],
            'email'   => ['required', 'email', 'max:160'],
            'phone'   => ['nullable', 'string', 'max:40'],
            'subject' => ['nullable', 'string', 'max:160'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $message = ContactMessage::create($validated);

        try {
            Mail::to(config('mail.admin_address'))
                ->send(new ContactMessageMail($message));
        } catch (\Throwable $e) {
            report($e);
        }

        return back()->with('success', 'Thanks for reaching out! We will get back to you soon.');
    }
}
