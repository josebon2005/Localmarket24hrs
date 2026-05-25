<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'rating',
        'comment',
        'source',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function responseMessage(): string
    {
        return match (true) {
            $this->rating <= 2 => 'Gracias por contarnos. Revisaremos cómo mejorar tu experiencia.',
            $this->rating === 3 => 'Gracias por tu opinión. Seguiremos afinando la plataforma.',
            default => 'Gracias por valorarnos. Nos alegra que la experiencia haya sido buena.',
        };
    }
}
