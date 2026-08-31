@extends('layouts.admin')

@section('title', 'Dashboard Administrator')
@section('page-title', 'Dashboard Administrator')
@section('breadcrumb', 'Ringkasan Sistem')

@section('content')
    {{-- STATS GRID --}}
    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap:20px; margin-bottom:28px;">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-box-open"></i></div>
            <div>
                <div class="stat-value">{{ $stats['total_products'] }}</div>
                <div class="stat-label">Total Produk Toko</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon purple"><i class="fas fa-shopping-bag"></i></div>
            <div>
                <div class="stat-value">{{ $stats['total_orders'] }}</div>
                <div class="stat-label">Total Pesanan</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon orange"><i class="fas fa-clock"></i></div>
            <div>
                <div class="stat-value">{{ $stats['pending_orders'] }}</div>
                <div class="stat-label">Menunggu Pembayaran</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-users"></i></div>
            <div>
                <div class="stat-value">{{ $stats['total_buyers'] }}</div>
                <div class="stat-label">Total Pembeli Terdaftar</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green"><i class="fas fa-wallet"></i></div>
            <div>
                <div class="stat-value">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</div>
                <div class="stat-label">Total Omset Pendapatan</div>
            </div>
        </div>
    </div>

    {{-- RECENT ORDERS TABLE --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title"><i class="fas fa-list" style="color:var(--brand-blue);"></i> Pesanan Masuk Terbaru</div>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-white btn-sm">Lihat Semua Pesanan</a>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pembeli</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        <tr>
                            <td><strong>#{{ $order->id }}</strong></td>
                            <td>
                                <div style="font-weight:600;">{{ $order->user->name ?? '-' }}</div>
                                <div style="font-size:11.5px; color:var(--gray-500);">{{ $order->user->email ?? '-' }}</div>
                            </td>
                            <td>{{ $order->product->name ?? '-' }}</td>
                            <td>{{ $order->quantity }} pcs</td>
                            <td><strong>{{ $order->formatted_total }}</strong></td>
                            <td><span class="badge badge-secondary">{{ strtoupper($order->payment_method) }}</span></td>
                            <td><span class="badge badge-{{ $order->status_color }}">{{ $order->status_label }}</span></td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align:center; padding:32px; color:var(--gray-400);">Belum ada pesanan masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
