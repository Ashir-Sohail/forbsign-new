<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hex_code',
        'serial',
        'price',
        'status',
    ];
}
