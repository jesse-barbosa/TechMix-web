<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'icon'];

    // Relacionamento com os produtos
    public function product()
    {
        return $this->hasMany(Product::class, 'productId');
    }
} 
