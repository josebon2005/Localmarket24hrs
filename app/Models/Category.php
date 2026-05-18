<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function isActiva(): bool
    {
        return $this->status === 'activa';
    }

    public function isInactiva(): bool
    {
        return $this->status === 'inactiva';
    }
}
