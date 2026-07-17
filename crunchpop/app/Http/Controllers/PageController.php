<?php

namespace App\Http\Controllers;

use App\Models\Product;

class PageController extends Controller
{
    public function home()
    {
        $previewProducts = Product::active()
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        return view('pages.home', compact('previewProducts'));
    }

    public function mission()
    {
        return view('pages.mission');
    }
}
