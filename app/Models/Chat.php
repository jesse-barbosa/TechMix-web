<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['userId', 'storeId'];

    public function store()
    {
        return $this->belongsTo(Store::class, 'storeId');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
    public function messages()
    {
        return $this->hasMany(Message::class, 'chatId');
    }
    public function lastMessage()
    {
    return $this->hasOne(Message::class, 'chatId')->latest();
    }

} 
