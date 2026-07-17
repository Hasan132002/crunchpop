@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
<section class="section py-12">
    <h1 class="font-display text-4xl font-extrabold text-ink">Your Cart</h1>

    @if ($items->isEmpty())
        <div class="card mt-8 p-12 text-center">
            <div class="text-6xl">🛒</div>
            <p class="mt-4 text-lg font-bold text-ink/70">Your cart is empty.</p>
            <p class="mt-1 text-ink/50">Let's fix that — the crunch is calling.</p>
            <a href="{{ route('shop.index') }}" class="btn-primary mt-6">Shop Candy</a>
        </div>
    @else
        <div class="mt-8 grid gap-8 lg:grid-cols-3">
            {{-- Line items --}}
            <div class="lg:col-span-2">
                <div class="card divide-y divide-berry-50">
                    @foreach ($items as $line)
                        @php $product = $line['product']; @endphp
                        <div class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center">
                            <a href="{{ route('shop.show', $product) }}"
                               class="grid h-20 w-20 shrink-0 place-items-center rounded-2xl bg-gradient-to-br from-berry-200 to-grape-300 text-3xl">
                                @if ($product->image_url)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-full w-full rounded-2xl object-cover">
                                @else 🍬 @endif
                            </a>

                            <div class="min-w-0 flex-1">
                                <h3 class="font-display font-extrabold text-ink">
                                    <a href="{{ route('shop.show', $product) }}" class="hover:text-berry-600">{{ $product->name }}</a>
                                </h3>
                                @if ($product->size)<p class="text-sm text-ink/50">{{ $product->size }}</p>@endif
                                <p class="text-sm font-bold text-berry-600">${{ number_format($product->price, 2) }} each</p>
                            </div>

                            <div class="flex items-center gap-4">
                                <form action="{{ route('cart.update', $product) }}" method="POST" data-stepper class="flex items-center rounded-full bg-cream p-1 ring-1 ring-berry-100">
                                    @csrf @method('PATCH')
                                    <button type="button" data-step="-1" class="grid h-8 w-8 place-items-center rounded-full text-lg font-bold text-berry-600 hover:bg-berry-50">−</button>
                                    <input type="number" name="quantity" value="{{ $line['quantity'] }}" min="0" max="99"
                                           onchange="this.form.submit()"
                                           class="w-10 border-0 bg-transparent text-center font-bold text-ink focus:ring-0">
                                    <button type="button" data-step="1" class="grid h-8 w-8 place-items-center rounded-full text-lg font-bold text-berry-600 hover:bg-berry-50">+</button>
                                </form>

                                <span class="w-20 text-right font-display font-extrabold text-ink">${{ number_format($line['line_total'], 2) }}</span>

                                <form action="{{ route('cart.remove', $product) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" aria-label="Remove" class="grid h-8 w-8 place-items-center rounded-full text-ink/40 hover:bg-berry-50 hover:text-berry-600">✕</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 flex justify-between">
                    <a href="{{ route('shop.index') }}" class="btn-ghost text-berry-600">← Keep shopping</a>
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-ghost text-ink/50 hover:text-berry-600">Clear cart</button>
                    </form>
                </div>
            </div>

            {{-- Summary --}}
            <div>
                <div class="card sticky top-24 p-6">
                    <h2 class="font-display text-xl font-extrabold text-ink">Order Summary</h2>
                    <dl class="mt-4 space-y-3 text-ink/70">
                        <div class="flex justify-between"><dt>Subtotal</dt><dd class="font-bold text-ink">${{ number_format($subtotal, 2) }}</dd></div>
                        <div class="flex justify-between text-sm"><dt>Shipping</dt><dd>Calculated at checkout</dd></div>
                    </dl>
                    <div class="mt-4 flex justify-between border-t border-berry-100 pt-4">
                        <span class="font-display text-lg font-extrabold text-ink">Estimated total</span>
                        <span class="font-display text-lg font-extrabold text-berry-600">${{ number_format($subtotal, 2) }}</span>
                    </div>
                    @if ($subtotal < \App\Services\CartService::FREE_SHIPPING_OVER)
                        <p class="mt-3 rounded-2xl bg-lime-100 px-4 py-2 text-center text-sm font-semibold text-lime-500">
                            Add ${{ number_format(\App\Services\CartService::FREE_SHIPPING_OVER - $subtotal, 2) }} more for free shipping! 🚚
                        </p>
                    @else
                        <p class="mt-3 rounded-2xl bg-lime-100 px-4 py-2 text-center text-sm font-semibold text-lime-500">You've unlocked free shipping! 🎉</p>
                    @endif
                    <a href="{{ route('checkout.index') }}" class="btn-primary mt-5 w-full">Checkout</a>
                </div>
            </div>
        </div>
    @endif
</section>
@endsection
