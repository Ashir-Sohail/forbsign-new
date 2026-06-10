<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'option_value_ids',
        'customization',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function optionValues()
    {
        $ids = json_decode($this->option_value_ids, true);

        return OptionValue::whereIn('id', $ids ?? []);
    }
    public function getOptionValuesAttribute()
    {
        $ids = json_decode($this->option_value_ids, true);
        return \App\Models\OptionValue::with('option')->whereIn('id', $ids ?? [])->get();
    }
}
