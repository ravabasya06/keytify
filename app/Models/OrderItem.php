<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Order;

class OrderItem extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_item_id';
    protected $fillable = [
        'order_id',
        'item_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'item_id');
    }
}
