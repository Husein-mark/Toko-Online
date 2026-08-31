<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Landing page - public dengan filter kategori & pencarian
    public function index(Request $request)
    {
        $query = Product::latest();

        // Filter kategori jika ada
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter pencarian jika ada
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('category', 'like', '%' . $search . '%');
            });
        }

        $products = $query->get();

        $categories = [
            ['name' => 'Fashion', 'icon' => 'fa-shirt'],
            ['name' => 'Elektronik', 'icon' => 'fa-laptop'],
            ['name' => 'Sepatu', 'icon' => 'fa-shoe-prints'],
            ['name' => 'Tas', 'icon' => 'fa-bag-shopping'],
            ['name' => 'Aksesoris', 'icon' => 'fa-clock'],
            ['name' => 'Rumah', 'icon' => 'fa-house'],
        ];

        return view('welcome', compact('products', 'categories'));
    }

    // Admin: daftar produk
    public function adminIndex()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    // Admin: form tambah produk
    public function create()
    {
        $categories = ['Fashion', 'Elektronik', 'Sepatu', 'Tas', 'Aksesoris', 'Rumah', 'Lainnya'];
        return view('admin.products.create', compact('categories'));
    }

    // Admin: simpan produk baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'category'    => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'stock'       => ['required', 'integer', 'min:0'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
            'image_url'   => ['nullable', 'string'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        } elseif ($request->filled('image_url')) {
            $imagePath = trim($request->image_url);
        }

        Product::create([
            'name'        => $validated['name'],
            'category'    => $validated['category'],
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'stock'       => $validated['stock'],
            'image'       => $imagePath,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    // Admin: form edit produk
    public function edit(Product $product)
    {
        $categories = ['Fashion', 'Elektronik', 'Sepatu', 'Tas', 'Aksesoris', 'Rumah', 'Lainnya'];
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Admin: update produk
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'category'    => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'stock'       => ['required', 'integer', 'min:0'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
            'image_url'   => ['nullable', 'string'],
        ]);

        $imagePath = $product->image;

        // 1. Jika pengguna mengunggah file baru dari komputer
        if ($request->hasFile('image')) {
            if ($imagePath && !str_starts_with($imagePath, 'http')) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        } 
        // 2. Jika pengguna memasukkan/mengubah URL gambar
        elseif ($request->filled('image_url') && trim($request->image_url) !== $product->image) {
            if ($imagePath && !str_starts_with($imagePath, 'http')) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = trim($request->image_url);
        }

        $product->update([
            'name'        => $validated['name'],
            'category'    => $validated['category'],
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'stock'       => $validated['stock'],
            'image'       => $imagePath,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk "' . $product->name . '" berhasil diperbarui!');
    }

    // Admin: hapus produk
    public function destroy(Product $product)
    {
        if ($product->image && !str_starts_with($product->image, 'http')) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
