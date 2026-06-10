<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePreference extends Model
{
    use HasFactory;
    public $table = 'servicepreferences';
    protected $fillable = ['name', 'value'];
}
