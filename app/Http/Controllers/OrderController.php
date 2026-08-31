<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    // Form checkout - GET /checkout/{product}
    public function checkout(Product $product)
    {
        if ($product->stock <= 0) {
            return redirect()->route('home')
                ->with('error', 'Maaf, produk ini sudah habis stoknya.');
        }

        return view('checkout.form', compact('product'));
    }

    // Proses simpan pesanan - POST /checkout/{product}
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity'         => ['required', 'integer', 'min:1', 'max:' . $product->stock],
            'payment_method'   => ['required', 'in:cod,transfer'],
            'shipping_address' => ['required', 'string', 'max:500'],
            'notes'            => ['nullable', 'string', 'max:255'],
            'payment_proof'    => ['nullable', 'required_if:payment_method,transfer', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ], [
            'quantity.required'           => 'Jumlah pembelian wajib diisi.',
            'quantity.min'                => 'Jumlah minimal 1.',
            'quantity.max'                => 'Jumlah melebihi stok yang tersedia (' . $product->stock . ').',
            'payment_method.required'     => 'Metode pembayaran wajib dipilih.',
            'shipping_address.required'   => 'Alamat pengiriman wajib diisi.',
            'payment_proof.required_if'   => 'Bukti transfer wajib diunggah untuk metode transfer.',
            'payment_proof.image'         => 'Bukti transfer harus berupa gambar.',
            'payment_proof.max'           => 'Ukuran gambar maksimal 2MB.',
        ]);

        $totalPrice = $product->price * $validated['quantity'];

        $proofPath = null;
        if ($request->hasFile('payment_proof')) {
            $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        // Kurangi stok
        $product->decrement('stock', $validated['quantity']);

        $order = Order::create([
            'user_id'          => Auth::id(),
            'product_id'       => $product->id,
            'quantity'         => $validated['quantity'],
            'total_price'      => $totalPrice,
            'payment_method'   => $validated['payment_method'],
            'payment_proof'    => $proofPath,
            'status'           => 'menunggu_pembayaran',
            'shipping_address' => $validated['shipping_address'],
            'notes'            => $validated['notes'] ?? null,
        ]);

        return redirect()->route('orders.my')
            ->with('success', 'Pesanan berhasil dibuat! Nomor pesanan: #' . $order->id);
    }

    // Halaman pesanan saya - GET /pesanan-saya
    public function myOrders()
    {
        $orders = Auth::user()
            ->orders()
            ->with('product')
            ->latest()
            ->paginate(10);

        return view('orders.my-orders', compact('orders'));
    }
}
