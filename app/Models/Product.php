<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'price',
        'stock',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'stock' => 'integer',
        ];
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return 'https://images.unsplash.com/photo-1609592424074-b52fa10e75a6?w=600&auto=format&fit=crop&q=80';
        }

        $img = trim($this->image);

        // Jika berupa URL web eksternal (http://, https://, //, atau www.)
        if (
            str_starts_with($img, 'http://') ||
            str_starts_with($img, 'https://') ||
            str_starts_with($img, '//') ||
            str_starts_with($img, 'www.')
        ) {
            if (str_starts_with($img, 'www.')) {
                return 'https://' . $img;
            }
            if (str_starts_with($img, '//')) {
                return 'https:' . $img;
            }
            return $img;
        }

        // Jika berupa file upload lokal di storage (misal: "products/filename.jpg")
        return asset('storage/' . ltrim($img, '/'));
    }

    public function isInStock(): bool
    {
        return $this->stock > 0;
    }
}
