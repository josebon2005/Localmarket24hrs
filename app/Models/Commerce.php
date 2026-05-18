<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commerce extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'banner',
        'logo',
        'address',
        'phone',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function isActivo(): bool
    {
        return $this->status === 'activo';
    }

    public function isSuspendido(): bool
    {
        return $this->status === 'suspendido';
    }

    public function isInactivo(): bool
    {
        return $this->status === 'inactivo';
    }
}
