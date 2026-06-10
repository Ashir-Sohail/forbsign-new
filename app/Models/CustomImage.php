<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomImage extends Model
{
    use HasFactory;
    protected $table = 'custom_images'; // optional if table name follows convention

    protected $fillable = [
        'name',
        'image_path',
        'per_character_price',
        'serial',
        'status',
    ];
}
