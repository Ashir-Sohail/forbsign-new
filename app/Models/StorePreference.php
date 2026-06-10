<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorePreference extends Model
{
    use HasFactory;
    public $table = 'storepreferences';
    protected $fillable = ['name', 'value'];
}
