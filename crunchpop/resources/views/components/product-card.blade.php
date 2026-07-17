@props(['product', 'compact' => false])

@php
    $gradients = [
        'from-berry-300 to-grape-400',
        'from-tangerine-300 to-berry-400',
        'from-lime-300 to-skypop-400',
        'from-skypop-300 to-grape-400',
        'from-grape-300 to-berry-400',
        'from-tangerine-300 to-lime-400',
    ];
    $gradient = $gradients[$product->id % count($gradients)];
    $available = $product->is_available;
@endphp

<div class="card group flex flex-col overflow-hidden transition duration-300 hover:-translate-y-1">
    {{-- Image --}}
    <a href="{{ route('shop.show', $product) }}" class="relative block">
        <div class="relative aspect-square overflow-hidden bg-gradient-to-br {{ $gradient }}">
            @if ($product->image_url)
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                     class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
            @else
                <div class="flex h-full w-full items-center justify-center text-7xl transition duration-500 group-hover:scale-110">
                    {{ $product->is_coming_soon ? '🔜' : '🍬' }}
                </div>
            @endif

            @if ($product->badge)
                <span class="chip absolute left-3 top-3 bg-white/90 text-berry-600 shadow">{{ $product->badge }}</span>
            @endif
        </div>
    </a>

    {{-- Body --}}
    <div class="flex flex-1 flex-col p-5">
        @if ($product->size)
            <span class="text-xs font-bold uppercase tracking-wide text-grape-500">{{ $product->size }}</span>
        @endif
        <h3 class="mt-1 font-display text-lg font-extrabold leading-tight text-ink">
            <a href="{{ route('shop.show', $product) }}" class="transition hover:text-berry-600">{{ $product->name }}</a>
        </h3>

        @unless ($compact)
            <p class="mt-2 line-clamp-2 text-sm text-ink/60">{{ $product->tagline ?? $product->description }}</p>
        @endunless

        <div class="mt-4 flex items-center justify-between gap-3 pt-1">
            @if ($product->is_coming_soon)
                <span class="font-display text-lg font-extrabold text-grape-500">Coming Soon</span>
            @else
                <span class="font-display text-2xl font-extrabold text-berry-600">${{ number_format($product->price, 2) }}</span>
            @endif
        </div>

        <div class="mt-4 flex flex-col gap-2">
            @if ($available)
                <form action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-primary w-full !py-2.5 text-sm">Add to Cart</button>
                </form>
            @else
                <a href="{{ route('shop.show', $product) }}" class="btn-outline w-full !py-2.5 text-sm">
                    {{ $product->is_coming_soon ? 'See What’s Coming' : 'View Details' }}
                </a>
            @endif

            @if ($product->ingredients || $product->allergen_info)
                <a href="{{ route('shop.show', $product) }}#ingredients"
                   class="text-center text-xs font-bold text-ink/50 underline-offset-2 hover:text-berry-600 hover:underline">
                    Ingredients &amp; Allergen Info
                </a>
            @endif
        </div>
    </div>
</div>
