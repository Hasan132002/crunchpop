<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class CartService
{
    protected const SESSION_KEY = 'cart';

    /** Flat shipping fee applied when fulfillment is shipping. */
    public const SHIPPING_FLAT = 6.50;

    /** Free shipping threshold. */
    public const FREE_SHIPPING_OVER = 50.00;

    /**
     * Raw cart map: [product_id => quantity]
     */
    protected function raw(): array
    {
        return session()->get(self::SESSION_KEY, []);
    }

    protected function persist(array $items): void
    {
        session()->put(self::SESSION_KEY, $items);
    }

    public function add(Product $product, int $quantity = 1): void
    {
        if (! $product->is_available) {
            return;
        }
        $items = $this->raw();
        $current = $items[$product->id] ?? 0;
        $items[$product->id] = max(1, $current + $quantity);
        $this->persist($items);
    }

    public function update(int $productId, int $quantity): void
    {
        $items = $this->raw();
        if ($quantity <= 0) {
            unset($items[$productId]);
        } else {
            $items[$productId] = $quantity;
        }
        $this->persist($items);
    }

    public function remove(int $productId): void
    {
        $items = $this->raw();
        unset($items[$productId]);
        $this->persist($items);
    }

    public function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    /**
     * Detailed line items with product models, pruning anything unavailable.
     *
     * @return Collection<int, array{product: Product, quantity: int, line_total: float}>
     */
    public function items(): Collection
    {
        $raw = $this->raw();
        if (empty($raw)) {
            return collect();
        }

        $products = Product::whereIn('id', array_keys($raw))->get()->keyBy('id');

        return collect($raw)
            ->map(function ($qty, $id) use ($products) {
                $product = $products->get($id);
                if (! $product || ! $product->is_available) {
                    return null;
                }
                $qty = (int) $qty;
                return [
                    'product'    => $product,
                    'quantity'   => $qty,
                    'line_total' => round($product->price * $qty, 2),
                ];
            })
            ->filter()
            ->values();
    }

    public function count(): int
    {
        return (int) collect($this->raw())->sum();
    }

    public function subtotal(): float
    {
        return (float) $this->items()->sum('line_total');
    }

    public function shippingCost(string $method = 'shipping'): float
    {
        if ($method === 'pickup') {
            return 0.0;
        }
        if ($this->subtotal() >= self::FREE_SHIPPING_OVER || $this->subtotal() <= 0) {
            return 0.0;
        }
        return self::SHIPPING_FLAT;
    }

    public function total(string $method = 'shipping'): float
    {
        return round($this->subtotal() + $this->shippingCost($method), 2);
    }

    public function isEmpty(): bool
    {
        return $this->items()->isEmpty();
    }
}
