<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products'  => Product::count(),
            'total_orders'    => Order::count(),
            'total_buyers'    => User::where('role', 'pembeli')->count(),
            'pending_orders'  => Order::where('status', 'menunggu_pembayaran')->count(),
            'revenue'         => Order::where('status', '!=', 'dibatalkan')->sum('total_price'),
        ];

        $recentOrders = Order::with(['user', 'product'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
