<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'article',
        'name',
        'status',
        'data',
    ];

    public static function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
