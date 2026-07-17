<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'tagline', 'description', 'size',
        'price', 'pack_quantity', 'image', 'badge', 'ingredients', 'allergen_info',
        'is_bundle', 'is_coming_soon', 'is_featured', 'is_active', 'stock', 'sort_order',
    ];

    protected $casts = [
        'price'          => 'decimal:2',
        'is_bundle'      => 'boolean',
        'is_coming_soon' => 'boolean',
        'is_featured'    => 'boolean',
        'is_active'      => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    protected static function booted(): void
    {
        static::saving(function (Product $product) {
            if (blank($product->slug) && filled($product->name)) {
                $product->slug = static::uniqueSlug($product->name, $product->id);
            }
        });
    }

    public static function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 2;
        while (static::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $i++;
        }
        return $slug;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePurchasable($query)
    {
        return $query->where('is_active', true)->where('is_coming_soon', false);
    }

    public function getIsAvailableAttribute(): bool
    {
        return $this->is_active
            && ! $this->is_coming_soon
            && ($this->stock === null || $this->stock > 0);
    }

    public function getImageUrlAttribute(): ?string
    {
        if (blank($this->image)) {
            return null;
        }
        if (Str::startsWith($this->image, ['http://', 'https://', '/'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }
}
