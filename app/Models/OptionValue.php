<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    use HasFactory;
    protected $table = 'option_values';

    protected $fillable = [
        'option_name_en',
        'option_name_ar',
        'option_id',
        'serial',
        'image',
   
    ];
    public function option()
    {
        return $this->belongsTo(Option::class, 'option_id');
    }
}
