<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Review extends Model
{
    use HasFactory;
    protected $primaryKey = 'review_id';
    protected $fillable = [
        'user_id',
        'name',
        'desc',
        'image_url',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
