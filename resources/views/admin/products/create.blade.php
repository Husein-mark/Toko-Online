@extends('layouts.admin')

@section('title', 'Tambah Produk Baru')
@section('page-title', 'Tambah Produk Baru')
@section('breadcrumb', 'Tambah Produk')

@section('content')
    <div style="max-width:680px; margin:0 auto;">
        <div class="card">
            <div class="card-header">
                <div class="card-title"><i class="fas fa-plus-circle" style="color:var(--brand-blue);"></i> Form Tambah Produk</div>
                <a href="{{ route('admin.products.index') }}" class="btn btn-white btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="form-label" for="name">Nama Produk <span style="color:#ef4444;">*</span></label>
                        <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            placeholder="Contoh: Kemeja Batik Pria Premium" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="category">Kategori Produk <span style="color:#ef4444;">*</span></label>
                        <select id="category" name="category" class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>
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
                                placeholder="150000" value="{{ old('price') }}" min="0" step="1000" required>
                            @error('price')
                                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="stock">Stok Produk <span style="color:#ef4444;">*</span></label>
                            <input type="number" id="stock" name="stock" class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}"
                                placeholder="50" value="{{ old('stock', 10) }}" min="0" required>
                            @error('stock')
                                <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="description">Deskripsi Produk</label>
                        <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                            rows="4" placeholder="Jelaskan spesifikasi, ukuran, bahan, dan keunggulan produk...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="image">Unggah Foto Produk dari Komputer</label>
                        <input type="file" id="image" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" accept="image/*">
                        @error('image')
                            <div class="form-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror

                        <div style="margin-top:10px;">
                            <label class="form-label" for="image_url">Atau Gunakan Link / URL Gambar</label>
                            <input type="url" id="image_url" name="image_url" class="form-control" placeholder="https://..." value="{{ old('image_url') }}">
                        </div>
                    </div>

                    <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:24px;">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-white">Batal</a>
                        <button type="submit" class="btn btn-brand">
                            <i class="fas fa-save"></i> Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
