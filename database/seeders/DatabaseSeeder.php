<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'Admin NusaMart',
            'email'    => 'admin@nusamart.id',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'phone'    => '081234567890',
            'address'  => 'Kantor NusaMart, Jakarta Pusat',
        ]);

        // Contoh pembeli
        User::create([
            'name'     => 'Budi Santoso',
            'email'    => 'budi@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'pembeli',
            'phone'    => '08987654321',
            'address'  => 'Jl. Mawar No. 10, Bandung',
        ]);

        // Contoh produk dengan gambar beresolusi tinggi yang terverifikasi
        $products = [
            [
                'name'        => 'Kemeja Batik Premium Pria',
                'category'    => 'Fashion',
                'description' => 'Kemeja batik motif modern dengan bahan katun premium, cocok untuk acara formal maupun casual.',
                'price'       => 185000,
                'stock'       => 50,
                'image'       => 'https://images.unsplash.com/photo-1598033129183-c4f50c736f10?w=600&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Sepatu Sneakers Casual White',
                'category'    => 'Sepatu',
                'description' => 'Sepatu sneakers berbahan kanvas ringan dan nyaman, sol karet anti-slip.',
                'price'       => 325000,
                'stock'       => 30,
                'image'       => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=600&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Tas Ransel Laptop 15 Inch Waterproof',
                'category'    => 'Tas',
                'description' => 'Tas ransel anti air dengan kompartemen laptop 15 inch dan bantalan punggung ergonomis.',
                'price'       => 249000,
                'stock'       => 25,
                'image'       => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=600&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Jam Tangan Sport Digital Automatic',
                'category'    => 'Aksesoris',
                'description' => 'Jam tangan digital waterproof 50m dengan fitur stopwatch, backlight, dan alarm.',
                'price'       => 195000,
                'stock'       => 40,
                'image'       => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Headphone Wireless Bluetooth Over-Ear',
                'category'    => 'Elektronik',
                'description' => 'Headphone bluetooth dengan baterai tahan 20 jam, fitur noise cancellation dan bass mendalam.',
                'price'       => 450000,
                'stock'       => 20,
                'image'       => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Powerbank Fast Charge 20000 mAh',
                'category'    => 'Elektronik',
                'description' => 'Powerbank kapasitas besar 20000mAh dengan dual output USB & Type-C 22.5W.',
                'price'       => 275000,
                'stock'       => 35,
                'image'       => 'https://images.unsplash.com/photo-1620783770629-122b7f187703?w=600&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Kacamata Hitam Sunglasses UV400',
                'category'    => 'Aksesoris',
                'description' => 'Kacamata hitam gaya klasik dengan lensa terpolarisasi pelindung sinar matahari UV400.',
                'price'       => 89000,
                'stock'       => 60,
                'image'       => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?w=600&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Kaos Polos Oversize Cotton Combed 30s',
                'category'    => 'Fashion',
                'description' => 'Kaos polos oversize berbahan katun 100% combed 30s adem, halus, dan tidak luntur.',
                'price'       => 75000,
                'stock'       => 100,
                'image'       => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?w=600&auto=format&fit=crop&q=80',
            ],
            [
                'name'        => 'Set Cangkir Keramik Aesthetic (6 Pcs)',
                'category'    => 'Rumah',
                'description' => 'Set cangkir kopi/teh keramik bergaya scandinavian minimalist, lengkap dengan nampan kayu.',
                'price'       => 165000,
                'stock'       => 15,
                'image'       => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=600&auto=format&fit=crop&q=80',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
