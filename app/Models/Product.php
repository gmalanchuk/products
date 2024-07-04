<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'article',
        'name',
        'status',
        'rating'
    ];

    public static function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->select('url');
    }

    public function imagesList(): array
    {
        return $this->images->pluck('url')->toArray();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function categoriesList(): array
    {
        return $this->categories->pluck('name')->toArray();
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
