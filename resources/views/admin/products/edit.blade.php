@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk Toko')
@section('breadcrumb', 'Edit Produk')

@section('content')
    <div style="max-width:680px; margin:0 auto;">
        <div class="card">
            <div class="card-header">
                <div class="card-title"><i class="fas fa-edit" style="color:var(--brand-blue);"></i> Edit Produk: {{ $product->name }}</div>
                <a href="{{ route('admin.products.index') }}" class="btn btn-white btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="card-body">
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
                            <label class="form-label" for="price">Harga (Rp) <span style="color:#ef4444;">*</span></label>
                            <input type="number" id="price" name="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                value="{{ old('price', (int)$product->price) }}" min="0" step="1000" required>
                            @error('price')
                                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="stock">Stok Produk <span style="color:#ef4444;">*</span></label>
                            <input type="number" id="stock" name="stock" class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}"
                                value="{{ old('stock', $product->stock) }}" min="0" required>
                            @error('stock')
                                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="description">Deskripsi Produk</label>
                        <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                            rows="4">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Foto Produk Saat Ini</label>
                        @if($product->image)
                            <div style="margin-bottom:12px; display:flex; align-items:center; gap:12px;">
                                <img src="{{ $product->image_url }}" alt="" style="width:64px; height:64px; object-fit:cover; border-radius:6px; border:1px solid var(--gray-200);">
                                <span style="font-size:12px; color:var(--gray-500);">Foto aktif</span>
                            </div>
                        @endif
                        <label class="form-label" for="image">Unggah Foto Baru (Opsional)</label>
                        <input type="file" id="image" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" accept="image/*">
                        @error('image')
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror

                        <div style="margin-top:8px;">
                            <label class="form-label" for="image_url">Atau Masukkan URL Gambar (Opsional)</label>
                            <input type="url" id="image_url" name="image_url" class="form-control" placeholder="https://..." value="{{ old('image_url', str_starts_with($product->image ?? '', 'http') ? $product->image : '') }}">
                        </div>
                    </div>

                    <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:24px;">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-white">Batal</a>
                        <button type="submit" class="btn btn-brand">
                            <i class="fas fa-save"></i> Perbarui Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
