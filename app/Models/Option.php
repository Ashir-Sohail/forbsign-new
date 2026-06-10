<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $table = 'options';

    protected $fillable = [
        'image',
        'option_name_en',
        'option_name_ar',
        'input_type',
        'serial',
        'status',
        'option_value',
    ];
    
    public function option_values()
    {
        return $this->hasMany(OptionValue::class, 'option_id');
    }
}
