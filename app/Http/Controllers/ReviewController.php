<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;

class ReviewController extends Controller
{
    public function index()
    {
        // Fetch products for the logged-in store
        $productIds = Product::where('storeId', auth()->id())->pluck('id');

        // Fetch reviews for the products of the logged-in store
        $reviews = Review::whereIn('productId', $productIds)
                         ->with(['user', 'product'])
                         ->get();

        // Pass the reviews to the view
        return view('avaliacoes', ['reviews' => $reviews]);
    }

}