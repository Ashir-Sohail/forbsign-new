<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'image',
        'name',
        'slug',
        'meta_keyword',
        'meta_description',
        'serial',
        'status',
        'parent_id',
    ];


    function products(): HasMany
    {
        return $this->hasMany(Product::class, 'cat_id');
    }


    // Get the parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Get the child categories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Recursively get all categories (N-level)
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }
    public function getDepthAttribute()
    {
        $depth = 0;
        $parent = $this->parent;
        while ($parent) {
            $depth++;
            $parent = $parent->parent;
        }
        return $depth;
    }
}
