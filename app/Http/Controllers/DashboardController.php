<?php

namespace App\Http\Controllers;

use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {

        // Fetch products from the database
        $products = Product::all();

        // Pass the products to the view
        return view('dashboard', ['products' => $products]);
    }
}