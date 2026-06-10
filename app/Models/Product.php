<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'featured_image',
        'images',
        'short_description',
        'description',
        'specifications',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'meta_url',
        'current_price',
        'previous_price',
        'cat_id',
        'sub_cat_id',
        'child_cat_id',
        'brand_id',
        'total_stock',
        'informative',
    ];

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function sub_categories(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_cat_id');
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class, 'product_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'product_id');
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'product_id');
    }

    public function compares(): HasMany
    {
        return $this->hasMany(Compare::class, 'product_id');
    }

    public function productOptionValues(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class);
    }

    public function productOptions()
    {
        return $this->hasMany(ProductOption::class);
    }
}
