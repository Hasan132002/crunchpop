@extends('admin.layout')

@section('title', 'Order '.$order->order_number)
@section('heading', 'Order '.$order->order_number)

@section('actions')
    <a href="{{ route('admin.orders.index') }}" class="btn-ghost !py-2.5 text-sm text-ink/50">← Back to orders</a>
@endsection

@section('content')
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-2">
            <div class="card p-6">
                <h2 class="mb-4 font-display text-lg font-extrabold text-ink">Items</h2>
                <table class="w-full text-left text-sm">
                    <tbody class="divide-y divide-berry-50">
                        @foreach ($order->items as $item)
                            <tr>
                                <td class="py-3">
                                    <span class="block font-bold text-ink">{{ $item->product_name }}</span>
                                    @if ($item->product_size)<span class="text-xs text-ink/50">{{ $item->product_size }}</span>@endif
                                </td>
                                <td class="py-3 text-center text-ink/60">{{ $item->quantity }} × ${{ number_format($item->unit_price, 2) }}</td>
                                <td class="py-3 text-right font-bold">${{ number_format($item->line_total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="border-t-2 border-berry-100">
                        <tr><td colspan="2" class="py-2 text-right text-ink/60">Subtotal</td><td class="py-2 text-right font-bold">${{ number_format($order->subtotal, 2) }}</td></tr>
                        <tr><td colspan="2" class="py-1 text-right text-ink/60">Shipping</td><td class="py-1 text-right font-bold">{{ $order->shipping_cost > 0 ? '$'.number_format($order->shipping_cost, 2) : 'Free' }}</td></tr>
                        <tr><td colspan="2" class="py-2 text-right font-display text-lg font-extrabold">Total</td><td class="py-2 text-right font-display text-lg font-extrabold text-berry-600">${{ number_format($order->total, 2) }}</td></tr>
                    </tfoot>
                </table>
            </div>

            @if ($order->notes)
                <div class="card p-6">
                    <h2 class="mb-2 font-display text-lg font-extrabold text-ink">Order Notes</h2>
                    <p class="whitespace-pre-line text-ink/70">{{ $order->notes }}</p>
                </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="card p-6">
                <h2 class="mb-4 font-display text-lg font-extrabold text-ink">Status</h2>
                <div class="mb-4"><x-status-badge :status="$order->status" /></div>
                <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="flex gap-2">
                    @csrf @method('PATCH')
                    <select name="status" class="form-select">
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <button class="btn-primary shrink-0 !px-4 !py-2.5 text-sm">Save</button>
                </form>
            </div>

            <div class="card p-6">
                <h2 class="mb-4 font-display text-lg font-extrabold text-ink">Customer</h2>
                <dl class="space-y-2 text-sm">
                    <div><dt class="text-ink/50">Name</dt><dd class="font-semibold">{{ $order->customer_name }}</dd></div>
                    <div><dt class="text-ink/50">Email</dt><dd class="font-semibold"><a href="mailto:{{ $order->customer_email }}" class="text-berry-600 hover:underline">{{ $order->customer_email }}</a></dd></div>
                    @if ($order->customer_phone)<div><dt class="text-ink/50">Phone</dt><dd class="font-semibold">{{ $order->customer_phone }}</dd></div>@endif
                    <div><dt class="text-ink/50">Method</dt><dd class="font-semibold">{{ ucfirst($order->fulfillment_method) }}</dd></div>
                    @if ($order->fulfillment_method === 'shipping')
                        <div><dt class="text-ink/50">Ship to</dt>
                            <dd class="font-semibold">{{ $order->shipping_address }}<br>{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}</dd>
                        </div>
                    @endif
                    <div><dt class="text-ink/50">Placed</dt><dd class="font-semibold">{{ $order->created_at->format('M j, Y g:i A') }}</dd></div>
                </dl>
            </div>

            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Delete this order permanently?')">
                @csrf @method('DELETE')
                <button class="btn-ghost w-full text-berry-600 hover:bg-berry-50">Delete order</button>
            </form>
        </div>
    </div>
@endsection
