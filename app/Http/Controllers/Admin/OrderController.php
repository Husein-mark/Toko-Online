<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Daftar semua pesanan
    public function index(Request $request)
    {
        $query = Order::with(['user', 'product'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $orders = $query->paginate(15);

        $statusOptions = [
            'menunggu_pembayaran' => 'Menunggu Pembayaran',
            'diproses'            => 'Diproses',
            'dikirim'             => 'Dikirim',
            'selesai'             => 'Selesai',
            'dibatalkan'          => 'Dibatalkan',
        ];

        return view('admin.orders.index', compact('orders', 'statusOptions'));
    }

    // Update status pesanan
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:menunggu_pembayaran,diproses,dikirim,selesai,dibatalkan'],
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->back()
            ->with('success', 'Status pesanan #' . $order->id . ' berhasil diperbarui.');
    }
}
