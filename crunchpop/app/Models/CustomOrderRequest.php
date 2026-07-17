<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomOrderRequest extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'organization', 'event_type', 'event_date',
        'guest_count', 'candy_type', 'bag_size', 'budget_range',
        'fulfillment_preference', 'message', 'status',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    public const STATUSES = ['new', 'contacted', 'quoted', 'closed'];
}
