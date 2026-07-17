<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\CustomOrderRequest;
use App\Models\EarlyListSignup;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'orders'         => Order::count(),
            'revenue'        => Order::whereIn('status', ['paid', 'processing', 'completed'])->sum('total'),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'products'       => Product::count(),
            'custom_new'     => CustomOrderRequest::where('status', 'new')->count(),
            'custom_total'   => CustomOrderRequest::count(),
            'signups'        => EarlyListSignup::count(),
            'unread_msgs'    => ContactMessage::where('is_read', false)->count(),
        ];

        $recentOrders  = Order::latest()->take(5)->get();
        $recentCustom  = CustomOrderRequest::latest()->take(5)->get();
        $recentSignups = EarlyListSignup::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'recentCustom', 'recentSignups'));
    }
}
