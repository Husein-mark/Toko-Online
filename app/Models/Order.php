<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'total_price',
        'payment_method',
        'payment_proof',
        'status',
        'shipping_address',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'total_price' => 'decimal:2',
            'quantity'    => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'menunggu_pembayaran' => 'Menunggu Pembayaran',
            'diproses'           => 'Diproses',
            'dikirim'            => 'Dikirim',
            'selesai'            => 'Selesai',
            'dibatalkan'         => 'Dibatalkan',
            default              => ucfirst($this->status),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'menunggu_pembayaran' => 'warning',
            'diproses'           => 'info',
            'dikirim'            => 'primary',
            'selesai'            => 'success',
            'dibatalkan'         => 'danger',
            default              => 'secondary',
        };
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }
}
