@extends('admin.layout')

@section('title', 'Orders')
@section('heading', 'Orders')

@section('content')
    {{-- Status filter --}}
    <div class="mb-6 flex flex-wrap gap-2">
        <a href="{{ route('admin.orders.index') }}" class="chip {{ !$current ? 'bg-berry-500 text-white' : 'bg-white text-ink/60 ring-1 ring-berry-100' }}">All</a>
        @foreach ($statuses as $status)
            <a href="{{ route('admin.orders.index', ['status' => $status]) }}"
               class="chip {{ $current === $status ? 'bg-berry-500 text-white' : 'bg-white text-ink/60 ring-1 ring-berry-100' }}">{{ ucfirst($status) }}</a>
        @endforeach
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-berry-50 text-xs uppercase tracking-wide text-ink/50">
                    <tr>
                        <th class="px-5 py-4">Order</th>
                        <th class="px-5 py-4">Customer</th>
                        <th class="px-5 py-4">Method</th>
                        <th class="px-5 py-4">Total</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-berry-50">
                    @forelse ($orders as $order)
                        <tr class="cursor-pointer hover:bg-berry-50/50" onclick="window.location='{{ route('admin.orders.show', $order) }}'">
                            <td class="px-5 py-4 font-bold text-berry-600">{{ $order->order_number }}</td>
                            <td class="px-5 py-4">
                                <span class="block font-semibold text-ink">{{ $order->customer_name }}</span>
                                <span class="block text-xs text-ink/50">{{ $order->customer_email }}</span>
                            </td>
                            <td class="px-5 py-4 text-ink/60">{{ ucfirst($order->fulfillment_method) }}</td>
                            <td class="px-5 py-4 font-bold">${{ number_format($order->total, 2) }}</td>
                            <td class="px-5 py-4"><x-status-badge :status="$order->status" /></td>
                            <td class="px-5 py-4 text-ink/50">{{ $order->created_at->format('M j, Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-5 py-10 text-center text-ink/40">No orders found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $orders->links() }}</div>
@endsection
