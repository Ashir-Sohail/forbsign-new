<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriesPreference extends Model
{
    use HasFactory;
    public $table = 'categoriespreferences';
    protected $fillable = ['name', 'value'];
}
