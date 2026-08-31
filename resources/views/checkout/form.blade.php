@extends('layouts.app')

@section('title', 'Checkout Produk - ' . $product->name)

@push('styles')
<style>
    .checkout-container {
        max-width: 1040px;
        margin: 32px auto;
        padding: 0 20px;
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 24px;
    }

    .checkout-card {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-card);
        padding: 24px;
        margin-bottom: 20px;
    }

    .card-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--gray-200);
    }

    .card-title i { color: var(--brand-blue); }

    .product-summary {
        display: flex;
        gap: 16px;
        align-items: center;
    }

    .product-img {
        width: 80px;
        height: 80px;
        border-radius: var(--radius);
        object-fit: cover;
        background: var(--gray-100);
        border: 1px solid var(--gray-200);
        flex-shrink: 0;
    }

    .product-details { flex: 1; }

    .product-name {
        font-size: 15px;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 4px;
    }

    .product-price {
        font-size: 16px;
        font-weight: 800;
        color: var(--gray-900);
    }

    .quantity-control {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 12px;
    }

    .btn-qty {
        width: 32px;
        height: 32px;
        border: 1px solid var(--gray-300);
        background: var(--white);
        border-radius: var(--radius-sm);
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
    }

    .btn-qty:hover { background: var(--gray-100); }

    .input-qty {
        width: 48px;
        height: 32px;
        text-align: center;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius-sm);
        font-weight: 700;
    }

    .form-group { margin-bottom: 16px; }
    .form-label { display: block; font-weight: 600; font-size: 13px; color: var(--gray-700); margin-bottom: 6px; }

    .form-control {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius);
        font-size: 13.5px;
        font-family: inherit;
        color: var(--gray-900);
        background: var(--white);
        outline: none;
        transition: var(--transition);
    }

    .form-control:focus { border-color: var(--brand-blue); box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); }
    .form-error { font-size: 12px; color: #ef4444; margin-top: 4px; }

    .payment-option {
        border: 1.5px solid var(--gray-200);
        border-radius: var(--radius);
        padding: 14px 16px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .payment-option:hover { border-color: var(--brand-blue); background: var(--gray-50); }

    .payment-option.active {
        border-color: var(--brand-blue);
        background: #f0f7ff;
    }

    .payment-option input[type="radio"] {
        margin-top: 3px;
        accent-color: var(--brand-blue);
    }

    .payment-info { flex: 1; }
    .payment-name { font-weight: 700; font-size: 14px; color: var(--gray-900); }
    .payment-desc { font-size: 12.5px; color: var(--gray-500); margin-top: 2px; }

    .transfer-box {
        background: var(--gray-50);
        border: 1px dashed var(--gray-300);
        border-radius: var(--radius);
        padding: 16px;
        margin-top: 12px;
        display: none;
    }

    .bank-account {
        background: var(--white);
        padding: 10px 14px;
        border-radius: var(--radius-sm);
        border: 1px solid var(--gray-200);
        margin-bottom: 12px;
        font-size: 13px;
        color: var(--gray-700);
    }

    .order-summary-box {
        position: sticky;
        top: 90px;
    }

    .summary-line {
        display: flex;
        justify-content: space-between;
        font-size: 13.5px;
        margin-bottom: 12px;
        color: var(--gray-600);
    }

    .summary-line.total {
        border-top: 1px solid var(--gray-200);
        padding-top: 14px;
        margin-top: 14px;
        font-size: 16px;
        font-weight: 800;
        color: var(--gray-900);
    }

    .btn-submit-order {
        width: 100%;
        padding: 12px;
        background: var(--brand-blue);
        color: var(--white);
        border: none;
        border-radius: var(--radius);
        font-size: 14.5px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        margin-top: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-submit-order:hover { background: var(--brand-blue-hover); }

    @media (max-width: 768px) {
        .checkout-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="checkout-container">
    <h2 style="font-size:22px; font-weight:800; margin-bottom:24px; color:var(--gray-900); display:flex; align-items:center; gap:10px;">
        <i class="fas fa-shopping-bag" style="color:var(--brand-blue);"></i> Formulir Checkout Pesanan
    </h2>

    <form method="POST" action="{{ route('checkout.store', $product) }}" enctype="multipart/form-data">
        @csrf
        <div class="checkout-grid">

            <div class="checkout-left">
                {{-- Detail Produk --}}
                <div class="checkout-card">
                    <div class="card-title">
                        <i class="fas fa-box"></i> Detail Produk yang Dibeli
                    </div>
                    <div class="product-summary">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="product-img">
                        @else
                            <div class="product-img" style="display:flex;align-items:center;justify-content:center;color:var(--gray-400);font-size:24px;">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                        <div class="product-details">
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-price" id="unit-price" data-price="{{ $product->price }}">{{ $product->formatted_price }}</div>
                            <div style="font-size:12px; color:var(--gray-500); margin-top:2px;">Stok tersedia: {{ $product->stock }} unit</div>

                            <div class="quantity-control">
                                <span style="font-size:13px; font-weight:600; color:var(--gray-700);">Jumlah Pembelian:</span>
                                <button type="button" class="btn-qty" onclick="changeQty(-1)">-</button>
                                <input type="number" name="quantity" id="quantity" class="input-qty" value="1" min="1" max="{{ $product->stock }}" readonly>
                                <button type="button" class="btn-qty" onclick="changeQty(1)">+</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Informasi Alamat Pengiriman --}}
                <div class="checkout-card">
                    <div class="card-title">
                        <i class="fas fa-truck"></i> Alamat Pengiriman Sampai Alamat Tujuan
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="shipping_address">Alamat Pengiriman Lengkap <span style="color:#ef4444;">*</span></label>
                        <textarea id="shipping_address" name="shipping_address" class="form-control {{ $errors->has('shipping_address') ? 'is-invalid' : '' }}"
                            rows="3" placeholder="Masukkan alamat penerima (Nama Jalan, No. Rumah, RT/RW, Kelurahan, Kecamatan, Kota/Kabupaten, Kode Pos)" required>{{ old('shipping_address', auth()->user()->address) }}</textarea>
                        @error('shipping_address')
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" for="notes">Catatan Tambahan untuk Penjual (Opsional)</label>
                        <input type="text" id="notes" name="notes" class="form-control" placeholder="Contoh: Titipkan di satpam jika rumah kosong" value="{{ old('notes') }}">
                    </div>
                </div>

                {{-- Metode Pembayaran --}}
                <div class="checkout-card">
                    <div class="card-title">
                        <i class="fas fa-wallet"></i> Metode Pembayaran
                    </div>

                    <label class="payment-option {{ old('payment_method', 'cod') == 'cod' ? 'active' : '' }}" onclick="selectPayment('cod')">
                        <input type="radio" name="payment_method" value="cod" id="pay-cod" {{ old('payment_method', 'cod') == 'cod' ? 'checked' : '' }}>
                        <div class="payment-info">
                            <div class="payment-name"><i class="fas fa-hand-holding-dollar" style="color:var(--brand-blue);"></i> COD (Cash On Delivery)</div>
                            <div class="payment-desc">Bayar tunai kepada kurir saat barang sampai di lokasi alamat Anda.</div>
                        </div>
                    </label>

                    <label class="payment-option {{ old('payment_method') == 'transfer' ? 'active' : '' }}" onclick="selectPayment('transfer')">
                        <input type="radio" name="payment_method" value="transfer" id="pay-transfer" {{ old('payment_method') == 'transfer' ? 'checked' : '' }}>
                        <div class="payment-info">
                            <div class="payment-name"><i class="fas fa-building-columns" style="color:var(--brand-blue);"></i> Transfer Bank Rekening Bersama</div>
                            <div class="payment-desc">Transfer manual ke rekening resmi toko dan sertakan bukti transfer.</div>
                        </div>
                    </label>

                    {{-- Upload Bukti Transfer --}}
                    <div class="transfer-box" id="transfer-details" style="{{ old('payment_method') == 'transfer' ? 'display:block;' : 'display:none;' }}">
                        <div style="font-weight:700; font-size:13px; color:var(--gray-900); margin-bottom:8px;">
                            Rekening Pembayaran NusaMart:
                        </div>
                        <div class="bank-account">
                            <strong>Bank BCA:</strong> 123-456-7890 a.n. PT NusaMart Indonesia<br>
                            <strong>Bank Mandiri:</strong> 987-654-3210 a.n. PT NusaMart Indonesia
                        </div>

                        <div class="form-group" style="margin-bottom:0;">
                            <label class="form-label" for="payment_proof">Unggah Bukti Pembayaran Transfer <span style="color:#ef4444;">*</span></label>
                            <input type="file" id="payment_proof" name="payment_proof" class="form-control {{ $errors->has('payment_proof') ? 'is-invalid' : '' }}" accept="image/*">
                            @error('payment_proof')
                                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Ringkasan Belanja Sidebar --}}
            <div class="checkout-right">
                <div class="checkout-card order-summary-box">
                    <div class="card-title">
                        <i class="fas fa-receipt"></i> Ringkasan Transaksi
                    </div>

                    <div class="summary-line">
                        <span>Harga Satuan</span>
                        <span id="subtotal-display">{{ $product->formatted_price }}</span>
                    </div>

                    <div class="summary-line">
                        <span>Jumlah Barang</span>
                        <span id="qty-display">1 unit</span>
                    </div>

                    <div class="summary-line">
                        <span>Biaya Pengiriman</span>
                        <span style="color:var(--brand-blue); font-weight:700;">Gratis Ongkir</span>
                    </div>

                    <div class="summary-line total">
                        <span>Total Pembayaran</span>
                        <span id="total-display" style="color:var(--gray-900);">{{ $product->formatted_price }}</span>
                    </div>

                    <button type="submit" class="btn-submit-order">
                        <i class="fas fa-check-circle"></i> Konfirmasi & Buat Pesanan
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    const basePrice = {{ $product->price }};
    const maxStock = {{ $product->stock }};

    function changeQty(amount) {
        const qtyInput = document.getElementById('quantity');
        let currentQty = parseInt(qtyInput.value) || 1;
        currentQty += amount;

        if (currentQty < 1) currentQty = 1;
        if (currentQty > maxStock) currentQty = maxStock;

        qtyInput.value = currentQty;
        updateTotals(currentQty);
    }

    function updateTotals(qty) {
        const total = basePrice * qty;
        const formatted = 'Rp ' + total.toLocaleString('id-ID');
        document.getElementById('qty-display').innerText = qty + ' unit';
        document.getElementById('subtotal-display').innerText = formatted;
        document.getElementById('total-display').innerText = formatted;
    }

    function selectPayment(method) {
        document.querySelectorAll('.payment-option').forEach(el => el.classList.remove('active'));
        const radio = document.getElementById('pay-' + method);
        radio.checked = true;
        radio.closest('.payment-option').classList.add('active');

        const transferBox = document.getElementById('transfer-details');
        const proofInput = document.getElementById('payment_proof');

        if (method === 'transfer') {
            transferBox.style.display = 'block';
            proofInput.required = true;
        } else {
            transferBox.style.display = 'none';
            proofInput.required = false;
        }
    }
</script>
@endpush
