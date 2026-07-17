<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderPlacedMail;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function __construct(protected CartService $cart) {}

    public function index()
    {
        if ($this->cart->isEmpty()) {
            return redirect()->route('shop.index')
                ->with('error', 'Your cart is empty — add some candy first!');
        }

        return view('pages.checkout', [
            'items'    => $this->cart->items(),
            'subtotal' => $this->cart->subtotal(),
        ]);
    }

    public function store(Request $request)
    {
        if ($this->cart->isEmpty()) {
            return redirect()->route('shop.index')
                ->with('error', 'Your cart is empty — add some candy first!');
        }

        $validated = $request->validate([
            'customer_name'      => ['required', 'string', 'max:120'],
            'customer_email'     => ['required', 'email', 'max:160'],
            'customer_phone'     => ['nullable', 'string', 'max:40'],
            'fulfillment_method' => ['required', 'in:shipping,pickup'],
            'shipping_address'   => ['required_if:fulfillment_method,shipping', 'nullable', 'string', 'max:200'],
            'shipping_city'      => ['required_if:fulfillment_method,shipping', 'nullable', 'string', 'max:100'],
            'shipping_state'     => ['required_if:fulfillment_method,shipping', 'nullable', 'string', 'max:60'],
            'shipping_zip'       => ['required_if:fulfillment_method,shipping', 'nullable', 'string', 'max:20'],
            'notes'              => ['nullable', 'string', 'max:1000'],
        ]);

        $method   = $validated['fulfillment_method'];
        $items    = $this->cart->items();
        $subtotal = $this->cart->subtotal();
        $shipping = $this->cart->shippingCost($method);
        $total    = round($subtotal + $shipping, 2);

        $order = DB::transaction(function () use ($validated, $items, $subtotal, $shipping, $total, $method) {
            $order = Order::create([
                'order_number'       => Order::generateOrderNumber(),
                'customer_name'      => $validated['customer_name'],
                'customer_email'     => $validated['customer_email'],
                'customer_phone'     => $validated['customer_phone'] ?? null,
                'shipping_address'   => $validated['shipping_address'] ?? null,
                'shipping_city'      => $validated['shipping_city'] ?? null,
                'shipping_state'     => $validated['shipping_state'] ?? null,
                'shipping_zip'       => $validated['shipping_zip'] ?? null,
                'fulfillment_method' => $method,
                'notes'              => $validated['notes'] ?? null,
                'subtotal'           => $subtotal,
                'shipping_cost'      => $shipping,
                'total'              => $total,
                'status'             => 'pending',
            ]);

            foreach ($items as $line) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $line['product']->id,
                    'product_name' => $line['product']->name,
                    'product_size' => $line['product']->size,
                    'unit_price'   => $line['product']->price,
                    'quantity'     => $line['quantity'],
                    'line_total'   => $line['line_total'],
                ]);
            }

            return $order;
        });

        $order->load('items');
        $this->notify($order);
        $this->cart->clear();

        session()->flash('order_number', $order->order_number);

        return redirect()->route('checkout.success', $order->order_number);
    }

    public function success(string $orderNumber)
    {
        $order = Order::with('items')->where('order_number', $orderNumber)->firstOrFail();

        return view('pages.checkout-success', compact('order'));
    }

    protected function notify(Order $order): void
    {
        try {
            $admin = config('mail.admin_address');
            Mail::to($admin)->send(new OrderPlacedMail($order));
            // Customer confirmation
            Mail::to($order->customer_email)->send(new OrderPlacedMail($order, forCustomer: true));
        } catch (\Throwable $e) {
            report($e);
        }
    }
}
