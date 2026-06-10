<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPreference extends Model
{
    use HasFactory;
    public $table = 'contactpreferences';
    protected $fillable = ['name', 'value'];
}
