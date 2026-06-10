<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOptionValue extends Model
{
    use HasFactory;
    protected $table = 'product_option_values';
    protected $fillable = [
        'product_id',
        'option_value_id',
        'required',
        'quantity',
        'subtract',
        'price_prefix',
        'price',
        'points_prefix',
        'points',
        'weight_prefix',
        'weight',
    ];

    // public function productOption()
    // {
    //     return $this->belongsTo(ProductOption::class);
    // }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function option_values()
    {
        return $this->belongsTo(OptionValue::class, 'option_value_id');
    }
    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
