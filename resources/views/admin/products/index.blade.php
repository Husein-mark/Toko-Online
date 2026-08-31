@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('page-title', 'Kelola Produk Toko')
@section('breadcrumb', 'Daftar Produk')

@section('content')
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h3 style="font-size:16px; font-weight:700; color:var(--gray-900);">Daftar Seluruh Produk</h3>
        <a href="{{ route('admin.products.create') }}" class="btn btn-brand">
            <i class="fas fa-plus"></i> Tambah Produk Baru
        </a>
    </div>

    <div class="card">
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th style="width:60px;">Gambar</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Deskripsi</th>
                        <th style="width:140px; text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width:48px; height:48px; object-fit:cover; border-radius:6px; border:1px solid var(--gray-200);">
                            </td>
                            <td>
                                <strong style="font-size:13.5px; color:var(--gray-900);">{{ $product->name }}</strong>
                            </td>
                            <td>
                                <span class="badge badge-secondary">{{ $product->category }}</span>
                            </td>
                            <td><strong style="color:var(--gray-900);">{{ $product->formatted_price }}</strong></td>
                            <td>
                                @if($product->stock === 0)
                                    <span class="badge badge-danger">Habis (0)</span>
                                @elseif($product->stock <= 5)
                                    <span class="badge badge-warning">Sisa {{ $product->stock }}</span>
                                @else
                                    <span class="badge badge-success">{{ $product->stock }} pcs</span>
                                @endif
                            </td>
                            <td style="max-width:240px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; color:var(--gray-500);">
                                {{ $product->description ?? '-' }}
                            </td>
                            <td style="text-align:center;">
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-white btn-sm" title="Edit">
                                    <i class="fas fa-edit" style="color:var(--brand-blue);"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center; padding:36px; color:var(--gray-400);">
                                Belum ada produk. Klik tombol "Tambah Produk Baru" untuk menambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top:20px;">
        {{ $products->links() }}
    </div>
@endsection
