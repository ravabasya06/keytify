<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $table = 'user_address';
    protected $primaryKey = 'user_address_id';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'address',
        'city',
        'province',
        'island',
        'postal_code',
        'phone_number',
    ];

    /**
     * Get the user that owns the address.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
