@extends('layouts.app')

@section('title', 'Order Confirmed')

@section('content')
<section class="section py-16">
    <div class="mx-auto max-w-2xl">
        <div class="card overflow-hidden text-center">
            <div class="bg-gradient-to-r from-lime-400 to-skypop-400 py-12">
                <div class="text-7xl">🎉</div>
                <h1 class="mt-4 font-display text-4xl font-extrabold text-white">Thank you!</h1>
                <p class="mt-2 font-semibold text-white/90">Your order is in — we'll be in touch soon.</p>
            </div>

            <div class="p-8">
                <p class="text-ink/60">Order number</p>
                <p class="font-display text-2xl font-extrabold text-berry-600">{{ $order->order_number }}</p>

                <div class="mt-8 space-y-3 text-left">
                    @foreach ($order->items as $item)
                        <div class="flex justify-between gap-3 text-sm">
                            <span class="text-ink/70">{{ $item->quantity }} × {{ $item->product_name }}
                                @if ($item->product_size)<span class="text-ink/40">({{ $item->product_size }})</span>@endif
                            </span>
                            <span class="shrink-0 font-bold text-ink">${{ number_format($item->line_total, 2) }}</span>
                        </div>
                    @endforeach
                </div>

                <dl class="mt-6 space-y-2 border-t border-berry-100 pt-6 text-left text-ink/70">
                    <div class="flex justify-between"><dt>Subtotal</dt><dd class="font-bold text-ink">${{ number_format($order->subtotal, 2) }}</dd></div>
                    <div class="flex justify-between"><dt>Shipping ({{ ucfirst($order->fulfillment_method) }})</dt><dd class="font-bold text-ink">{{ $order->shipping_cost > 0 ? '$'.number_format($order->shipping_cost, 2) : 'Free' }}</dd></div>
                    <div class="flex justify-between border-t border-berry-100 pt-2">
                        <dt class="font-display text-lg font-extrabold text-ink">Total</dt>
                        <dd class="font-display text-lg font-extrabold text-berry-600">${{ number_format($order->total, 2) }}</dd>
                    </div>
                </dl>

                <p class="mt-6 rounded-2xl bg-skypop-100 px-4 py-3 text-sm text-skypop-500">
                    A confirmation was sent to <strong>{{ $order->customer_email }}</strong>. We'll reach out to arrange payment and {{ $order->fulfillment_method === 'pickup' ? 'pickup' : 'shipping' }}.
                </p>

                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('shop.index') }}" class="btn-primary">Keep Shopping</a>
                    <a href="{{ route('home') }}" class="btn-outline">Back Home</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
