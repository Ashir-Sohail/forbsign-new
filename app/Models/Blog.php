<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';
    protected $fillable = [
        'image',
        'title',
        'description',
        'tags',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'meta_url',
        'website_id',
        'client_id',
    ];
}
