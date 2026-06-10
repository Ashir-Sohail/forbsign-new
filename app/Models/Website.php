<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'domain_name',
        'seo_url',
        'description',
        'status',
        'web_icon',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
