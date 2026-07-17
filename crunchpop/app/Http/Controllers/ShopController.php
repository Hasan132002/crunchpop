<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::active()
            ->where('is_bundle', false)
            ->orderBy('is_coming_soon')
            ->orderBy('sort_order')
            ->get();

        $bundles = Product::active()
            ->where('is_bundle', true)
            ->orderBy('sort_order')
            ->get();

        return view('pages.shop', compact('products', 'bundles'));
    }

    public function show(Product $product)
    {
        abort_unless($product->is_active, 404);

        $related = Product::active()
            ->where('id', '!=', $product->id)
            ->where('is_coming_soon', false)
            ->orderByDesc('is_featured')
            ->take(4)
            ->get();

        return view('pages.product', compact('product', 'related'));
    }
}
