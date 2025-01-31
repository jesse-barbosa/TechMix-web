<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // or however you fetch products
        return view('produtos', compact('products'));
    }
}