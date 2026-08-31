@extends('layouts.app')

@section('title', 'Katalog Produk Resmi')

@push('styles')
<style>
    /* ─── HERO BANNER ────────────────────────── */
    .hero-banner {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        padding: 40px 0 56px;
        color: var(--white);
        margin-bottom: 32px;
        border-bottom: 1px solid var(--gray-200);
    }

    .hero-inner {
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .hero-content { max-width: 640px; }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(37, 99, 235, 0.15);
        color: #60a5fa;
        border: 1px solid rgba(96, 165, 250, 0.3);
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12.5px;
        font-weight: 600;
        margin-bottom: 14px;
    }

    .hero-title {
        font-size: 30px;
        font-weight: 800;
        line-height: 1.25;
        letter-spacing: -0.5px;
        margin-bottom: 10px;
        color: var(--white);
    }

    .hero-title span { color: #60a5fa; }

    .hero-subtitle {
        font-size: 14.5px;
        color: #94a3b8;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .hero-actions { display: flex; gap: 12px; }

    /* ─── CATEGORY GRID BAR ──────────────────── */
    .category-container {
        max-width: 1240px;
        margin: -48px auto 32px;
        padding: 0 20px;
        position: relative;
        z-index: 10;
    }

    .category-grid {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        padding: 16px 20px;
        box-shadow: var(--shadow-card);
        display: flex;
        align-items: center;
        gap: 12px;
        overflow-x: auto;
    }

    .category-card {
        flex: 1;
        min-width: 120px;
        background: var(--gray-50);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius);
        padding: 12px 10px;
        text-align: center;
        color: var(--gray-700);
        transition: var(--transition);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        cursor: pointer;
    }

    .category-card:hover, .category-card.active {
        background: #eff6ff;
        border-color: var(--brand-blue);
        color: var(--brand-blue);
        transform: translateY(-2px);
    }

    .category-card i { font-size: 20px; }
    .category-card span { font-size: 12px; font-weight: 700; }

    /* ─── CATALOG SECTION ────────────────────── */
    .section-container {
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--gray-200);
        flex-wrap: wrap;
        gap: 12px;
    }

    .section-title {
        font-size: 19px;
        font-weight: 800;
        color: var(--gray-900);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i { color: var(--brand-blue); }

    .filter-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* ─── PRODUCT GRID ───────────────────────── */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
        gap: 20px;
        margin-bottom: 48px;
    }

    .product-card {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: var(--transition);
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        box-shadow: var(--shadow-hover);
        border-color: var(--gray-300);
        transform: translateY(-3px);
    }

    .product-image-box {
        position: relative;
        aspect-ratio: 1;
        background: var(--gray-100);
        overflow: hidden;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image { transform: scale(1.05); }

    .category-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(15, 23, 42, 0.75);
        backdrop-filter: blur(4px);
        color: var(--white);
        font-size: 10.5px;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 4px;
    }

    .stock-tag {
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: var(--radius-sm);
    }

    .tag-out { background: #fee2e2; color: #991b1b; }
    .tag-low { background: #fef3c7; color: #92400e; }

    .product-content {
        padding: 16px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .product-name {
        font-size: 14px;
        font-weight: 700;
        color: var(--gray-900);
        line-height: 1.4;
        margin-bottom: 6px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 40px;
    }

    .product-price {
        font-size: 17px;
        font-weight: 800;
        color: var(--brand-blue);
        margin-bottom: 4px;
    }

    .product-stock {
        font-size: 12px;
        color: var(--gray-500);
        margin-bottom: 16px;
    }

    .btn-checkout {
        margin-top: auto;
        width: 100%;
        padding: 10px;
        background: var(--brand-blue);
        color: var(--white);
        border: none;
        border-radius: var(--radius);
        font-size: 13.5px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-checkout:hover { background: var(--brand-blue-hover); }

    .btn-disabled {
        background: var(--gray-200);
        color: var(--gray-500);
        cursor: not-allowed;
        pointer-events: none;
    }

    @media (max-width: 768px) {
        .hero-title { font-size: 24px; }
        .product-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
    }
</style>
@endpush

@section('content')
    {{-- HERO BANNER --}}
    <div class="hero-banner">
        <div class="hero-inner">
            <div class="hero-content">
                <div class="hero-badge"><i class="fas fa-certificate"></i> Toko Resmi & Terpercaya</div>
                <h1 class="hero-title">Belanja Produk <span>Berkualitas & Lengkap</span> di NusaMart</h1>
                <p class="hero-subtitle">Transaksikan kebutuhan Anda dengan mudah, sistem pembayaran fleksibel (COD & Transfer), dan pengiriman langsung ke alamat Anda.</p>
                <div class="hero-actions">
                    <a href="#katalog" class="btn btn-brand btn-lg"><i class="fas fa-shopping-cart"></i> Belanja Sekarang</a>
                </div>
            </div>
        </div>
    </div>

    {{-- INTERACTIVE CATEGORIES --}}
    <div class="category-container">
        <div class="category-grid">
            <a href="{{ route('home') }}" class="category-card {{ !request('category') ? 'active' : '' }}">
                <i class="fas fa-border-all"></i>
                <span>Semua</span>
            </a>

            @foreach($categories as $cat)
                <a href="{{ route('home', ['category' => $cat['name']]) }}" class="category-card {{ request('category') == $cat['name'] ? 'active' : '' }}">
                    <i class="fas {{ $cat['icon'] }}"></i>
                    <span>{{ $cat['name'] }}</span>
                </a>
            @endforeach
        </div>
    </div>

    {{-- CATALOG SECTION --}}
    <div class="section-container" id="katalog">
        <div class="section-header">
            <div class="section-title">
                <i class="fas fa-boxes-stacked"></i>
                @if(request('category'))
                    Kategori: {{ request('category') }}
                @elseif(request('q'))
                    Hasil Pencarian: "{{ request('q') }}"
                @else
                    Semua Produk
                @endif
            </div>

            <div class="filter-info">
                @if(request('category') || request('q'))
                    <a href="{{ route('home') }}" class="btn btn-white btn-sm">
                        <i class="fas fa-xmark"></i> Hapus Filter
                    </a>
                @endif
                <span style="font-size:13px; color:var(--gray-500); font-weight:500;">
                    Menampilkan <strong>{{ $products->count() }}</strong> produk
                </span>
            </div>
        </div>

        @if($products->isEmpty())
            <div style="background:var(--white); border:1px solid var(--gray-200); border-radius:var(--radius-lg); padding:48px; text-align:center; color:var(--gray-400);">
                <i class="fas fa-folder-open" style="font-size:48px; margin-bottom:12px; color:var(--gray-300);"></i>
                <h3 style="font-size:16px; color:var(--gray-700); font-weight:700; margin-bottom:4px;">Tidak Ada Produk Ditemukan</h3>
                <p style="font-size:13.5px; margin-bottom:16px;">Tidak ada produk yang cocok dengan pencarian atau kategori yang dipilih.</p>
                <a href="{{ route('home') }}" class="btn btn-brand btn-sm">Tampilkan Semua Produk</a>
            </div>
        @else
            <div class="product-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        <div class="product-image-box">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image">
                            <span class="category-badge">{{ $product->category }}</span>

                            @if($product->stock === 0)
                                <span class="stock-tag tag-out">Stok Habis</span>
                            @elseif($product->stock <= 5)
                                <span class="stock-tag tag-low">Sisa {{ $product->stock }}</span>
                            @endif
                        </div>

                        <div class="product-content">
                            <div class="product-name" title="{{ $product->name }}">{{ $product->name }}</div>
                            <div class="product-price">{{ $product->formatted_price }}</div>
                            <div class="product-stock">
                                Stok: <strong>{{ $product->stock }}</strong> unit
                            </div>

                            @if($product->stock > 0)
                                <a href="{{ route('checkout.form', $product) }}" class="btn-checkout">
                                    <i class="fas fa-cart-shopping"></i> Checkout
                                </a>
                            @else
                                <button class="btn-checkout btn-disabled" disabled>
                                    <i class="fas fa-ban"></i> Stok Habis
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
