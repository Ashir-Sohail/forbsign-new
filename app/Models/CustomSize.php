<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomSize extends Model
{
    use HasFactory;
    protected $table = 'custom_sizes';

    protected $fillable = [
        'name',
        'extra_price',
        'serial',
        'status',
    ];
}
