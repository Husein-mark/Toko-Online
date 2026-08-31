@extends('layouts.admin')

@section('title', 'Kelola Pesanan Masuk')
@section('page-title', 'Daftar Pesanan Masuk')
@section('breadcrumb', 'Pesanan Masuk')

@section('content')
    {{-- FILTER BAR --}}
    <div class="card" style="margin-bottom:20px; padding:16px;">
        <form method="GET" action="{{ route('admin.orders.index') }}" style="display:flex; gap:12px; flex-wrap:wrap; align-items:center;">
            <div style="flex:1; min-width:200px;">
                <input type="text" name="search" class="form-control" placeholder="Cari nama pembeli atau email..." value="{{ request('search') }}">
            </div>
            <div style="width:200px;">
                <select name="status" class="form-control">
                    <option value="">-- Semua Status --</option>
                    @foreach($statusOptions as $key => $label)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-brand"><i class="fas fa-filter"></i> Filter</button>
            @if(request()->hasAny(['search', 'status']))
                <a href="{{ route('admin.orders.index') }}" class="btn btn-white"><i class="fas fa-undo"></i> Reset</a>
            @endif
        </form>
    </div>

    {{-- ORDERS TABLE --}}
    <div class="card">
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Identitas Pembeli</th>
                        <th>Produk</th>
                        <th>Total & Metode</th>
                        <th>Alamat Pengiriman</th>
                        <th>Bukti Transfer</th>
                        <th>Status Pengiriman</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>
                                <strong>#{{ $order->id }}</strong><br>
                                <span style="font-size:11px; color:var(--gray-500);">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                            </td>

                            <td>
                                <div style="font-weight:700; color:var(--gray-900);">{{ $order->user->name ?? 'Guest' }}</div>
                                <div style="font-size:11.5px; color:var(--gray-600);"><i class="fas fa-envelope"></i> {{ $order->user->email ?? '-' }}</div>
                                <div style="font-size:11.5px; color:var(--gray-600);"><i class="fas fa-phone"></i> {{ $order->user->phone ?? '-' }}</div>
                            </td>

                            <td>
                                <div style="font-weight:600;">{{ $order->product->name ?? 'Produk Dihapus' }}</div>
                                <div style="font-size:12px; color:var(--gray-500);">Qty: {{ $order->quantity }} pcs</div>
                            </td>

                            <td>
                                <strong style="color:var(--gray-900); font-size:14px;">{{ $order->formatted_total }}</strong><br>
                                <span class="badge badge-secondary" style="margin-top:4px;">{{ strtoupper($order->payment_method) }}</span>
                            </td>

                            <td style="max-width:220px; font-size:12px;">
                                <i class="fas fa-map-marker-alt" style="color:var(--brand-blue);"></i> {{ $order->shipping_address }}
                                @if($order->notes)
                                    <div style="font-style:italic; color:var(--gray-500); margin-top:2px;">Catatan: "{{ $order->notes }}"</div>
                                @endif
                            </td>

                            <td>
                                @if($order->payment_proof)
                                    <a href="{{ Storage::url($order->payment_proof) }}" target="_blank" class="btn btn-white btn-sm" style="color:var(--brand-blue);">
                                        <i class="fas fa-image"></i> Lihat Bukti
                                    </a>
                                @elseif($order->payment_method == 'transfer')
                                    <span style="font-size:11px; color:#ef4444;"><i class="fas fa-exclamation-triangle"></i> Belum ada</span>
                                @else
                                    <span style="font-size:11px; color:var(--gray-400);">- COD -</span>
                                @endif
                            </td>

                            <td>
                                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}" style="display:flex; gap:6px; flex-direction:column;">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-control" style="font-size:12px; padding:6px 8px; border-radius:6px; font-weight:600;" onchange="this.form.submit()">
                                        @foreach($statusOptions as $key => $label)
                                            <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                                <div style="margin-top:4px;">
                                    <span class="badge badge-{{ $order->status_color }}">
                                        {{ $order->status_label }}
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center; padding:36px; color:var(--gray-400);">
                                Belum ada pesanan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top:20px;">
        {{ $orders->links() }}
    </div>
@endsection
