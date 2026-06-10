<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartPreference extends Model
{
    use HasFactory;
    public $table = 'cartspreferences';
    protected $fillable = [
        'name',
        'value',
    ];
}
