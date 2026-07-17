<?php

namespace App\Http\Controllers;

use App\Mail\CustomOrderRequestMail;
use App\Models\CustomOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CustomOrderController extends Controller
{
    public function index()
    {
        return view('pages.custom-orders');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                   => ['required', 'string', 'max:120'],
            'email'                  => ['required', 'email', 'max:160'],
            'phone'                  => ['nullable', 'string', 'max:40'],
            'organization'           => ['nullable', 'string', 'max:160'],
            'event_type'             => ['nullable', 'string', 'max:120'],
            'event_date'             => ['nullable', 'date'],
            'guest_count'            => ['nullable', 'string', 'max:60'],
            'candy_type'             => ['nullable', 'string', 'max:160'],
            'bag_size'               => ['nullable', 'string', 'max:120'],
            'budget_range'           => ['nullable', 'string', 'max:120'],
            'fulfillment_preference' => ['nullable', 'in:pickup,shipping,either'],
            'message'                => ['nullable', 'string', 'max:2000'],
        ]);

        $requestRecord = CustomOrderRequest::create($validated + ['status' => 'new']);

        try {
            Mail::to(config('mail.admin_address'))
                ->send(new CustomOrderRequestMail($requestRecord));
        } catch (\Throwable $e) {
            report($e);
        }

        return back()->with('success',
            'Thanks! Your custom order request has been received. We will reply as soon as possible.');
    }
}
