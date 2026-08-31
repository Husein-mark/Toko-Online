@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('page-title', 'Kelola Produk Toko')
@section('breadcrumb', 'Daftar Produk')

@push('styles')
<style>
    .product-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .page-title-box h3 {
        font-size: 20px;
        font-weight: 800;
        color: var(--gray-900);
        letter-spacing: -0.3px;
    }

    .page-title-box p {
        font-size: 13px;
        color: var(--gray-500);
        margin-top: 2px;
    }

    .btn-add-product {
        background: var(--brand-blue);
        color: var(--white);
        padding: 10px 20px;
        border-radius: var(--radius);
        font-weight: 600;
        font-size: 13.5px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
        transition: var(--transition);
        border: none;
    }

    .btn-add-product:hover {
        background: var(--brand-blue-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
        color: var(--white);
    }

    /* ─── TABLE STYLES ───────────────────────── */
    .admin-card {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-card);
        overflow: hidden;
    }

    .table-toolbar {
        padding: 16px 20px;
        background: var(--white);
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }

    .search-input-box {
        position: relative;
        flex: 1;
        max-width: 320px;
    }

    .search-input-box i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-400);
        font-size: 13px;
    }

    .search-input-box input {
        width: 100%;
        padding: 8px 12px 8px 34px;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        font-size: 13px;
        outline: none;
        transition: var(--transition);
    }

    .search-input-box input:focus {
        border-color: var(--brand-blue);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .product-thumb {
        width: 52px;
        height: 52px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid var(--gray-200);
        background: var(--gray-100);
        box-shadow: var(--shadow-subtle);
        transition: var(--transition);
    }

    .product-card-row:hover .product-thumb {
        transform: scale(1.06);
    }

    .product-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--gray-900);
        line-height: 1.3;
        margin-bottom: 3px;
    }

    .product-id-tag {
        font-size: 11px;
        color: var(--gray-400);
        font-family: monospace;
    }

    .price-text {
        font-size: 14.5px;
        font-weight: 800;
        color: var(--gray-900);
    }

    .cat-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: var(--gray-100);
        color: var(--gray-700);
        border: 1px solid var(--gray-200);
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 600;
    }

    .stock-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .stock-ok { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
    .stock-low { background: #fffbeb; color: #92400e; border: 1px solid #fde68a; }
    .stock-zero { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

    /* ─── ACTION BUTTONS REDESIGN ───────────── */
    .action-group {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-action-edit {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
        border-radius: 8px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-action-edit:hover {
        background: #2563eb;
        color: #ffffff;
        border-color: #2563eb;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        transform: translateY(-1px);
    }

    .btn-action-delete {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 12px;
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
        border-radius: 8px;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-action-delete:hover {
        background: #dc2626;
        color: #ffffff;
        border-color: #dc2626;
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
        transform: translateY(-1px);
    }

    .btn-action-edit i, .btn-action-delete i {
        font-size: 12px;
    }

    tbody tr {
        transition: background 0.15s ease;
    }

    tbody tr:hover {
        background: #f8fafc;
    }
</style>
@endpush

@section('content')
    {{-- PAGE HEADER --}}
    <div class="product-page-header">
        <div class="page-title-box">
            <h3>Daftar Seluruh Produk Toko</h3>
            <p>Kelola data produk, stok barang, harga, dan foto yang tampil di toko NusaMart.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-add-product">
            <i class="fas fa-plus"></i> Tambah Produk Baru
        </a>
    </div>

    {{-- TABLE CARD --}}
    <div class="admin-card">
        <div class="table-toolbar">
            <div class="search-input-box">
                <i class="fas fa-search"></i>
                <input type="text" id="tableFilter" placeholder="Cari nama produk..." onkeyup="filterTable()">
            </div>
            <div style="font-size:13px; color:var(--gray-500); font-weight:600;">
                Total: <strong style="color:var(--gray-900);">{{ $products->total() }}</strong> Produk
            </div>
        </div>

        <div class="table-wrapper">
            <table id="productsTable">
                <thead>
                    <tr>
                        <th style="width:70px; text-align:center;">Foto</th>
                        <th>Informasi Produk</th>
                        <th>Kategori</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th>Deskripsi Ringkas</th>
                        <th style="width:160px; text-align:center;">Aksi Pengelolaan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr class="product-card-row">
                            <td style="text-align:center;">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-thumb">
                            </td>
                            <td>
                                <div class="product-title">{{ $product->name }}</div>
                                <span class="product-id-tag">ID: #PROD-{{ $product->id }}</span>
                            </td>
                            <td>
                                <span class="cat-pill">
                                    <i class="fas fa-tag" style="font-size:10px; opacity:0.7;"></i>
                                    {{ $product->category }}
                                </span>
                            </td>
                            <td>
                                <div class="price-text">{{ $product->formatted_price }}</div>
                            </td>
                            <td>
                                @if($product->stock === 0)
                                    <span class="stock-badge stock-zero">
                                        <i class="fas fa-circle" style="font-size:6px;"></i> Habis (0)
                                    </span>
                                @elseif($product->stock <= 5)
                                    <span class="stock-badge stock-low">
                                        <i class="fas fa-circle" style="font-size:6px;"></i> Sisa {{ $product->stock }}
                                    </span>
                                @else
                                    <span class="stock-badge stock-ok">
                                        <i class="fas fa-circle" style="font-size:6px;"></i> {{ $product->stock }} unit
                                    </span>
                                @endif
                            </td>
                            <td style="max-width:240px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; color:var(--gray-500);">
                                {{ $product->description ?? 'Tidak ada deskripsi.' }}
                            </td>
                            <td style="text-align:center;">
                                <div class="action-group">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn-action-edit" title="Edit Produk">
                                        <i class="fas fa-pen-to-square"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-delete" title="Hapus Produk">
                                            <i class="fas fa-trash-can"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center; padding:48px; color:var(--gray-400);">
                                <i class="fas fa-box-open" style="font-size:40px; margin-bottom:10px; color:var(--gray-300); display:block;"></i>
                                <div style="font-weight:700; color:var(--gray-700); font-size:15px;">Belum Ada Produk</div>
                                <p style="font-size:13px; margin-top:4px;">Klik tombol "Tambah Produk Baru" untuk mulai memasukkan produk.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top:24px;">
        {{ $products->links() }}
    </div>
@endsection

@push('scripts')
<script>
    function filterTable() {
        const input = document.getElementById('tableFilter');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('productsTable');
        const tr = table.getElementsByTagName('tr');

        for (let i = 1; i < tr.length; i++) {
            const tdName = tr[i].getElementsByTagName('td')[1];
            if (tdName) {
                const txtValue = tdName.textContent || tdName.innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    }
</script>
@endpush
