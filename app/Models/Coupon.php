<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'commerce_id',
        'code',
        'description',
        'type',
        'value',
        'minimum_total',
        'usage_limit',
        'used_count',
        'starts_at',
        'expires_at',
        'status',
    ];

    public function commerce()
    {
        return $this->belongsTo(Commerce::class);
    }

    protected function casts(): array
    {
        return [
            'value' => 'decimal:2',
            'minimum_total' => 'decimal:2',
            'starts_at' => 'date',
            'expires_at' => 'date',
        ];
    }

    public function isAvailableFor(float $subtotal): bool
    {
        if ($this->status !== 'activo') {
            return false;
        }

        if ($subtotal < (float) $this->minimum_total) {
            return false;
        }

        if ($this->usage_limit !== null && $this->used_count >= $this->usage_limit) {
            return false;
        }

        if ($this->starts_at && now()->startOfDay()->lt($this->starts_at)) {
            return false;
        }

        if ($this->expires_at && now()->startOfDay()->gt($this->expires_at)) {
            return false;
        }

        return true;
    }

    public function discountFor(float $subtotal): float
    {
        if ($this->type === 'fixed') {
            return min((float) $this->value, $subtotal);
        }

        return round($subtotal * ((float) $this->value / 100), 2);
    }

    public function applicableSubtotal($cartItems): float
    {
        if (!$this->commerce_id) {
            return $cartItems->sum(fn ($item) => $item->subtotal());
        }

        return $cartItems
            ->filter(fn ($item) => $item->product->commerce_id === $this->commerce_id)
            ->sum(fn ($item) => $item->subtotal());
    }

    public function originLabel(): string
    {
        return $this->commerce_id ? 'Comercio' : 'LocalMarket';
    }

    public function typeLabel(): string
    {
        return $this->type === 'fixed' ? 'Monto fijo' : 'Porcentaje';
    }
}
