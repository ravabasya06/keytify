<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\OrderAddress;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'invoice_id',
        'user_id',
        'session_id',
        'total_price',
        'snap_token',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    public function order_address()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'order_id');
    }
}
