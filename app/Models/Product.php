<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'imageURL', 'storeId', 'status'];

    public function store()
    {
        return $this->belongsTo(Store::class, 'storeId');
    }
} 
