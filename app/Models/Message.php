<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['chatId', 'senderId', 'sender_type', 'message'];

    public function store()
    {
        return $this->belongsTo(Store::class, 'storeId');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
} 
