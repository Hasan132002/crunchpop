<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number', 'customer_name', 'customer_email', 'customer_phone',
        'shipping_address', 'shipping_city', 'shipping_state', 'shipping_zip',
        'fulfillment_method', 'notes', 'subtotal', 'shipping_cost', 'total', 'status',
    ];

    protected $casts = [
        'subtotal'      => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'total'         => 'decimal:2',
    ];

    public const STATUSES = ['pending', 'paid', 'processing', 'completed', 'cancelled'];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function generateOrderNumber(): string
    {
        return 'CP-' . strtoupper(bin2hex(random_bytes(4)));
    }
}
