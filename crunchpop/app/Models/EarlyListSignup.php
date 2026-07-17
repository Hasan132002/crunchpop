<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EarlyListSignup extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'interests', 'source',
    ];

    protected $casts = [
        'interests' => 'array',
    ];

    public const INTEREST_OPTIONS = [
        'candy'                 => 'Freeze-dried candy',
        'preparedness'          => 'Hurricane pantry products',
        'custom_freeze_drying'  => 'Custom freeze-drying',
        'family_emergency_food' => 'Family emergency food',
        'local_updates'         => 'Local South Florida updates',
        'fundraisers'           => 'Fundraising or group orders',
        'wholesale'             => 'Wholesale interest',
    ];
}
