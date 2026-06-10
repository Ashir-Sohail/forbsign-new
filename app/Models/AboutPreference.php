<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPreference extends Model
{
    use HasFactory;
    public $table = 'aboutpreferences';
    protected $fillable = ['name', 'value'];
}
