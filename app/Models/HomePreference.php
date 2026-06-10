<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePreference extends Model
{
    use HasFactory;
    public $table = 'homepreferences';
    protected $fillable = [
        'name',
        'value',
    ];
}
