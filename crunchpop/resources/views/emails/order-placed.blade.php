@php $heading = $forCustomer ? 'Thanks for your order!' : 'New order received'; @endphp
<x-emails.layout :heading="$heading" accent="#ff2d7e">
    @if ($forCustomer)
        <p style="margin:0 0 16px;">Hi {{ $order->customer_name }}, we got your order and we're on it! Here's a summary:</p>
    @else
        <p style="margin:0 0 16px;">A new order just came in through the website.</p>
    @endif

    <p style="font-size:16px;font-weight:800;color:#ed1168;margin:0 0 16px;">Order {{ $order->order_number }}</p>

    <table style="width:100%;border-collapse:collapse;margin-bottom:16px;">
        @foreach ($order->items as $item)
            <tr>
                <td style="padding:8px 0;border-bottom:1px solid #ffe0ec;font-size:14px;">
                    {{ $item->quantity }} × {{ $item->product_name }}
                    @if($item->product_size)<span style="color:#9b8fa3;">({{ $item->product_size }})</span>@endif
                </td>
                <td style="padding:8px 0;border-bottom:1px solid #ffe0ec;text-align:right;font-weight:700;font-size:14px;">${{ number_format($item->line_total, 2) }}</td>
            </tr>
        @endforeach
        <tr><td style="padding:8px 0;color:#9b8fa3;">Subtotal</td><td style="padding:8px 0;text-align:right;">${{ number_format($order->subtotal, 2) }}</td></tr>
        <tr><td style="padding:4px 0;color:#9b8fa3;">Shipping ({{ ucfirst($order->fulfillment_method) }})</td><td style="padding:4px 0;text-align:right;">{{ $order->shipping_cost > 0 ? '$'.number_format($order->shipping_cost, 2) : 'Free' }}</td></tr>
        <tr><td style="padding:8px 0;font-weight:800;font-size:16px;">Total</td><td style="padding:8px 0;text-align:right;font-weight:800;font-size:16px;color:#ed1168;">${{ number_format($order->total, 2) }}</td></tr>
    </table>

    <div style="background:#fff1f6;border-radius:14px;padding:16px;">
        <table style="width:100%;border-collapse:collapse;">
            <x-emails.partials.row label="Customer" :value="$order->customer_name" />
            <x-emails.partials.row label="Email" :value="$order->customer_email" />
            <x-emails.partials.row label="Phone" :value="$order->customer_phone" />
            <x-emails.partials.row label="Method" :value="ucfirst($order->fulfillment_method)" />
            @if ($order->fulfillment_method === 'shipping')
                <x-emails.partials.row label="Address" :value="trim($order->shipping_address.', '.$order->shipping_city.', '.$order->shipping_state.' '.$order->shipping_zip, ', ')" />
            @endif
            <x-emails.partials.row label="Notes" :value="$order->notes" />
        </table>
    </div>

    @if ($forCustomer)
        <p style="margin:16px 0 0;color:#6b5f73;font-size:14px;">We'll reach out shortly to arrange payment and {{ $order->fulfillment_method === 'pickup' ? 'pickup' : 'delivery' }}. Thanks for supporting the mission! 🌴</p>
    @endif
</x-emails.layout>
