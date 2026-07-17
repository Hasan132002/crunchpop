<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(protected CartService $cart) {}

    public function index()
    {
        return view('pages.cart', [
            'items'    => $this->cart->items(),
            'subtotal' => $this->cart->subtotal(),
        ]);
    }

    public function add(Request $request, Product $product)
    {
        $data = $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1', 'max:99'],
        ]);

        if (! $product->is_available) {
            return back()->with('error', 'Sorry, that item is not available right now.');
        }

        $this->cart->add($product, $data['quantity'] ?? 1);

        return back()->with('success', $product->name . ' added to your cart!');
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:0', 'max:99'],
        ]);

        $this->cart->update($product->id, $data['quantity']);

        return back()->with('success', 'Cart updated.');
    }

    public function remove(Product $product)
    {
        $this->cart->remove($product->id);

        return back()->with('success', 'Item removed from your cart.');
    }

    public function clear()
    {
        $this->cart->clear();

        return back()->with('success', 'Your cart has been cleared.');
    }
}
