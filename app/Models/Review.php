<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['userId', 'productId', 'stars', 'message', 'created_at',];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
} 
