<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class OrderAddress extends Model
{
    use HasFactory;
    protected $primaryKey = 'order_address_id';
    protected $fillable = [
        'order_id',
        'first_name',
        'last_name',
        'address',
        'city',
        'province',
        'island',
        'postal_code',
        'phone_number',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
