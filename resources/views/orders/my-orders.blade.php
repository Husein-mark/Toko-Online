@extends('layouts.app')

@section('title', 'Pesanan Saya')

@push('styles')
<style>
    .orders-container {
        max-width: 1040px;
        margin: 32px auto;
        padding: 0 20px;
    }

    .order-card {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-card);
        padding: 20px 24px;
        margin-bottom: 16px;
        transition: var(--transition);
    }

    .order-card:hover {
        box-shadow: var(--shadow-hover);
        border-color: var(--gray-300);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--gray-200);
        margin-bottom: 16px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .order-id {
        font-weight: 700;
        font-size: 14px;
        color: var(--gray-900);
    }

    .order-date {
        font-size: 12.5px;
        color: var(--gray-500);
    }

    .order-body {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .order-img {
        width: 72px;
        height: 72px;
        border-radius: var(--radius);
        object-fit: cover;
        background: var(--gray-100);
        border: 1px solid var(--gray-200);
        flex-shrink: 0;
    }

    .order-details { flex: 1; }

    .order-product-name {
        font-weight: 700;
        font-size: 15px;
        color: var(--gray-900);
        margin-bottom: 6px;
    }

    .order-meta {
        font-size: 12.5px;
        color: var(--gray-600);
        display: flex;
        gap: 16px;
        margin-bottom: 8px;
    }

    .order-address {
        font-size: 12.5px;
        color: var(--gray-600);
        background: var(--gray-50);
        padding: 8px 12px;
        border-radius: var(--radius-sm);
        border: 1px solid var(--gray-200);
    }

    .order-total-box {
        text-align: right;
        flex-shrink: 0;
    }

    .order-total-label { font-size: 12px; color: var(--gray-500); }
    .order-total-value { font-size: 17px; font-weight: 800; color: var(--gray-900); }

    .empty-orders {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        padding: 60px 20px;
        text-align: center;
        color: var(--gray-400);
    }

    .empty-orders i { font-size: 56px; margin-bottom: 16px; color: var(--gray-300); }
</style>
@endpush

@section('content')
<div class="orders-container">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <h2 style="font-size:22px; font-weight:800; color:var(--gray-900); display:flex; align-items:center; gap:10px;">
            <i class="fas fa-box-open" style="color:var(--brand-blue);"></i> Riwayat Pesanan Saya
        </h2>
        <a href="{{ route('home') }}" class="btn btn-outline btn-sm">
            <i class="fas fa-plus"></i> Belanja Produk Lain
        </a>
    </div>

    @if($orders->isEmpty())
        <div class="empty-orders">
            <i class="fas fa-shopping-bag"></i>
            <h3 style="font-size:17px; font-weight:700; color:var(--gray-700); margin-bottom:6px;">Belum Ada Riwayat Pesanan</h3>
            <p style="font-size:13.5px; margin-bottom:20px;">Anda belum melakukan pemesanan produk apa pun di NusaMart.</p>
            <a href="{{ route('home') }}" class="btn btn-brand">
                <i class="fas fa-store"></i> Eksplor Katalog NusaMart
            </a>
        </div>
    @else
        @foreach($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <span class="order-id">Pesanan #{{ $order->id }}</span>
                        <span class="order-date">&bull; {{ $order->created_at->format('d M Y, H:i') }} WIB</span>
                    </div>
                    <div>
                        <span class="badge badge-{{ $order->status_color }}">
                            <i class="fas fa-circle" style="font-size:7px;"></i> {{ $order->status_label }}
                        </span>
                    </div>
                </div>

                <div class="order-body">
                    @if($order->product && $order->product->image)
                        <img src="{{ Storage::url($order->product->image) }}" alt="{{ $order->product->name }}" class="order-img">
                    @else
                        <div class="order-img" style="display:flex;align-items:center;justify-content:center;color:var(--gray-400);font-size:24px;">
                            <i class="fas fa-image"></i>
                        </div>
                    @endif

                    <div class="order-details">
                        <div class="order-product-name">{{ $order->product->name ?? 'Produk Tidak Ditemukan' }}</div>

                        <div class="order-meta">
                            <span><i class="fas fa-layer-group"></i> {{ $order->quantity }} unit</span>
                            <span><i class="fas fa-credit-card"></i> Metode: {{ strtoupper($order->payment_method) }}</span>
                        </div>

                        <div class="order-address">
                            <i class="fas fa-location-dot" style="color:var(--brand-blue);"></i> <strong>Alamat Tujuan:</strong> {{ $order->shipping_address }}
                        </div>
                    </div>

                    <div class="order-total-box">
                        <div class="order-total-label">Total Belanja</div>
                        <div class="order-total-value">{{ $order->formatted_total }}</div>
                    </div>
                </div>
            </div>
        @endforeach

        <div style="margin-top:20px;">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
