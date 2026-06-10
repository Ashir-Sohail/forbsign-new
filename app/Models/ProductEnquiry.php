<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductEnquiry extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'user_id',
        'name',
        'email',
        'contact_number',
        'message',
        'file',
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Optional: Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
