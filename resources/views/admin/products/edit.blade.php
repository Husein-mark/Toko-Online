@extends('layouts.admin')

@section('title', 'Edit Produk - ' . $product->name)
@section('page-title', 'Edit Produk Toko')
@section('breadcrumb', 'Edit Produk')

@push('styles')
<style>
    .form-container-card {
        max-width: 720px;
        margin: 0 auto;
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-card);
        overflow: hidden;
    }

    .form-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--white);
    }

    .form-card-title {
        font-weight: 800;
        font-size: 16px;
        color: var(--gray-900);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-card-title i { color: var(--brand-blue); }

    .form-card-body { padding: 28px 24px; }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        background: var(--gray-100);
        color: var(--gray-700);
        border: 1px solid var(--gray-200);
        border-radius: 8px;
        font-size: 12.5px;
        font-weight: 600;
        transition: var(--transition);
        text-decoration: none;
    }

    .btn-back:hover {
        background: var(--gray-200);
        color: var(--gray-900);
    }

    .image-preview-box {
        background: var(--gray-50);
        border: 1.5px dashed var(--gray-300);
        border-radius: var(--radius-lg);
        padding: 20px;
        margin-bottom: 20px;
    }

    .preview-flex {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 16px;
    }

    .preview-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid var(--white);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        background: var(--white);
    }

    .btn-save-submit {
        background: var(--brand-blue);
        color: var(--white);
        padding: 11px 24px;
        border-radius: var(--radius);
        font-size: 14px;
        font-weight: 700;
        font-family: inherit;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
        transition: var(--transition);
    }

    .btn-save-submit:hover {
        background: var(--brand-blue-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
    }
</style>
@endpush

@section('content')
    <div class="form-container-card">
        <div class="form-card-header">
            <div class="form-card-title">
                <i class="fas fa-pen-to-square"></i> Edit Produk: {{ $product->name }}
            </div>
            <a href="{{ route('admin.products.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="form-card-body">
            <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label" for="name">Nama Produk <span style="color:#ef4444;">*</span></label>
                    <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        value="{{ old('name', $product->name) }}" required>
                    @error('name')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="category">Kategori Produk <span style="color:#ef4444;">*</span></label>
                    <select id="category" name="category" class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px;">
                    <div class="form-group">
                        <label class="form-label" for="price">Harga Jual (Rp) <span style="color:#ef4444;">*</span></label>
                        <input type="number" id="price" name="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                            value="{{ old('price', (int)$product->price) }}" min="0" step="1000" required>
                        @error('price')
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="stock">Stok Barang <span style="color:#ef4444;">*</span></label>
                        <input type="number" id="stock" name="stock" class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}"
                            value="{{ old('stock', $product->stock) }}" min="0" required>
                        @error('stock')
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="description">Deskripsi Lengkap Produk</label>
                    <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                        rows="4" placeholder="Tuliskan spesifikasi, ukuran, atau keunggulan produk...">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                {{-- IMAGE SECTION --}}
                <div class="image-preview-box">
                    <label class="form-label" style="font-weight:700; color:var(--gray-900); margin-bottom:10px; display:block;">
                        <i class="fas fa-image" style="color:var(--brand-blue);"></i> Pengelolaan Foto Produk
                    </label>

                    <div class="preview-flex">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="preview-img">
                        <div style="font-size:12.5px; color:var(--gray-600);">
                            <strong style="color:var(--gray-900);">Foto Aktif Saat Ini</strong>
                            <div style="font-size:11.5px; color:var(--gray-500); word-break:break-all; margin-top:2px;">
                                {{ $product->image ?? 'Default placeholder' }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom:14px;">
                        <label class="form-label" for="image">Ganti Foto dengan Upload File (Format: JPG, PNG, WEBP. Maks 5MB)</label>
                        <input type="file" id="image" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" accept="image/*">
                        @error('image')
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-bottom:0;">
                        <label class="form-label" for="image_url">Atau Masukkan / Paste Link (URL) Gambar Web</label>
                        <input type="text" id="image_url" name="image_url" class="form-control" placeholder="https://..." value="{{ old('image_url', $product->image) }}">
                        <div style="font-size:11.5px; color:var(--gray-500); margin-top:4px;">
                            * Anda bisa copy-paste link gambar dari internet ke kolom di atas.
                        </div>
                    </div>
                </div>

                <div style="display:flex; justify-content:flex-end; gap:12px; margin-top:28px;">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-white">Batal</a>
                    <button type="submit" class="btn-save-submit">
                        <i class="fas fa-check-circle"></i> Simpan Perubahan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
