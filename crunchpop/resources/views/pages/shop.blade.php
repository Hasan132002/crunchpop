@extends('layouts.app')

@section('title', 'Shop CrunchPop Candy')
@section('meta_description', 'Shop bright, crunchy, shelf-stable freeze-dried candy. Pick your favorite size, flavor, or multi-pack bundle.')

@section('content')

{{-- ============ SHOP HERO ============ --}}
<section class="relative overflow-hidden bg-gradient-to-br from-berry-100 via-cream to-tangerine-100">
    <div class="section py-16 text-center">
        <span class="chip bg-white text-berry-600 shadow-sm">🍭 The Candy Shop</span>
        <h1 class="mt-5 font-display text-5xl font-extrabold text-ink sm:text-6xl">Shop CrunchPop Candy</h1>
        <p class="mx-auto mt-4 max-w-2xl font-display text-xl font-bold text-grape-600">
            Freeze-dried candy that's bright, crunchy, fun, and shelf-stable.
        </p>
        <p class="mx-auto mt-3 max-w-xl text-ink/60">
            Pick your favorite size, flavor, or bundle. More products are coming soon.
        </p>
    </div>
</section>

{{-- ============ PRODUCT GRID ============ --}}
<section class="section py-16">
    <h2 class="font-display text-3xl font-extrabold text-ink">All Candy</h2>
    <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($products as $product)
            <x-product-card :product="$product" />
        @empty
            <p class="col-span-full rounded-3xl bg-white p-10 text-center text-ink/50">No products yet — check back soon!</p>
        @endforelse
    </div>
</section>

{{-- ============ BUNDLES ============ --}}
@if ($bundles->isNotEmpty())
<section class="bg-grape-50 py-16">
    <div class="section">
        <div class="mx-auto max-w-2xl text-center">
            <span class="chip bg-grape-100 text-grape-600">Best value</span>
            <h2 class="mt-4 font-display text-4xl font-extrabold text-ink">Save More With Multi-Packs</h2>
            <p class="mt-3 text-ink/60">More bags, more sharing, more savings.</p>
        </div>
        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($bundles as $bundle)
                <x-product-card :product="$bundle" />
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ============ PRODUCT INFORMATION BLOCK ============ --}}
<section class="section py-16">
    <div class="card p-8 sm:p-10">
        <h2 class="font-display text-2xl font-extrabold text-ink">Good to Know</h2>
        <div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @php
                $info = [
                    ['emoji' => '🧾', 'title' => 'Ingredients vary by product', 'text' => 'Every product lists its own ingredients on the product page.'],
                    ['emoji' => '⚠️', 'title' => 'Allergen information', 'text' => 'Allergen details are listed on each product and on the bag.'],
                    ['emoji' => '👩‍🍳', 'title' => 'Made in small batches', 'text' => 'Fresh, small-batch freeze-drying for maximum crunch.'],
                    ['emoji' => '❄️', 'title' => 'Store cool & dry', 'text' => 'Keep in a cool, dry place and reseal to keep the crunch.'],
                    ['emoji' => '📦', 'title' => 'Shelf-stable', 'text' => 'Lightweight and long-lasting — great for pantries and on the go.'],
                    ['emoji' => '🏡', 'title' => 'Cottage food notice', 'text' => 'Prepared under Florida cottage food guidance where required.'],
                ];
            @endphp
            @foreach ($info as $item)
                <div class="flex gap-3">
                    <span class="text-2xl">{{ $item['emoji'] }}</span>
                    <div>
                        <h3 class="font-display font-extrabold text-ink">{{ $item['title'] }}</h3>
                        <p class="text-sm text-ink/60">{{ $item['text'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ SHOP CTA ============ --}}
<section class="section pb-8">
    <div class="rounded-[2.5rem] bg-gradient-to-r from-berry-500 to-grape-500 px-6 py-14 text-center shadow-xl">
        <h2 class="font-display text-4xl font-extrabold text-white">Ready for the crunch?</h2>
        <a href="#" class="btn-outline mt-6 !bg-white">Shop All Candy</a>
    </div>
</section>

<x-early-list source="shop" />

@endsection
