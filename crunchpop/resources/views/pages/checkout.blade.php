@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<section class="section py-12">
    <h1 class="font-display text-4xl font-extrabold text-ink">Checkout</h1>
    <p class="mt-2 text-ink/60">Almost there! Tell us where the candy's headed.</p>

    <form action="{{ route('checkout.store') }}" method="POST" class="mt-8 grid gap-8 lg:grid-cols-3">
        @csrf
        <div class="space-y-6 lg:col-span-2">
            {{-- Contact --}}
            <div class="card p-6 sm:p-8">
                <h2 class="font-display text-xl font-extrabold text-ink">Your Details</h2>
                <div class="mt-5 grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="form-label" for="customer_name">Full name *</label>
                        <input id="customer_name" name="customer_name" type="text" required value="{{ old('customer_name') }}" class="form-input">
                    </div>
                    <div>
                        <label class="form-label" for="customer_email">Email *</label>
                        <input id="customer_email" name="customer_email" type="email" required value="{{ old('customer_email') }}" class="form-input">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="form-label" for="customer_phone">Phone <span class="font-normal text-ink/40">(optional)</span></label>
                        <input id="customer_phone" name="customer_phone" type="tel" value="{{ old('customer_phone') }}" class="form-input">
                    </div>
                </div>
            </div>

            {{-- Fulfillment --}}
            <div class="card p-6 sm:p-8">
                <h2 class="font-display text-xl font-extrabold text-ink">How would you like it?</h2>
                <div class="mt-5 grid gap-3 sm:grid-cols-2">
                    <label class="flex cursor-pointer items-start gap-3 rounded-2xl bg-cream p-4 ring-1 ring-berry-100 transition has-[:checked]:bg-berry-50 has-[:checked]:ring-2 has-[:checked]:ring-berry-400">
                        <input type="radio" name="fulfillment_method" value="shipping" class="mt-1 text-berry-600 focus:ring-berry-400" @checked(old('fulfillment_method', 'shipping') === 'shipping')>
                        <span>
                            <span class="block font-display font-extrabold text-ink">🚚 Ship it</span>
                            <span class="block text-sm text-ink/60">Flat ${{ number_format(\App\Services\CartService::SHIPPING_FLAT, 2) }} — free over ${{ number_format(\App\Services\CartService::FREE_SHIPPING_OVER, 0) }}.</span>
                        </span>
                    </label>
                    <label class="flex cursor-pointer items-start gap-3 rounded-2xl bg-cream p-4 ring-1 ring-berry-100 transition has-[:checked]:bg-berry-50 has-[:checked]:ring-2 has-[:checked]:ring-berry-400">
                        <input type="radio" name="fulfillment_method" value="pickup" class="mt-1 text-berry-600 focus:ring-berry-400" @checked(old('fulfillment_method') === 'pickup')>
                        <span>
                            <span class="block font-display font-extrabold text-ink">📍 Local pickup</span>
                            <span class="block text-sm text-ink/60">Free — we'll coordinate a South Florida pickup.</span>
                        </span>
                    </label>
                </div>

                {{-- Shipping fields --}}
                <div data-shipping-fields class="mt-5 grid gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label class="form-label" for="shipping_address">Street address</label>
                        <input id="shipping_address" name="shipping_address" type="text" value="{{ old('shipping_address') }}" class="form-input">
                    </div>
                    <div>
                        <label class="form-label" for="shipping_city">City</label>
                        <input id="shipping_city" name="shipping_city" type="text" value="{{ old('shipping_city') }}" class="form-input">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="form-label" for="shipping_state">State</label>
                            <input id="shipping_state" name="shipping_state" type="text" value="{{ old('shipping_state', 'FL') }}" class="form-input">
                        </div>
                        <div>
                            <label class="form-label" for="shipping_zip">ZIP</label>
                            <input id="shipping_zip" name="shipping_zip" type="text" value="{{ old('shipping_zip') }}" class="form-input">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Notes --}}
            <div class="card p-6 sm:p-8">
                <label class="form-label" for="notes">Order notes <span class="font-normal text-ink/40">(optional)</span></label>
                <textarea id="notes" name="notes" rows="3" class="form-textarea" placeholder="Anything we should know?">{{ old('notes') }}</textarea>
            </div>

            <div class="rounded-2xl bg-skypop-100 p-4 text-sm text-skypop-500">
                💳 This is an early version — no live payment is taken online. We'll confirm your order and arrange payment directly.
            </div>
        </div>

        {{-- Summary --}}
        <div>
            <div class="card sticky top-24 p-6">
                <h2 class="font-display text-xl font-extrabold text-ink">Your Order</h2>
                <ul class="mt-4 space-y-3">
                    @foreach ($items as $line)
                        <li class="flex justify-between gap-3 text-sm">
                            <span class="text-ink/70">{{ $line['quantity'] }} × {{ $line['product']->name }}</span>
                            <span class="shrink-0 font-bold text-ink">${{ number_format($line['line_total'], 2) }}</span>
                        </li>
                    @endforeach
                </ul>
                <dl class="mt-4 space-y-2 border-t border-berry-100 pt-4 text-ink/70">
                    <div class="flex justify-between"><dt>Subtotal</dt><dd class="font-bold text-ink">${{ number_format($subtotal, 2) }}</dd></div>
                    <div class="flex justify-between text-sm"><dt>Shipping</dt><dd>Shown after selecting method</dd></div>
                </dl>
                <div class="mt-4 flex justify-between border-t border-berry-100 pt-4">
                    <span class="font-display text-lg font-extrabold text-ink">Total</span>
                    <span class="font-display text-lg font-extrabold text-berry-600">${{ number_format($subtotal, 2) }}+</span>
                </div>
                <button type="submit" class="btn-primary mt-5 w-full">Place Order</button>
                <a href="{{ route('cart.index') }}" class="mt-3 block text-center text-sm font-bold text-ink/50 hover:text-berry-600">← Back to cart</a>
            </div>
        </div>
    </form>
</section>
@endsection
