<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $primaryKey = 'brand_id';
    protected $fillable = [
        'name',
        'slug',
        'desc',
        'image_url',
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'brand_id', 'brand_id');
    }
}
