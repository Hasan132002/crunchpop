@extends('layouts.app')

@section('title', $product->name)
@section('meta_description', $product->tagline ?? $product->description)

@section('content')

@php
    $gradients = [
        'from-berry-300 to-grape-400', 'from-tangerine-300 to-berry-400',
        'from-lime-300 to-skypop-400', 'from-skypop-300 to-grape-400',
        'from-grape-300 to-berry-400', 'from-tangerine-300 to-lime-400',
    ];
    $gradient = $gradients[$product->id % count($gradients)];
@endphp

<section class="section py-10">
    {{-- Breadcrumb --}}
    <nav class="mb-6 text-sm text-ink/50">
        <a href="{{ route('home') }}" class="hover:text-berry-600">Home</a>
        <span class="mx-1">/</span>
        <a href="{{ route('shop.index') }}" class="hover:text-berry-600">Shop</a>
        <span class="mx-1">/</span>
        <span class="font-semibold text-ink/70">{{ $product->name }}</span>
    </nav>

    <div class="grid gap-10 lg:grid-cols-2">
        {{-- Image --}}
        <div class="relative aspect-square overflow-hidden rounded-[2.5rem] bg-gradient-to-br {{ $gradient }} shadow-xl">
            @if ($product->image_url)
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
            @else
                <div class="grid h-full w-full place-items-center text-[10rem]">{{ $product->is_coming_soon ? '🔜' : '🍬' }}</div>
            @endif
            @if ($product->badge)
                <span class="chip absolute left-5 top-5 bg-white/90 text-berry-600 shadow">{{ $product->badge }}</span>
            @endif
        </div>

        {{-- Details --}}
        <div>
            @if ($product->size)
                <span class="text-sm font-bold uppercase tracking-wide text-grape-500">{{ $product->size }}</span>
            @endif
            <h1 class="mt-1 font-display text-4xl font-extrabold text-ink">{{ $product->name }}</h1>

            @if ($product->tagline)
                <p class="mt-3 text-lg font-semibold text-berry-600">{{ $product->tagline }}</p>
            @endif

            <div class="mt-5">
                @if ($product->is_coming_soon)
                    <span class="font-display text-3xl font-extrabold text-grape-500">Coming Soon</span>
                @else
                    <span class="font-display text-4xl font-extrabold text-berry-600">${{ number_format($product->price, 2) }}</span>
                @endif
            </div>

            @if ($product->description)
                <p class="mt-5 text-ink/70">{{ $product->description }}</p>
            @endif

            {{-- Add to cart --}}
            <div class="mt-8">
                @if ($product->is_available)
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="flex flex-wrap items-center gap-4">
                        @csrf
                        <div data-stepper class="flex items-center rounded-full bg-white p-1 shadow-sm ring-1 ring-berry-100">
                            <button type="button" data-step="-1" class="grid h-10 w-10 place-items-center rounded-full text-xl font-bold text-berry-600 hover:bg-berry-50">−</button>
                            <input type="number" name="quantity" value="1" min="1" max="99" class="w-12 border-0 bg-transparent text-center font-bold text-ink focus:ring-0">
                            <button type="button" data-step="1" class="grid h-10 w-10 place-items-center rounded-full text-xl font-bold text-berry-600 hover:bg-berry-50">+</button>
                        </div>
                        <button type="submit" class="btn-primary flex-1 sm:flex-none">Add to Cart</button>
                    </form>
                @else
                    <div class="rounded-2xl bg-grape-50 p-5 text-grape-700">
                        <p class="font-bold">This treat isn't available to buy just yet.</p>
                        <p class="mt-1 text-sm">Join the early list below and we'll let you know the moment it drops.</p>
                        <a href="{{ route('mission') }}#early-list" class="btn-secondary mt-4 !py-2.5 text-sm">Join the Early List</a>
                    </div>
                @endif
            </div>

            {{-- Quick facts --}}
            <dl class="mt-8 grid grid-cols-2 gap-4 border-t border-berry-100 pt-6 text-sm">
                @if ($product->size)
                    <div><dt class="font-bold text-ink/50">Size</dt><dd class="text-ink/80">{{ $product->size }}</dd></div>
                @endif
                @if ($product->category)
                    <div><dt class="font-bold text-ink/50">Category</dt><dd class="text-ink/80">{{ $product->category->name }}</dd></div>
                @endif
            </dl>
        </div>
    </div>

    {{-- Ingredients & allergens --}}
    @if ($product->ingredients || $product->allergen_info)
        <div id="ingredients" class="card mt-12 grid gap-6 p-8 sm:grid-cols-2">
            @if ($product->ingredients)
                <div>
                    <h2 class="font-display text-xl font-extrabold text-ink">Ingredients</h2>
                    <p class="mt-2 text-ink/70">{{ $product->ingredients }}</p>
                </div>
            @endif
            @if ($product->allergen_info)
                <div>
                    <h2 class="font-display text-xl font-extrabold text-ink">Allergen Info</h2>
                    <p class="mt-2 text-ink/70">{{ $product->allergen_info }}</p>
                </div>
            @endif
        </div>
    @endif
</section>

{{-- Related --}}
@if ($related->isNotEmpty())
<section class="bg-berry-50 py-16">
    <div class="section">
        <h2 class="font-display text-3xl font-extrabold text-ink">You Might Also Love</h2>
        <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($related as $item)
                <x-product-card :product="$item" compact />
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
