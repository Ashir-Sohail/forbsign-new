<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'billing_address_id',
        'order_status',
        'total',
        'website_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
    public function billingAddress()
    {
        return $this->belongsTo(BillingAddress::class);
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
