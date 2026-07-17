@extends('admin.layout')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
    {{-- Stat cards --}}
    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
        @php
            $cards = [
                ['Total Orders', $stats['orders'], '📦', 'bg-berry-100 text-berry-600', route('admin.orders.index')],
                ['Revenue', '$'.number_format($stats['revenue'], 2), '💰', 'bg-lime-100 text-lime-500', route('admin.orders.index')],
                ['New Custom Requests', $stats['custom_new'], '🎉', 'bg-grape-100 text-grape-600', route('admin.custom-orders.index')],
                ['Early List Signups', $stats['signups'], '📝', 'bg-tangerine-100 text-tangerine-600', route('admin.early-list.index')],
                ['Pending Orders', $stats['pending_orders'], '⏳', 'bg-skypop-100 text-skypop-500', route('admin.orders.index', ['status' => 'pending'])],
                ['Products', $stats['products'], '🍬', 'bg-berry-100 text-berry-600', route('admin.products.index')],
                ['Unread Messages', $stats['unread_msgs'], '💌', 'bg-grape-100 text-grape-600', route('admin.contacts.index')],
                ['Custom (all)', $stats['custom_total'], '📋', 'bg-tangerine-100 text-tangerine-600', route('admin.custom-orders.index')],
            ];
        @endphp
        @foreach ($cards as [$label, $value, $emoji, $color, $link])
            <a href="{{ $link }}" class="card flex items-center gap-4 p-5 transition hover:-translate-y-0.5">
                <span class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl {{ $color }} text-2xl">{{ $emoji }}</span>
                <span>
                    <span class="block font-display text-2xl font-extrabold text-ink">{{ $value }}</span>
                    <span class="block text-sm text-ink/60">{{ $label }}</span>
                </span>
            </a>
        @endforeach
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-2">
        {{-- Recent orders --}}
        <div class="card p-6">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="font-display text-xl font-extrabold text-ink">Recent Orders</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-sm font-bold text-berry-600 hover:underline">View all →</a>
            </div>
            @forelse ($recentOrders as $order)
                <a href="{{ route('admin.orders.show', $order) }}" class="flex items-center justify-between border-b border-berry-50 py-3 last:border-0 hover:text-berry-600">
                    <span>
                        <span class="block font-bold">{{ $order->order_number }}</span>
                        <span class="block text-sm text-ink/50">{{ $order->customer_name }} · {{ $order->created_at->diffForHumans() }}</span>
                    </span>
                    <span class="font-display font-extrabold">${{ number_format($order->total, 2) }}</span>
                </a>
            @empty
                <p class="py-6 text-center text-ink/40">No orders yet.</p>
            @endforelse
        </div>

        {{-- Recent custom + signups --}}
        <div class="space-y-6">
            <div class="card p-6">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="font-display text-xl font-extrabold text-ink">Recent Custom Requests</h2>
                    <a href="{{ route('admin.custom-orders.index') }}" class="text-sm font-bold text-berry-600 hover:underline">View all →</a>
                </div>
                @forelse ($recentCustom as $req)
                    <a href="{{ route('admin.custom-orders.show', $req) }}" class="flex items-center justify-between border-b border-berry-50 py-2.5 last:border-0 hover:text-berry-600">
                        <span class="text-sm"><span class="font-bold">{{ $req->name }}</span> · {{ $req->event_type ?: 'Event' }}</span>
                        <span class="chip bg-grape-100 text-grape-600">{{ $req->status }}</span>
                    </a>
                @empty
                    <p class="py-4 text-center text-ink/40">No requests yet.</p>
                @endforelse
            </div>

            <div class="card p-6">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="font-display text-xl font-extrabold text-ink">Recent Signups</h2>
                    <a href="{{ route('admin.early-list.index') }}" class="text-sm font-bold text-berry-600 hover:underline">View all →</a>
                </div>
                @forelse ($recentSignups as $s)
                    <div class="flex items-center justify-between border-b border-berry-50 py-2.5 last:border-0">
                        <span class="text-sm"><span class="font-bold">{{ $s->name }}</span> · {{ $s->email }}</span>
                        <span class="text-xs text-ink/40">{{ $s->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <p class="py-4 text-center text-ink/40">No signups yet.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
