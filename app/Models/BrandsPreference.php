<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandsPreference extends Model
{
    use HasFactory;
    public $table = 'brandspreferences';
    protected $fillable = ['name', 'value'];
}
