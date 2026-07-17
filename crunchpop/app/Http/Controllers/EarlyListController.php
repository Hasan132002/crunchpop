<?php

namespace App\Http\Controllers;

use App\Mail\EarlyListSignupMail;
use App\Models\EarlyListSignup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EarlyListController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:120'],
            'email'       => ['required', 'email', 'max:160'],
            'phone'       => ['nullable', 'string', 'max:40'],
            'interests'   => ['nullable', 'array'],
            'interests.*' => ['string', 'in:' . implode(',', array_keys(EarlyListSignup::INTEREST_OPTIONS))],
            'source'      => ['nullable', 'string', 'max:80'],
        ]);

        $signup = EarlyListSignup::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'phone'     => $validated['phone'] ?? null,
            'interests' => $validated['interests'] ?? [],
            'source'    => $validated['source'] ?? 'website',
        ]);

        try {
            Mail::to(config('mail.admin_address'))
                ->send(new EarlyListSignupMail($signup));
        } catch (\Throwable $e) {
            report($e);
        }

        return back()->with('success', "You're on the list! We'll be in touch as the mission grows.")
            ->with('scroll_to', 'early-list');
    }
}
