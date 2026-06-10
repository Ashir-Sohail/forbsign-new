<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteTemplate extends Model
{
    use HasFactory;
    public $table = 'websitetemplates';
    protected $fillable = ['domain', 'name', 'website_id'];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
