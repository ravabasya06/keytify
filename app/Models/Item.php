<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;
use App\Models\OrderItem;

class Item extends Model
{
    use HasFactory;
    protected $primaryKey = 'item_id';
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'brand_id',
        'type',
        'stock',
        'price',
        'short_desc',
        'desc',
        'image_url',
        'status',
        'featured'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'item_id', 'item_id');
    }
}
